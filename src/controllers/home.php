<?php

include_once "models/categories.php";
include_once "models/product.php";
include_once "models/order.php";

function index($args)
{
	$GLOBALS['title'] = "HOME";
	$categories = categories_getcategories();
	include "views/index.php";
}

function products($args)
{
	$GLOBALS['title'] = "PAGES";
	$products = product_getproducts();
	include "views/products.php";
}

function test()
{
	echo "lol";
}

function category($args)
{
	if ($args[0] == '' || ($category = categories_getcategory($args[0])) === FALSE)
	{
		echo "404";
		return ;
	}
	$products = categories_getproducts($category['id']);
	include "views/products.php";
}

function cart($args)
{
	if ($_POST['cancelcart'] == 'clear my cart')
	{
		$_SESSION['cart'] = [];
	}
	else if ($_POST['delproduct'] == 'delete')
	{
		if (!isset($_POST['id']))
			$error = "Unable to delete product ".$_POST['id']." from category !";
		if (isset($_POST['id']))
		{
			if ($_SESSION['cart'][$_POST['id']] > 0)
				$_SESSION['cart'][$_POST['id']]--;
			if ($_SESSION['cart'][$_POST['id']] == 0)
				$_SESSION['cart'][$_POST['id']] = NULL;
		}
	}
	else if ($_POST['submitorder'] == 'comfirm my order')
	{
		if (isset($_SESSION['user']))
		{
			if (($order_id = order_addorder($_SESSION['user']['id'])) === FALSE)
				$error = "Unable to create order";
			if (!isset($error))
			{
				foreach ($_SESSION['cart'] as $id => $p)
				{
					if (order_linkproduct($order_id, $id, $p) === FALSE)
					{
						$error = "Unable to link a product to an order";
						return;
					}
				}
				$_SESSION['cart'] = [];
				redirect('/home');
				return ;
			}
		}
		else
			$error = "You need to be connected to validate your order";
	}

	$o_products = product_getproducts();
	$products = [];
	foreach ($o_products as &$p2)
		if ($_SESSION['cart'][$p2['id']] > 0)
		{
			$p2['amount'] = $_SESSION['cart'][$p2['id']];
			$p2['totalprice'] = ($p2['amount'] + 0) * ($p2['price'] + 0);
			$products[] = $p2;
		}
	$total = array_sum(array_column($products, 'totalprice'));
	$GLOBALS['total_cart'] = $total;
	include "views/cart.php";
}

?>
