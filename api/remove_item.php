<?php

session_start();

$disc_id = file_get_contents("php://input");
foreach ($_SESSION["shopping_cart"] as $keys => $values) 
{
	if($values["disc_id"] == $disc_id)
	{
		unset($_SESSION["shopping_cart"][$keys]);
		break;
	}
}
?>