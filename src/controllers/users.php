<?php

include_once "models/order.php";

function orders()
{
    if (isset($_SESSION['user']))
    {
        $orders = order_getorder($_SESSION['user']['id']);
        $order_sum = [];
        foreach($orders as $key => $order)
        {
            $products = order_getproducts($order['id']);
            foreach ($products as $product)
                $order_sum[$key] += $product['price'] * $product['amount'];
        }
    }
	include "views/orders.php";
}
?>