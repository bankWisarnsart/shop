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
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<title>Shopping Cart</title>
</head>
<body  ng-app="myApp" ng-controller="myCtrl" ng-init="countItem();">
<span>Plant shop</span>
<br>
		<div class="w3-top">
  <div class="w3-bar w3-white w3-padding w3-card" style="letter-spacing:4px;">
    <a href="news.php" class="w3-bar-item w3-button">ToyShop</a>
    <div class="w3-right w3-hide-small">
      <a href="home.php" class="w3-bar-item w3-button">Toys</a>
		<a href="topup.php" class="w3-bar-item w3-button">Top up</a>
		<a href="set_pay.php" class="w3-bar-item w3-button">Bill</a>
      <a href="shopping_cart.php" class="w3-bar-item w3-button"><img src="./img/shopping_cart.png" width="25" height="25"> Cart<span class="countItem">{{item}}</span></a>
      <a href="history_buy.php" class="w3-bar-item w3-button">History</a>
	<a href="logout.php" class="w3-bar-item w3-button">Logout</a>
    </div>
  </div>
</div>
	<br>
<h1>product List</h1>
<div>
	<!--Shopping Cart-->
	<table ng-init=fetchCart() width="100%" style="text-align: center;">
		<th>Image</th>
		<th>Name</th>
		<th>Price</th>
		<th>Quantity</th>
		<th>Total</th>
		<th>Action</th>
		<tr ng-repeat="c in carts" >
			<td><img ng-src="./img/toys/{{c.disc_image}}" width="72px" height="72px"></td>
			<td>{{c.disc_name}}</td>
			<td>{{c.disc_price}}</td>
			<td><input type="number" value="{{c.disc_quantity}}" ng-model="quantity[$index]" ng-change="change(quantity[$index], c.disc_id)"/></td>
			<td>{{c.disc_price * c.disc_quantity}}</td>
			<td><button type="button" ng-click=removeProduct(c.disc_id)>Remove</button></td>
		</tr>
		<tr>
			<td></td>
			<td></td><td></td>
			<td>Total:</td>
			<td>{{total}}</td>
		</tr>
		<tr>
			<td></td>
			<td></td><td></td>
			<td>my point:</td>
			<td><?php echo $_SESSION['p_money']; ?></td>
		</tr>
	</table>
	<h2>กรอกที่อยู่ที่ต้องการให้ไปส่ง</h2>
	<form method="post" action="shopping_cart.php">
	<textarea name="address" rows="4" cols="50" ng-model="address">
	</textarea><br>
	<button type="button" name="submitAddr" ng-click=checkout()>ยืนยันการสั่งซื้อ</button>
	<h3 class="warnText" style="display: none;" name="warnText">โปรดกรอกที่อยู่ครับพี่</h3>
	</form>

</div> <!-- ng-app-->
<script type="text/javascript">
	var app = angular.module("myApp", []);
	app.controller("myCtrl", function($scope, $http){
		//shopping cart here
		$scope.carts = [];

		$scope.change = function(quantity, id) {
			if(quantity <= 0){
				alert("Only positive numbers are allow to be set.");
			}
			var data = {"id":id, "quantity":quantity};
			$http({
				method: "POST",
				url: "./api/edit_item.php",
				data: data
			}).then(function(response){
				$scope.fetchCart();
				$scope.countItem();
			});
		}


		$scope.fetchCart = function(){
			$http.get("./api/fetch_cart.php").then(function(response){
				$scope.carts = response.data;

				$http.get("./api/total_price.php").then(function(response){
					$scope.total = response.data;
				});

			});
		};

		$scope.removeProduct = function(id){
			$http({
				method: "POST",
				url: "./api/remove_item.php",
				data: id
			}).then(function(response){
				$scope.fetchCart();
				$scope.countItem();
			});
		};

		$scope.checkout = function(){
			var address = $scope.address;
			if(address == "" || address == undefined) address = "[no address]";
			$http({
				method: "POST",
				url: "./api/checkout.php",
				data: address
			}).then(function(response){
				$scope.fetchCart();
				alert(response.data);
			});
		};
		$scope.countItem = function(){
		$http.get("./api/count_item.php").then(function(response){
			$scope.item = response.data;
		});
	};
	});
</script>
</body>
</html>