<?php

session_start(); 

$disc_data = json_decode(file_get_contents("php://input"));

$disc_image = $disc_data->DiscImage;
$disc_id = $disc_data->DiscID;
$disc_name = $disc_data->DiscName;
$disc_price = $disc_data->DiscPrice;
$disc_quantity = $disc_data->DiscQuantity;

if(isset($_SESSION["shopping_cart"]))
{

	$is_available = true;
	foreach($_SESSION["shopping_cart"] as $keys => $values)
	{
		if($_SESSION["shopping_cart"][$keys]['disc_id'] == $disc_id)	
		{
			$_SESSION["shopping_cart"][$keys]['disc_quantity'] = $_SESSION["shopping_cart"][$keys]['disc_quantity'] += $disc_quantity;
			$is_available = false;
			break;
		}
	}
	if($is_available)
	{
		$item_array = array(
		'disc_image'	=> $disc_image,
		'disc_id'		=>	$disc_id,
		'disc_name'		=>	$disc_name,
		'disc_price'		=>	$disc_price,
		'disc_quantity'	=>	$disc_quantity
		);
		$_SESSION["shopping_cart"][] = $item_array;
	}
}
else
{
	$item_array = array(
		'disc_image'	=> $disc_image,
		'disc_id'		=>	$disc_id,
		'disc_name'		=>	$disc_name,
		'disc_price'		=>	$disc_price,
		'disc_quantity'	=>	$disc_quantity
	);
	$_SESSION["shopping_cart"][] = $item_array;
}	
?>