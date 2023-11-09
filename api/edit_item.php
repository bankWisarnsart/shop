<?php

session_start(); 

$disc_data = json_decode(file_get_contents("php://input"));
$disc_id = $disc_data->id;
$disc_quantity = $disc_data->quantity;

if(isset($_SESSION["shopping_cart"]))
{
	foreach($_SESSION["shopping_cart"] as $keys => $values)
	{
		if($_SESSION["shopping_cart"][$keys]['disc_id'] == $disc_id)	
		{
			if($disc_quantity <= 0){
				return;
			}
			$_SESSION["shopping_cart"][$keys]['disc_quantity'] = $disc_quantity;
			$is_available = false;
			break;
		}
	}
}
?>