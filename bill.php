<?php
session_start();
if(!$_SESSION['user_login'])
		header('location:login.php');
	else{
		echo $_SESSION['user_name'];
	}	
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<script src="./js/angular.min.js"></script>
<link rel="stylesheet" href="./css/style.css">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<title>ViewOrder</title>
</head>

<body ng-app="myApp" ng-controller="myCtrl" ng-init=loadProduct();countItem();>

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
<div style="font-size: 24px;"><span style="color: gray;">Welcome !</span><span><?php echo $_SESSION['user_name']; ?></span></div>
<div style="font-size: 24px;"><span style="color: gray;">point : </span><span><?php echo $_SESSION['p_money']; ?></span></div>
	<table class="w3-table-all w3-card-4" id="customers">
		<h1>Customer</h1>
<h3>ViewOrder</h3>
 <?php
     
     include('config.php'); 
     $query = "SELECT * FROM topup WHERE topup.UserID = ".$_SESSION['user_id']." ORDER BY topup.TopupDateTime DESC" or die("Error:" . mysqli_error()); 
     $result = mysqli_query($conn, $query); 
     
    echo "<table class='w3-table-all w3-card-4'>";
    echo "<tr align='center' bgcolor='#CCCCCC'>
    <td>TopuppId</td>
    <td>TopupImg</td>
    <td>TopupDateTime</td>
    <td>TopupStatus</td>
    <td>UserID</td></tr>";
	 
    while($row = mysqli_fetch_array($result)) { 
      echo "<tr>";
      echo "<td>" .$row["TopupId"] .  "</td> "; 
      echo "<td> <img src= img/topup_img/".$row["TopupImg"]." width='200px'> </td> ";  
      echo "<td>" .$row["TopupDateTime"] .  "</td> ";
      echo "<td>" .$row["TopupStatus"] .  "</td> ";
	  echo "<td>" .$row["UserID"] .  "</td> ";
      //แก้ไขข้อมูล
    }
    echo "</table>";
    //5. close connection
    	mysqli_close($conn);
    ?> 
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