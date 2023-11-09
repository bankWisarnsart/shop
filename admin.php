<?php
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
	<script src="./js/angular.min.js"></script>
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="./css/style.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
	<title>Toy Shop</title>
</head>
<body>
<div class="nav">
	<a href="logout.php">Logout</a>
	<a href="admin.php" >addForm</a>
	<a href="vieworders.php">orders</a>
  <a href="set_pay.php">pay</a>
</div> 
<div>
<h1 style="font-variant: small-caps; text-align: center;">Add Product</h1>
	<div class="container">
		<form style="margin-right: 1px" action="./api/addProduct.php" method="post" enctype="multipart/form-data">
			<h1>เพิ่มสินค้า</h1>
			ชื้อ : <input type="text" name="DiscName" maxlength="50" class="form-control" placeholder="Name Product">
			ราคา :<input type="number" name="DiscPrice" class="form-control" value="1">
			รูป : <input type="file" name="image" id="image" class="form-control" accept=".jpg,.png"><br>
			
			<button type="submit" name="btSubmit" class="btn btn-info">เพิ่มสินค้า</button>
			<button type="reset" name="btReset" class="btn btn-info">เคลียร์</button>
		</form>
	</div>
  <div class="container">	<br>
	<h1>Product list</h1>
    <?php
     
     include('config.php'); 
     $query = "SELECT * FROM discs" or die("Error:" . mysqli_error()); 
     $result = mysqli_query($conn, $query); 
     
    echo "<table class='w3-table-all w3-card-4'>";
    echo "<tr align='center' bgcolor='#CCCCCC'>
    <td>DiscID</td>
    <td>DiscName</td>
    <td>DiscPrice</td>
    <td>DiscImage</td>
    <td>แก้ไข</td>
	<td>ลบข้อมูล</td></tr>";
	 
    while($row = mysqli_fetch_array($result)) { 
      echo "<tr>";
      echo "<td>" .$row["DiscID"] .  "</td> "; 
      echo "<td>" .$row["DiscName"] .  "</td> ";  
      echo "<td>" .$row["DiscPrice"] .  "</td> ";
      echo "<td>" .$row["DiscImage"] .  "</td> ";
      //แก้ไขข้อมูล
      echo "<td><a href='updateForm.php?DiscID=".$row['DiscID']."&op=EDIT' class='btn btn-info'>edit</a></td> ";
		
	  echo "<td><a href='api/deleteForm.php?DiscID=".$row['DiscID']."&op=DELETE' class='btn btn-info' onclick=\"return confirm('Do you want to delete this record? !!!')\">del</a></td> ";
      echo "</tr>";
    }
    echo "</table>";
    //5. close connection
    	mysqli_close($conn);
    ?> 
  </div>
  <br>
</body>
</html>