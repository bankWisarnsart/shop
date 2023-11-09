<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<style>
	.countItem{
 background-color: red;
color: white;
}
	</style>
	<script src="./js/angular.min.js"></script>
	<link rel="stylesheet" href="./css/style.css">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"><br><br><br>
	<title>Top up</title>
</head>
<body  ng-app="myApp" ng-controller="myCtrl" ng-init="countItem();">
	
	<div class="w3-top">
  <div class="w3-bar w3-white w3-padding w3-card" style="letter-spacing:4px;">
    <a href="news.php" class="w3-bar-item w3-button">ToyShop</a>
    <div class="w3-right w3-hide-small">
      <a href="home.php" class="w3-bar-item w3-button">Toys</a>
		<a href="topup.php" class="w3-bar-item w3-button">Top up</a>
		<a href="bill.php" class="w3-bar-item w3-button">Bill</a>
      <a href="shopping_cart.php" class="w3-bar-item w3-button"><img src="./img/shopping_cart.png" width="25" height="25"> Cart<span class="countItem">{{item}}</span></a>
      <a href="history_buy.php" class="w3-bar-item w3-button">History</a>
	<a href="logout.php" class="w3-bar-item w3-button">Logout</a>
    </div>
  </div>
</div>
	
<h1>Top up</h1>
	<div class="container">
		<form style="margin-right: 1px" action="./api/topupCash.php" method="post" enctype="multipart/form-data">
			<h1>เติมเงิน</h1>
			<span>โปรดใส่สลิป</span>
			สลิป :<input type="file" name="image" id="image" class="form-control" ><br>
			<br>
			<button type="submit" name="btSubmit" class="btn btn-info">ยืนยัน</button>
			<button type="reset" name="btReset" class="btn btn-info">เคลียร์</button>
		</form>
	</div>
	<script>
		var app = angular.module("myApp", []);
		app.controller("myCtrl", function($scope, $http){
			
		$scope.countItem = function(){
		$http.get("./api/count_item.php").then(function(response){
			$scope.item = response.data;
		});
	};
	});
	</script>
</body>
</html>