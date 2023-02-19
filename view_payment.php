<?php
session_start();
include_once('connect_db.php');
if(isset($_SESSION['username'])){
$id=$_SESSION['invoice_id'];
$cname=$_SESSION['customer_name'];
$sby=$_SESSION['served_by'];
$st=$_SESSION['status'];
$user=$_SESSION['username'];
}else{
header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/index.php");
exit();
}
?>
<!DOCTYPE html>
<html>
<head>
<title><?php $user?> Pharmacy Management System</title>
<link rel="stylesheet" type="text/css" href="mystyle.css">
    <link rel="stylesheet" type="text/css" href="form.css">
<link rel="stylesheet" href="style.css" type="text/css" media="screen" /> 
	<link rel="stylesheet" type="text/css" href="style/dashboard_styles.css"  media="screen" />
<link rel="stylesheet" href="table1.css" type="text/css" media="screen" /> 
<script src="js/function1.js" type="text/javascript"></script>
   <style>#left-column {height: 477px;}
 #main {height: 477px;}
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
	 <p ><img src="images/red.png" class="imgc" class="dd">: Low stock</p>
	<?php
	}else{
		?>
	<p ><img src="images/green.png" class="imgc" class="ddc">: Enough stock</p>
	<?php
		
	}
	?>
	       <p class="user">User:<?php echo $fname." ".$lname; ?></p></div>
<div id="left_column">
<div id="button">
		<ul>
			<li><a href="cashier.php">Home</a></li>
			<li><a href="payment.php">Process payment</a></li>
            <li><a href="view_payment.php">View Payment</a></li>
			<li><a href="logout.php">Logout</a></li>
		</ul>	
</div>
</div>
<div id="main">
<div id="tabbed_box" class="tabbed_box">  
    <h4>View Payment</h4> 
<hr/>	
    <div class="tabbed_area">  
      
        <ul class="tabs">  
            <li><a href="javascript:tabSwitch('tab_1', 'content_1');" id="tab_1" class="active">Payment </a></li>  
                          
        </ul>  
          
        <div id="content_1" class="content">  
		<?php echo $message1;
		/* 
		View
        Displays all data from 'Pharmacist' table
		*/
        // connect to the database
        include_once('connect_db.php');
       // get results from database
       $result = mysqli_query($conn, "SELECT DISTINCT * FROM invoice");
		// display data in table
        echo "<table border='0' cellpadding='3'>";
        echo "<tr> <th>Invoice id</th><th>Customer Name </th> <th>Served By </th><th>Status</th></tr>";
        // loop through results of database query, displaying them in the table
        while($row = mysqli_fetch_array( $result )) {
                // echo out the contents of each row into a table
                echo "<tr>";
                echo '<td>' . $row['invoice_id'] . '</td>';
                echo '<td>' . $row['customer_name'] . '</td>';
				echo '<td>' . $row['served_by'] . '</td>';
				echo '<td>' . $row['status'] . '</td>';
				?>
				
				<?php
		 } 
        // close table>
        echo "</table>";
?> 
        </div>  

    </div>  
</div>
</div>
</div>
</body>
</html>