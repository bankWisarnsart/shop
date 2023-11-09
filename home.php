<?php 
session_start();
	if(!$_SESSION['user_login'])
		header('location:login.php');
	else{
	//	echo $_SESSION['user_id'];
	}	
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<script src="./js/angular.min.js"></script>
	<link rel="stylesheet" href="./css/style.css">
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
  background-color: white;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: orange;
  color: white;
}

.countItem{
 background-color: red;
color: white;
}
		
		.button2:hover {
  box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19);
}
		
.button {
  background-color: #8094D6;
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
  -webkit-transition-duration: 0.4s; /* Safari */
  transition-duration: 0.4s;
	border-radius: 12px;
}
		
</style>
</head>
<body ng-app="myApp" ng-controller="myCtrl" ng-init=loadProduct();countItem();>
<!--<h1 style="font-variant: small-caps; text-align: center;">Plant shop</h1>-->
	<div class="w3-top">
  <div class="w3-bar w3-white w3-padding w3-card" style="letter-spacing:4px;">
    <a href="news.php" class="w3-bar-item w3-button">ToyShop</a>
	  <a class="w3-bar-item w3-button">Search: <input type="text" ng-model="search"></a>
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
	
	<br><br><br><br>
<div style="font-size: 24px;"><span style="color: gray;">Welcome !</span><span><?php echo $_SESSION['user_name']; ?></span></div>
<div style="font-size: 24px;"><span style="color: gray;">point : </span><span><?php echo $_SESSION['p_money']; ?></span></div>
<!--<div class="search"><span style="font-size: 25px;">Search: <input type="text" ng-model="search"></span></div><br>-->
<div><br>
	
	<div class="container">
		<table class='w3-table-all w3-card-4'>
	<tr align='center' bgcolor='#CCCCCC'>
		<th width="20%">Image</th>
		<th>Name</th>
		<th>Detail</th>
		<th>Price</th>
		<th>Quantity</th>
		<th>Action</th> 
			</tr>
		<tr ng-repeat="d in discs | filter:search" >
			<td><img ng-src="./img/toys/{{d.DiscImage}}" width="256px" height="256px"></td>
			<td>{{d.DiscName}}</td>
			<td>{{d.DiscDetail}}</td>
			<td>{{d.DiscPrice}}</td>
			<td><input type="number" value="1" id="{{$index+1}}"/></td>
			<td><button type="button" class="button button2" ng-click=addToCart(d,$index+1)>Buy</button></td>
		</tr>
	</table>
	<br>
</div>
	</div>
<script type="text/javascript">
var app = angular.module("myApp", []);
app.controller("myCtrl", function($scope, $http){
	$scope.q = {};
	$scope.loadProduct = function(){
		$http.get("./api/fetch.php").then(function(response){
			$scope.discs = response.data;
		});
	};
	$scope.countItem = function(){
		$http.get("./api/count_item.php").then(function(response){
			$scope.item = response.data;
		});
	};
	$scope.addToCart = function(disc, q){
			var quantity = document.getElementById(q).value;
			disc.DiscQuantity = quantity;
			$http({
				method: "POST",
				url: "./api/add_item.php",
				data: disc
			}).then(function(response){
				$scope.countItem();
			});
		}; 
});
</script>
</body>
</html>