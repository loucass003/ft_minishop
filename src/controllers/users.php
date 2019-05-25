<?php

include_once "models/order.php";

function middleware($context, $args, $next)
{
	if (!isset($_SESSION['user']))
	{
		echo "You need to be connected";
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
            $order_sum[$key] += $product['price'] * $product['amount'];
    }
	include "views/orders.php";
}
?>
