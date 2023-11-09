<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>ToyShop</title>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="./css/style.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>
<body>
	<?php
	include('config.php');
	session_start();
		$obj = array();
		$TopupId = $_GET['TopupId'];
		$op = $_GET['op'];
	if(isset($_GET['op'])=="EDIT"){

		$sql = "SELECT * FROM topup WHERE TopupId=$TopupId";
		$query = mysqli_query($conn,$sql);
		$row = mysqli_fetch_array($query);
		
	}else{
		echo "Permission denied.<br>";
		echo "<br><a href=\"admin\">[back]</a>";
		die();
	}
	?>
	<div class="container">
		<h1>ดูลายละเอียดการเติม</h1>
		<form action="api/check_pay.php" method="post">
			<input type="hidden" name="TopupId" value="<?=$TopupId?>">
			<input type="hidden" name="OP" value="<?=$op?>">
			<h1></h1>
			สมาชิก :
			<input type="text" name="UserID" readonly class="form-control" value="<?=$row["UserID"]?>">
			โอนเงินเข้าระบบ :
			<input type="number" name="p_money" class="form-control"><br>
			<button type="submit" name="btnSubmit" class="btn btn-info">Conferm</button>
			<a href="set_pay.php" class="btn btn-info">Back</a>
		</form>
	</div>
	<?php
	mysqli_close($conn);
	?>
</body>
</html>