<?php

if(isset($_POST['submit'])){
	$select = $_POST['mode'];
	$account_number = $_POST['account_number'];
	$account_name = $_POST['account_name'];
	$receipt = $_FILES['receipt']['name'];
	$type = $_FILES['receipt']['type'];
	
	$org = $_POST['org'];
	$final = $_POST['final'];


	if(empty($select) || empty($account_name) || empty($account_number) || !file_exists($_FILES['receipt']['tmp_name'])){
		header("location: ../organization-payment.php?error=1");
		exit();
	}else{
		$data = file_get_contents($_FILES['receipt']['tmp_name']);
		date_default_timezone_set("Asia/Manila");
    	$date = date("F d, Y h:i:s A");

		$dbh = new PDO("mysql:host=localhost;dbnmame=slep_db", "root", "");
		$reg_stat = $dbh->prepare("update slep_db.registrations SET date_paid=?, account_number=?, account_name=?, payment_mode=?, p_status=?, receipt=?, mime=?, data=? where reg_id=?");
		$status = "PAID";
		$reg_stat->bindParam(1, $date);
		$reg_stat->bindParam(2, $account_number);
		$reg_stat->bindParam(3, $account_name);
		$reg_stat->bindParam(4, $select);
		$reg_stat->bindParam(5, $status);
		$reg_stat->bindParam(6, $receipt);
		$reg_stat->bindParam(7, $type);
		$reg_stat->bindParam(8, $data);
		$reg_stat->bindParam(9, $final);
				
		$reg_stat->execute();

		header("location: ../organization-payment.php");
		exit();
	}
}