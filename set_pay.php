<?php
session_start();
include('config.php'); 
if(!$_SESSION['user_login'])
		header('location:login.php');
	else{
		//echo $_SESSION['user_id'];
	}	
?>
<!doctype html>
<html>
<head>
	<script src="./js/angular.min.js"></script>
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="./css/style.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous"><<br><br><br>
	<title>Toy shop</title>
</head>
<body ng-app="myApp" ng-controller="myCtrl" ng-init=loadProduct();countItem();>
	
	<div class="nav">
	<a href="logout.php">Logout</a>
	<a href="admin.php" >addForm</a>
	<a href="vieworders.php">orders</a>
  <a href="set_pay.php">pay</a>
</div> 
	
  <div class="container"><br>
	<h1>ประวัติการเติมเงิน</h1><br>
    <div class="container">
      <div class="row">
        <?php
       
            $search_text = isset($_POST['txt_keyword']) ? $_POST['txt_keyword'] : '';
           
            $data = array();
            $sql = "SELECT * FROM topup";
            //echo $sql;
            if ($result = $conn->query($sql)) {
                //printf("Select returned %d rows.\n", $result->num_rows);
                while($row = $result->fetch_array(MYSQLI_ASSOC)){
                    //print_r($row);echo '<br>';
                    $data[] = $row;
                }

                /* free result set */
                $result->close();
            }
            $conn->close();
           
            //echo '<pre>', print_r($data, true), '</pre>';
        ?>
       <table class="table table-bordered w3-card-4 w3-table-all">
            <head>
                <tr>
                  <td>รหัสการเติม</td>
                  <td>หลักฐาน</td>
                  <td>สมาชิก</td>
                  <td>วันที่</td>
                  <td>สถานะ</td>
                  <td>โอนเงิน</td></tr>
                </tr>
            </head>
            <body>
                <tr>
                    <?php
                    foreach($data as $row){
                    ?>
                    <td><?php echo $row['TopupId'];?></td>
                    <td><?php echo "<img src= img/topup_img/".$row['TopupImg']." width='200px'>";?></td>
                    <td><?php echo $row['UserID'];?></td>
                    <td><?php echo $row['TopupDateTime'];?></td>
                    <td><?php echo $row['TopupStatus'];?></td>
					<td>
<?php
  					if($row['TopupStatus'] == 'In progress') {
					echo "<a href='conf_pay.php?TopupId=".$row['TopupId']."&op=EDIT' class='btn btn-info'>โอน</a>";
  					}else{
?>
					<span style='color: green;'>Success</span>
<?php
		}
?></td>
                </tr>
                <?php }?>
            </body>
        </table>

      </div>

</body>
</html>