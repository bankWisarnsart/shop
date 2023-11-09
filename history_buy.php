<?php
include("./config.php");
session_start();
if(!$_SESSION['user_login'])
		header('location:login.php');
	else{
echo $_SESSION['user_id'];
	}	
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<script src="./js/angular.min.js"></script>
<link rel="stylesheet" href="./css/style.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
	<title>Toy Shop</title>
</head>

<body ng-app="myApp" ng-controller="myCtrl" ng-init=loadProduct();countItem();>
	
	<div class="w3-top">
  <div class="w3-bar w3-white w3-padding w3-card" style="letter-spacing:4px;">
    <a href="news.php" class="w3-bar-item w3-button">ToyShop</a>
    <div class="w3-right w3-hide-small">
      <a href="home.php" class="w3-bar-item w3-button">Toys</a>
		<a href="topup.php" class="w3-bar-item w3-button">Top up</a>
		<a href="bill.php" class="w3-bar-item w3-button">Bill</a>
      <a href="shopping_cart.php" class="w3-bar-item w3-button"><img src="./img/shopping_cart.png" width="25" height="25"> Cart</a>
      <a href="history_buy.php" class="w3-bar-item w3-button">History</a>
	<a href="logout.php" class="w3-bar-item w3-button">Logout</a>
    </div>
  </div>
</div>
	
	<br><br><br>
	<div class="container"> 
		<h1>History list</h1>
	<table class='w3-table-all w3-card-4'>
<tr  align='center' bgcolor='#CCCCCC'>
	<th>Username</th>
	<th>OrderID</th>
	<th>ProductID</th>
	<th>Address</th>
</tr>
<?php

	$slt = "SELECT * FROM users INNER JOIN orders ON users.UserID = orders.UserID 
	left outer join orderlists ON orderlists.OrderID = orders.OrderID 
	WHERE users.UserID = ".$_SESSION['user_id']." ";

$res = mysqli_query($conn, $slt)or die($slt);
  		while($rows = mysqli_fetch_array($res)):
?>
	<tr>
		<td><?= $rows['Username'] ?></td>
		<td><?= $rows['OrderID'] ?></td>
		<td><?= $rows['DiscID'] ?></td>
		<td><?= $rows['Address'] ?></td>
	</tr>
<?php	
  	endwhile;
?>
</table>
</div>
</body>
</html>