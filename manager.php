<?php
session_start();
include_once('connect_db.php');
if(isset($_SESSION['username'])){
$id=$_SESSION['manager_id'];
$fname=$_SESSION['first_name'];
$lname=$_SESSION['last_name'];
$sid=$_SESSION['staff_id'];
$user=$_SESSION['username'];
}else{
header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/index.php");
exit();
}
?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo $user;?> - Pharmacy Management System</title>
<link rel="stylesheet" type="text/css" href="mystyle.css">
 <link rel="stylesheet" type="text/css" href="form.css">
<link rel="stylesheet" href="style.css" type="text/css" media="screen" /> 
<link rel="stylesheet" type="text/css" href="dashboard_styles.css"  media="screen" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.js"></script>
<script src="js/function.js" type="text/javascript"></script>

<style>
#left_column{
height: 470px;
}
.dd{
	margin-top: -200px;
	font-family: sans-serif;
	font-size: 30px;
	color:red;
}
.imgc{
	margin-top: -200px;
	margin-left: 700px;
	height: 16px;
	width: 20px;
}
.ddc{
	margin-top: -200px;
	font-family: sans-serif;
	font-size: 30px;
	color:green;
}
</style>

</head>
<body>
<div id="content">
<div id="header">
<p class="ran" > Pharmacy+ </p>
<?php 
	include('connect_db.php');
	$qury=mysqli_query($conn, "SELECT * from stock where status='low'") ;
	$ros=mysqli_num_rows($qury);
	if($ros>0){
		?>
	 <p ><img src="images/red.png" class="imgc dd" >: Low stock</p>
	<?php
	}else{
		?>
	<p ><img src="images/green.png" class="imgc"class="ddc">: Enough stock</p>
	<?php
		
	}
	?>
<p class="user">User:<?php echo $fname." ".$lname; ?></p></div>
<div id="left_column">
<div id="button">
<ul>
			<li><a href="manager.php">Home</a></li>
			<li><a href="view.php">View Users</a></li>
			<li><a href="view_prescription.php">View Prescription</a></li>
			<li><a href="stock.php">Manage Stock</a></li>
			<li><a href="logout.php">Logout</a></li>
		</ul>	
</div>
</div>
<div id="main">
<!-- Dashboard icons -->
            <div class="grid_7">
            	<a href="manager.php" class="dashboard-module">
                	<img src="images/manager_icon.png" width="100" height="100" alt="edit" />
                	<span>Dashboard</span>
                </a>
				<a href="view.php" class="dashboard-module">
                	<img src="images/patients_1.png"  width="100" height="100" alt="edit" />
                	<span style="margin-left:15px">View Users</span>
 
				<a href="view_prescription.php" class="dashboard-module">
                	<img src="images/prescri.jpg" width="100" height="100" alt="edit" />
                	<span style="margin-left:15px">View Prescription</span>
				</a>
				<a href="stock.php" class="dashboard-module">
                	<img src="images/stock_icon.jpg" width="100" height="100" alt="edit" />
                	<span style="margin-left:15px">Manage Stock</span>
                </a>
        </div>
</div>
</div>
</body>
</html>
