<?php

if(isset($_POST['cancel'])){
	$regid = $_POST['reg'];
	
		$dbh = new PDO("mysql:host=localhost;dbnmame=slep_db", "root", "");
		$reg_stat = $dbh->prepare("delete from slep_db.registrations where reg_id=?");
		$reg_stat->bindParam(1, $regid);
		
				
		$reg_stat->execute();

		header("location: ../organization-payment.php");
		exit();
	
}