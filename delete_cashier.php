<?php
session_start();
include_once('connect_db.php');
if(isset($_SESSION['username'])){
$id=$_SESSION['admin_id'];
$user=$_SESSION['username'];
}else{
header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/index.php");
exit();
}
$id=$_GET[cashier_id];
$sql=mysqli_query($conn, "delete from cashier where cashier_id='$id'");
if($sql){
    header("location:admin_cashier.php");
    }else{
        echo'<script>wimdow.alert("Failed!!! Please try again")</script>';
    }

?>


