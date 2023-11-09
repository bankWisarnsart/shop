<?php
session_start();
	include("../config.php");
	$date = date("Ymd");	
    $numrand = (mt_rand());
if(isset($_POST["btSubmit"])){
	$userid = $_SESSION['user_id'];
	$todaytime = date("Y-m-d H:i:s");
	$path="../img/topup_img/";
	$type=strrchr($_FILES['image']['name'],".");
    $newname = $date.$numrand.$type;
	$path_copy=$path.$newname;
	$path_link="../img/topup_img/".$newname;
	move_uploaded_file($_FILES['image']['tmp_name'],$path_copy);
			
    $sql = "INSERT INTO topup (Topupid, TopupImg, TopupDateTime, TopupStatus, UserID) VALUES (NULL, \"$newname\", \"$todaytime\", \"In progress\", \"$userid\")";
    $query_img = mysqli_query($conn,$sql)or die ("Error in query: $sql " . mysqli_error());
	
}else{
	
	echo "<script type='text/javascript'>";
    echo "alert('Permission deniedy');";
    echo "window.location = '../topup.php'; ";
    echo "</script>";

}
	echo "<script type='text/javascript'>";
    echo "alert('Success');";
    echo "window.location = '../topup.php'; ";
    echo "</script>";
	mysqli_close($conn);

?>