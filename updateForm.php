<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Toy Shop</title>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="./css/style.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>
<body>
	<?php
	include('config.php');
		$obj = array();
		$DiscID = $_GET['DiscID'];
		$op = $_GET['op'];
	if(isset($_GET['op'])=="EDIT"){

		$sql = "SELECT * FROM discs WHERE DiscID=$DiscID";
		$query = mysqli_query($conn,$sql);
		$row = mysqli_fetch_array($query);
		
	}else{
		echo "Permission denied.<br>";
		echo "<br><a href=\"admin\">[back]</a>";
		die();
	}
	?>
	<div class="container">
		<form action="api/addProduct.php" method="post">
			<input type="hidden" name="DiscID" value="<?=$DiscID?>">
			<input type="hidden" name="OP" value="<?=$op?>">
			<h1>Update product</h1>
			Name :
			<input type="text" name="DiscName" maxlength="50" class="form-control" value="<?=$row["DiscName"]?>">
			Price :
			<input type="number" name="DiscPrice" class="form-control" value="<?=$row["DiscPrice"]?>">
			img :
			<input type="file" name="DiscImage" maxlength="50" class="form-control" value="<?=$row["DiscImage"]?>" 
			placeholder="<?=$row["DiscImage"]?>"><br>
			
			<button type="submit" name="btSubmit" class="btn btn-info">Update product</button>
			<a href="admin.php" class="btn btn-info">Back</a>
		</form>
	</div>
	<?php
	mysqli_close($conn);
	?>
</body>
</html>
