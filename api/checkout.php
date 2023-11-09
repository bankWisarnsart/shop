<?php
session_start();
include("../config.php");
$address = file_get_contents("php://input");
if($_SESSION["total"] < $_SESSION["p_money"])
{
	$todaytime = date("Y-m-d H:i:s");
	$point = $_SESSION["p_money"]; 
	$userid = $_SESSION['user_id'];
	$total = $_SESSION['total'];
	$sql = "INSERT INTO orders VALUES('','$userid','$address','$total','$todaytime')";
	$res = mysqli_query($conn, $sql) or die("$sql");

	$sql ="SELECT OrderID FROM orders WHERE UserID = '$userid' ORDER BY OrderID DESC LIMIT 1";
	$res = mysqli_query($conn, $sql)or die("$sql");
	$row = mysqli_fetch_array($res);

	$orderid = $row['OrderID'];
	
	$_SESSION["p_money"] = $point-$total;
	$point = $_SESSION["p_money"]; 
	
	$sql = "UPDATE users SET p_money = '$point'  WHERE UserID = '$userid' ";
	$res = mysqli_query($conn, $sql) or die("$sql");
	
	
	foreach ($_SESSION["shopping_cart"] as $key => $value) 
	{
		$unit = $value['disc_quantity'];
		$discid = $value['disc_id'];
		$sql = "INSERT INTO orderlists VALUES('$orderid', '$discid', '$unit')";
		$res = mysqli_query($conn, $sql);
		
	}
	unset($_SESSION['shopping_cart']);
	echo "accept";
}
else{
	echo "reject";
}



?>