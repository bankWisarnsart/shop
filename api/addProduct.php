<?php

	include("../config.php");

if(isset($_POST["btSubmit"])&& isset($_FILES['image'])){
	
	echo "<pre>";
	print_r($_FILES['image']);
	echo "</pre>";

	$img_name = $_FILES['image']['name'];
	$img_size = $_FILES['image']['size'];
	$tmp_name = $_FILES['image']['tmp_name'];
	$error = $_FILES['image']['error'];
	$DiscName = $_POST["DiscName"];
	$DiscPrice = $_POST["DiscPrice"];

	
	if(isset($_POST['OP'])=="EDIT"){
		
		$DiscID = $_POST["DiscID"];
		$sql = "UPDATE discs SET DiscName = \"$DiscName\", DiscPrice = \"$DiscPrice\", DiscImage = \"$DiscImage\" WHERE discs.DiscID = $DiscID";
		$query = mysqli_query($conn, $sql) or die("[ERROR] Update query is worng.<br>$sql");
		
		echo "<script type='text/javascript'>";
        echo "alert('Add succesfully');";
        echo "window.location = '../admin.php'; ";
        echo "</script>";
		
	}else{
		$img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
		$img_ex_lc = strtolower($img_ex);
		
		$new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
		$img_upload_path = 'img'.$new_img_name;
		move_uploaded_file($tmp_name, $img_upload_path);
	
	$sql = "INSERT INTO discs (DiscID, DiscName, DiscPrice, DiscImage) VALUES (NULL, \"$DiscName\", \"$DiscPrice\", \"$new_img_name\")";
		
	$query = mysqli_query($conn, $sql) or die("[ERROR] Insert query is worng.<br>$sql");
	
	echo "<script type='text/javascript'>";
    echo "alert('Added new product successfully');";
    echo "window.location = '../admin.php'; ";
    echo "</script>";
	}
}
else{
	echo "<script type='text/javascript'>";
    echo "alert('Permission deniedy');";
    echo "window.location = '../admin.php'; ";
    echo "</script>";

}
	mysqli_close($conn);

?>