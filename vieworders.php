	<?php
include("./config.php");
session_start();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<script src="./js/angular.min.js"></script>

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="./css/style.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

<title>Toy Shop</title>
</head>

<body>
	<h1 style="font-variant: small-caps; text-align: center;">Toy shop</h1><br>

<div class="nav">
	
	<a href="logout.php" >Logout</a>
	<a href="admin.php" >addForm</a>
	<a href="vieworders.php">orders</a>
	<a href="set_pay.php">pay</a>

</div>
<div class="container">
<div style="font-size: 24px;"><span style="color: gray;">Welcome !  </span><span><?php echo $_SESSION['user_name']; ?></span></div>
<div ng-app="myApp" ng-controller="myCtrl" ng-init=loadOrder();loadOrder2();>
	<div class="search"><span style="font-size: 25px;">Search: </span><input type="text" ng-model="search"></div><br><br>
	
	<div class="container"> 
	<h1>Oders list</h1>
	<table class='w3-table-all w3-card-4'>
<tr  align='center' bgcolor='#CCCCCC'>
		<th>OrderID</th>
		<th>UserID</th>
		<th>Product Name</th>
		<th>Unit</th>
		<th>Address</th>
</tr>
<?php

	$slt = "SELECT * FROM orders INNER JOIN orderlists ON orders.OrderID = orderlists.OrderID left outer join discs on orderlists.DiscID = discs.DiscID ";
$res = mysqli_query($conn, $slt)or die($slt);
  		while($rows = mysqli_fetch_array($res)):
?>
	<tr>
		<td><?= $rows['UserID'] ?></td>
		<td><?= $rows['OrderID'] ?></td>
		<td><?= $rows['DiscName'] ?></td>
		<td><?= $rows['Unit'] ?></td>
		<td><?= $rows['Address'] ?></td>
	</tr>
<?php	
  	endwhile;
?>
</table>
</div>
	
<!--
table class="w3-table-all w3-card-4" id="customers">
		<th width="20%">OrderID</th>
		<th>UserID</th>
		<th>ProductID</th>
		<th>Unit</th>
		<th>Address</th>
		<tr ng-repeat="o in orders | filter:search" >
			<td>{{o.OrderID}}</td>
			<td>{{o.UserID}}</td>
			<td>{{o.Address}}</td>
		</tr>
	</table>
	<br>
	<br>
	<table class="w3-table-all w3-card-4" id="customers">
		<th width="20%">OrderID</th>
		<th>ProductID</th>
		<th>Unit</th>
		<tr ng-repeat="or in orderlists | filter:search" >
			<td>{{or.OrderID}}</td>
			<td>{{or.DiscID}}</td>
			<td>{{or.Unit}}</td>
	</table>
-->
	</div>
	<script type="text/javascript">
var app = angular.module("myApp", []);
app.controller("myCtrl", function($scope, $http){
		$scope.loadOrder = function(){
		$http.get("./api/orders.php").then(function(response){
			$scope.orders = response.data;
		});
		};
		$scope.loadOrder2 = function(){
		$http.get("./api/order2.php").then(function(response){
			$scope.orderlists = response.data;
		});
	};
});
	
</script>
</body>
</html>