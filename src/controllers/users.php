<?php

include_once "models/order.php";
include_once "models/auth.php";

function middleware($context, $args, $next)
{
	if (!isset($_SESSION['user']))
	{
		error('You need to be connected');
		return (FALSE);
	}
	$next($context, $args);
	return (TRUE);	
}

function orders()
{
	$orders = order_getorder($_SESSION['user']['id']);
	$order_sum = [];
	foreach($orders as $key => $order)
	{
		$products = order_getproducts($order['id']);
		foreach ($products as $product)
			$order_sum[$order['id']] += $product['price'] * $product['amount'];
	}
	rsort($orders);
	include "views/orders.php";
}

function order($args)
{
	$id = $args[0];
	$products = order_getproducts($id);
	foreach ($products as $product)
			$order_sum[$id] += $product['price'] * $product['amount'];
	include "views/order_details.php";
}

?>