<?php
session_start();
include_once('connect_db.php');
if(isset($_SESSION['username'])){
$id=$_SESSION['pharmacist_id'];
$user=$_SESSION['username'];
$fname=$_SESSION['first_name'];
$lname=$_SESSION['last_name'];
}else{
header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."index.php");
exit();
}
if(isset($_POST['submit'])){
$sname=$_POST['drug_name'];
$cat=$_POST['category'];
$des=$_POST['description'];
$com=$_POST['company'];
$sup=$_POST['supplier'];
$qua=$_POST['quantity'];
$cost=$_POST['cost'];
$sta="Available";

$sql=mysqli_query($conn, "INSERT INTO stock(drug_name,category,description,company,supplier,quantity,cost,status,date_supplied)
VALUES('$sname','$cat','$des','$com','$sup','$qua','$cost','$sta',NOW())");
if($sql>0) {header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/stock_pharmacist.php");
}else{
$message1="<font color=red>Registration Failed, Try again</font>";
}
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
<link rel="stylesheet" href="table1.css" type="text/css" media="screen" /> 
<script src="js/function.js" type="text/javascript"></script>
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
	$qury=mysqli_query($conn, "SELECT * from stock where status='low'") or die(mysqli_error());
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
	 <p class="user">User:<?php echo $fname." ".$lname; ?></p> </div>
<div id="left_column">
<div id="button">
<ul>
			<li><a href="pharmacist.php">Dashboard</a></li>
			<li><a href="prescription.php">Prescription</a></li>
			<li><a href="stock_pharmacist.php">Stock</a></li>
			<li><a href="logout.php">Logout</a></li>
		</ul>	
</div>
		</div>
<div id="main">
<div id="tabbed_box" class="tabbed_box">  
    <h4>Manage Stock</h4> 
<hr/>	
            <style>

    </style>
    <div class="tabbed_area">  
      
        <ul class="tabs">  
			<button >
			<li id="tab_1" class="active"> View Stock</li>  
			</button>
         

             
        </ul>  
        
          
        <div id="content_1" class="content">  
		 <?php echo $message;
			  echo $message1;
			  ?>
      
		<?php
		/* 
		View
        Displays all data from 'Stock' table
		*/

        // connect to the database
        include_once('connect_db.php');

        // get results from database
		
        $result = mysqli_query($conn, "SELECT * FROM stock") 
                or die(mysqli_error());
		// display data in table
        echo "<table border='0' cellpadding='3' class='tab'>";
         echo "<tr><th>ID</th><th>Name</th><th>Available stock</th><th>Description</th><th>Status </th><th>Delete</th></tr>";

        // loop through results of database query, displaying them in the table
        while($row = mysqli_fetch_array( $result )) {
                
                // echo out the contents of each row into a table
                echo "<tr>";
                 echo '<td>' . $row['stock_id'] . '</td>';               
                echo '<td>' . $row['drug_name'] . '</td>';
				echo '<td>' . $row['quantity'] ." ". $row['category'] . '</td>';
				echo '<td>' . $row['description'] . '</td>';
				echo '<td>' . $row['status'] . '</td>';
			?>
				<td><a href="deletestock1.php?id=<?php echo $row['stock_id']?>"><img src="https://cdn-icons-png.flaticon.com/512/25/25298.png" width="24" height="24" border="0" /></a></td>
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
