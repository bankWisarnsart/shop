<?php

	include("../config.php");
	session_start();	
if(isset($_POST["btnSubmit"])){
	
	if(isset($_POST['OP'])=="EDIT"){
		$TopupId = $_POST["TopupId"];
		$UserID = $_POST["UserID"];
		$p_money = $_POST["p_money"];
		$my_trade = $_POST['p_money'];
		$sql="SELECT * FROM users WHERE UserID = '".$UserID."'";
        $result = mysqli_query($conn,$sql);
		
		if(mysqli_num_rows($result)==1){
            	
                $f_record = mysqli_fetch_array($result);
                
                $sid = $f_record['UserID'];
                $cynpass = $f_record['p_money'] + $my_trade;
                $sqlup = "UPDATE users SET p_money = '".$cynpass."' WHERE UserID = '".$sid."'";
                $query = mysqli_query($conn,$sqlup);

	
		$sql = "UPDATE topup SET TopupStatus = \"Success\" WHERE topup.TopupId = $TopupId";
		$query = mysqli_query($conn, $sql) or die("[ERROR] Update query is worng.<br>$sql");

		echo "<script type='text/javascript'>";
        echo "alert('Pay succesfully');";
        echo "window.location = '../set_pay.php'; ";
        echo "</script>";
		
	}
}
else{
	echo "<script type='text/javascript'>";
    echo "alert('Permission deniedy');";
    echo "window.location = '../conf_pay.php'; ";
    echo "</script>";

}
	mysqli_close($conn);
}
?>