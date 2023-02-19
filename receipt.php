<?php

include('connect_db.php');
session_start();
		$invoice_no=$_SESSION['invoice_no'];
		$amount=$_SESSION['amount'];
		$payType=$_SESSION['payType'];
		$serial_no=$_SESSION['serial_no'];
if(isset($_POST['tuma']))
{
$invNo=$_POST['invoice_no'];
	$amount=$_POST['amount'];
	$pType=$_POST['payType'];
	$serial=$_POST['serial_no'];
$t=time("r");
$user=$_SESSION['username'];
$time=date("l\, F d Y\, h:i:s A", $t);
$invoiceNo=$_SESSION['invoice'];
$c_id=$_SESSION['custId'];
$cname=$_SESSION['custName'];



$getCid=mysqli_query($conn, "SELECT customer_id FROM prescription WHERE invoice_id='{$invNo}' ") or die(mysqli_error());
$getName=mysqli_query($conn, "SELECT customer_name FROM invoice WHERE invoice_id='{$invNo}' ") or die(mysqli_error());
$gettot=mysqli_query($conn, "SELECT * FROM invoice_details WHERE invoice='{$invNo}' ") or die(mysqli_error());
$rownum=mysqli_num_rows($gettot);
	if($rownum>0){
		while($datum=mysqli_fetch_array($gettot)){
			$quanty=$datum['quantity'];
			$unitcost=$datum['cost'];
		}
		$totam=$quanty * $unitcost;
	}
$details1=mysqli_fetch_array($getName); 
$details=mysqli_fetch_array($getCid);

	
	$sqlP=mysqli_query($conn, "INSERT INTO receipts(customer_id,total,payType,serialno,served_by,date)
				VALUES('{$details['customer_id']}','{$totam}','{$pType}','{$serial}','{$_SESSION['username']}','{$time}')  ")or die(mysqli_error());
	$querydata=mysqli_query($conn, "select * from prescription where invoice_id='$invNo'") or die(mysqli_error());
	$rowdata=mysqli_num_rows($querydata);
	if($rowdata>0){
		while($datat=mysqli_fetch_array($querydata)){
			$custname=$datat['customer_name'];
			$custid=$datat['customer_id'];
		}
	}
$grandtot=mysqli_query($conn, "SELECT sum(total) as tot from receipts where customer_id='{$details['customer_id']}'");
	
	while($data=mysqli_fetch_array($grandtot)){
	$tata=$data['tot'];
	}
    
    
    
    //open the .txt file and write the total amount here.
    
    
 

//unlink('receipts/docs/'.$custid.'.txt');
unset($_SESSION['custId'], $_SESSION['custName'], $_SESSION['age'], $_SESSION['sex'], $_SESSION['postal_address'], $_SESSION['phone']);
header('Location: payment.php');
exit;
    }
else
{header('Location: payment.php');
exit;}

?>