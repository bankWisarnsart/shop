<?php
include("../config.php");
if(isset($_GET['op'])=="DELETE"){
	
	$DiscID = $_GET['DiscID'];
	$op = $_GET['op'];
	$sql = "DELETE FROM discs WHERE DiscID = $DiscID";
	$query = mysqli_query($conn, $sql) or die("[ERROR] Delete query is worng.<br>$sql");
			
	echo "<script type='text/javascript'>";
        echo "alert('Delete $DiscID succesfully');";
        echo "window.location = '../admin.php'; ";
        echo "</script>";
}
?>