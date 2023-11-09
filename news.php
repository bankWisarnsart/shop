<?php 
session_start();
	if(!$_SESSION['user_login'])
		header('location:login.php');
	else{
		//echo $_SESSION['user_id'];
	}	
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="./css/style2.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
<title>ToyShopt</title>
	
	<style>
	.countItem{
 background-color: red;
color: white;
border-radius: 12px;
}

.navbar {
  overflow: hidden;
  background-color: #333;
}

.navbar a {
  float: left;
  font-size: 16px;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

.dropdown {
  float: left;
  overflow: hidden;
}

.dropdown .dropbtn {
  font-size: 16px;  
  border: none;
  outline: none;
  color: white;
  padding: 14px 16px;
  background-color: inherit;
  font-family: inherit;
  margin: 0;
}

.navbar a:hover, .dropdown:hover .dropbtn {
  background-color: red;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  float: none;
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  text-align: left;
}

.dropdown-content a:hover {
  background-color: #ddd;
}

.dropdown:hover .dropdown-content {
  display: block;
}
	</style>
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

 <br>
<div class="w3-row w3-padding-64" id="about">
		<?php
     include('config.php'); 
     $query = "SELECT * FROM news" or die("Error:" . mysqli_error()); 
     $result = mysqli_query($conn, $query); 
	 while($rows = mysqli_fetch_array($result)):
    ?> 

    <div class="w3-second w3-container w3-margin-bottom">
     <img src="img/news/<?= $rows['NewsImg'] ?>" class="w3-hover-opacity" alt="ImgNew" width="300" height="300">
	 <div class="w3-container w3-white">
        <h1><?= $rows['NewsTitle'] ?></h1><br>
        <p><?= $rows['NewsDetail'] ?></p>
      </div>	
    </div>
<?php	
  	endwhile;
?>
  </div>
	
	
<script type="text/javascript">
var app = angular.module("myApp", []);
app.controller("myCtrl", function($scope, $http){
		$scope.loadNews = function(){
		$http.get("./api/connect_news.php").then(function(response){
			$scope.news = response.data;
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