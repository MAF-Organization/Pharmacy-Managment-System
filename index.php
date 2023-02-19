<html>

<?php
include_once 'connect_db.php';
if(isset($_POST['submit'])){
$username=$_POST['username'];
$password=$_POST['password'];
$position=$_POST['position'];
	if($position!=''){
	
switch($position){
case 'Admin':
$result=mysqli_query($conn,"SELECT admin_id, username FROM admin WHERE username='$username' AND password='$password'");
$row=mysqli_fetch_array($result);
if($row>0){
session_start();
$_SESSION['admin_id']=$row[0];
$_SESSION['username']=$row[1];
header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/admin.php");
}else{
$message="<font color=orangered class= messo id=alert-messo>Invalid login Try Again</font>";
}
break;
case 'Pharmacist':
$resultp=mysqli_query($conn, "SELECT * FROM pharmacist WHERE username='$username' AND password='$password'");
$row=mysqli_fetch_array($resultp);
if($row>0){
session_start();
$_SESSION['pharmacist_id']=$row[0];
$_SESSION['first_name']=$row[1];
$_SESSION['last_name']=$row[2];
$_SESSION['staff_id']=$row[3];
$_SESSION['username']=$row[4];
header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/pharmacist.php");
}else{
$message="<font color=orangered class= messo id=alert-messo>Invalid login Try Again</font>";
	
}
break;
case 'Cashier':
$result=mysqli_query($conn, "SELECT cashier_id, first_name,last_name,staff_id,username FROM cashier WHERE username='$username' AND password='$password'");
$row=mysqli_fetch_array($result);
if($row>0){
session_start();
$_SESSION['cashier_id']=$row[0];
$_SESSION['first_name']=$row[1];
$_SESSION['last_name']=$row[2];
$_SESSION['staff_id']=$row[3];
$_SESSION['username']=$row[4];
header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/cashier.php");
}else{
$message="<font color=orangered class= messo id=alert-messo>Invalid login Try Again</font>";
}
break;
case 'Manager':
$result=mysqli_query($conn, "SELECT manager_id, first_name,last_name,staff_id,username FROM manager WHERE username='$username' AND password='$password'");
$row=mysqli_fetch_array($result);
if($row>0){
session_start();
$_SESSION['manager_id']=$row[0];
$_SESSION['first_name']=$row[1];
$_SESSION['last_name']=$row[2];
$_SESSION['staff_id']=$row[3];
$_SESSION['username']=$row[4];
header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/manager.php");
}else{
$message="<font color=orangered class= messo id=alert-messo>Invalid login Try Again</font>";
}
break;
}
}else{
echo'<script>window.alert("Please select your login category")</script>';
}
}
echo <<<LOGIN
<!DOCTYPE html>
<html>
<head>
<title>Pharmacy Management System</title>
<link rel="stylesheet" type="text/css" href="PMS - Copy.css">

<style>

#position
{
    margin-left: 190px;
    margin-top:12px;
    padding:5px;
    width:200px;    top: calc(-80px/2);
    left: calc(50% -40px);
    font-size: x-large;
    
}

</style>

</head>
<body>

<div id="form3" class="-body">
<div class="container">
 <div class="login-left">
     <div class="login-head">
     <img src="avatar.png" alt="" class="avatar">
     <h2>Login here</h2>
     </div>
  
	  $message
      <form method="post" action="index.php">
      <label for="Username" id="label" name="username"><b>USERNAME</b></label>
      <input type="text" placeholder="Username" id="user" name="username" required>
      <label for="Password" id="label" name="password" ><b>PASSWORD</b></label>
      <input type="password" placeholder="Password" id="password" name="password" required>
		<select id="position" name="position">
	        <option>Pharmacist</option>
			<option>Admin</option>
			<option>Cashier</option>
			<option>Manager</option>
			</select>
        <p class="button2"><input type="submit" name="submit" value="Login"></p>
      </form>
      </div>
      </div>
   
    </section>
</div>
</div>
</body>
</html>
LOGIN;
?>
</html>