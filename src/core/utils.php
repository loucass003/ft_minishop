<?php

function html_print($arg)
{
	echo "<pre>";
	var_dump($arg);
	echo "</pre>";
}

function redirect($url)
{
	header('Location: '.$url);
}

?>
