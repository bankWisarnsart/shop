<?php

session_start();

$_SESSION["total"] = 0;
if(isset($_SESSION["shopping_cart"]))
{

	foreach ($_SESSION["shopping_cart"] as $keys => $values) 
	{
		$_SESSION["total"] = $_SESSION["total"] + ($_SESSION["shopping_cart"][$keys]["disc_price"] * $_SESSION["shopping_cart"][$keys]["disc_quantity"]);
	}
}

echo $_SESSION["total"];

?>