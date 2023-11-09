<?php
session_start();
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include("../config.php");

if(isset($_POST['action'])){
  switch ($_POST['action']){
    case 'login':
      login();
      break;
    case 'register':
      register();
      break;
  }
}

function login(){
    global $conn;
    $username = $_POST['username'];
	$password = $_POST['password'];
    $sql = "SELECT * FROM users WHERE Username = '$username' AND Password = '$password'";
    $result = mysqli_query($conn, $sql) or die("[ERROR]: $sql");
    $rows = mysqli_fetch_array($result);

    if(mysqli_num_rows($result) == 1){
        $_SESSION['user_login'] = true;
        $_SESSION['user_name'] = $rows['Username'];
        $_SESSION['user_id'] = $rows['UserID'];
		$_SESSION['level'] = $rows['level'];
		$_SESSION['p_money'] = $rows['p_money'];
		
		if($_SESSION["level"]=="admin"){ 

           echo "{\"check\":\"success0\"}";
           }
        if ($_SESSION["level"]=="member")
		   { 
           echo "{\"check\":\"success1\"}";
           }
	}else{
      	echo "{\"check\":\"\"}";
    }
	exit;
  }
function register(){
  global $conn;
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $phone = $_POST['phone'];
  $address = $_POST['address'];
  $email = $_POST['email'];
  $dob = $_POST['dob'];
  $gender = $_POST['gender'];
  $username = $_POST['username'];
  $password = $_POST['password'];

  $sql = "SELECT * FROM users WHERE Username = '$username'";
  $result = mysqli_query($conn, $sql) or die ("[ERROR] $sql");
  $rows_cnt = mysqli_num_rows($result);
  if($rows_cnt > 0){
    echo "{\"check\":\"exist\"}";
    exit;
  }
  else{

    $sql = "INSERT INTO users VALUES('','$fname', '$lname', '$phone', '$address', '$email', '$dob', '$gender', '$username', '$password','member')";
    $result = mysqli_query($conn, $sql) or die ("[ERROR] $sql");

    echo "{\"check\":\"success\"}";
  }

  exit;
}
?>