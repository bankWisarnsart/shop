<?php
include("../config.php");
$sql = "SELECT * FROM discs";
$result = mysqli_query($conn, $sql) or die("[ERROR] : $sql");
if($result):
	if(mysqli_num_rows($result) > 0):
		while($rows = mysqli_fetch_assoc($result)):
			$outp[] = $rows;
		endwhile;
		echo json_encode($outp);
	endif;
endif;
?>