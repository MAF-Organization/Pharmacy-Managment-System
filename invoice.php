<?php

include('connect_db.php');
session_start();
$c_id=$_SESSION['custId'];
$cname=$_SESSION['custName'];
$phone=$_SESSION['phone'];
$quantity=$_SESSION['quantity'];
$t=time("r");
$user=$_SESSION['username'];
$time=date("l\, F d Y\, h:i:s A", $t);
$invoiceNo=$_SESSION['invoice'];
	$month=date('F');
	$yr=date('Y');
    $day=date('j');
		
$getPresid=mysqli_query($conn, "SELECT 1+MAX(prescription_id) FROM prescription");
$presId=mysqli_fetch_array($getPresid);
		if($presId[0]=='')
		{$presIdd=999; }
		else{$presIdd=$presId[0];}
	
		$sqlP=mysqli_query($conn, "INSERT INTO prescription(prescription_id,customer_id,customer_name,invoice_id,phone)
				VALUES('{$presIdd}','{$c_id}','{$cname}','{$invoiceNo}','{$phone}')  ") or die(mysqli_error($conn));
		$sqlI=mysqli_query($conn, "INSERT INTO invoice(invoice_id, customer_name,served_by,status)
				VALUES('{$invoiceNo}','{$cname}','{$user}','Pending') ");
		$sqlIi=mysqli_query($conn, "INSERT INTO ids(ids, invoice_id)
				VALUES('{$c_id}','{$invoiceNo}') ")or die(mysqli_error($conn));				
$getDetails=mysqli_query($conn, "SELECT * FROM tempprescri WHERE customer_id='{$c_id}'");
while($item1=mysqli_fetch_array($getDetails))
			{	
				$getDetails1=mysqli_query($conn, "SELECT stock_id, cost FROM stock WHERE drug_name='{$item1['drug_name']}'");	
			
				$details=mysqli_fetch_array($getDetails1);
				$sqlId=mysqli_query($conn, "INSERT INTO invoice_details(invoice,drug,cost,quantity,day,month,year)
				VALUES('{$invoiceNo}','{$details['stock_id']}','{$details['cost']}','{$item1['quantity']}','$day','$month','$yr')");
				$count[]=$details['cost']*$item1['quantity'];
	$grandtot=mysqli_query($conn, "SELECT sum(total) as tot from receipts where customer_id='{$c_id}'");
	
	while($data=mysqli_fetch_array($grandtot)){
	$tata=$data['tot'];
	}
		//}	echo $invoiceNo."details".$details['stock_id']."-".$details['cost']."-".$item1['quantity'];
			/*
				
				$sqlIp="INSERT INTO prescription_details(pres_id,drug_name,strength,dose,quantity)
				VALUES('{$presIdd}','{$details['stock_id']}','{$item1['strength']}','{$item1['dose']}','{$item1['quantity']}') ";
				echo $sqlIp ."<br>";
				
				*/
			}
			$tot=array_sum($count);
			$file=fopen("receipts/docs/".$c_id.".txt", "a+");


	fclose($file);
		$getDetailZ=mysqli_query($conn,"SELECT * FROM tempprescri WHERE customer_id='{$c_id}'");
while($item12=mysqli_fetch_array($getDetailZ))
			{	
			$getDetails12=mysqli_query($conn, "SELECT * FROM stock WHERE drug_name='{$item12['drug_name']}'");	
			
				$details2=mysqli_fetch_array($getDetails12);
			$sqlIp=mysqli_query($conn, "INSERT INTO prescription_details(pres_id,drug_name,strength,dose,quantity)
				VALUES('{$presIdd}','{$details2['stock_id']}','{$item12['strength']}','{$item12['dose']}','{$item12['quantity']}') ");	
	$newquant=$details2['quantity']-$quantity;
	if($newquant!=0){
		$update=mysqli_query($conn,"Update stock set quantity='".$newquant."' where stock_id='".$details2['stock_id']."'") or die(mysqli_error());
	}
					
			}
	$sqy=mysqli_query($conn, "INSERT INTO sales(invoice,drug,cost,quantity,day,month,year)
				VALUES('$invoiceNo','{$details['stock_id']}','{$details['cost']}','$quantity','$day','$month','$yr')"); 
		//$sqlD=mysqli_query($conn, "DELETE FROM tempprescri WHERE customer_id='{$c_id}' ");
				
	
	//select all from temp prescri where cust/Id =$c_id
	 





//unlink('receipts/docs/'.$c_id.'.txt');

unset($_SESSION['custId'], $_SESSION['custName'], $_SESSION['age'], $_SESSION['sex'], $_SESSION['postal_address'], $_SESSION['phone']);
header('Location: prescription.php');
exit;

?>