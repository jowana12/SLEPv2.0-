<?php

$id = isset($_GET['id'])? $_GET['id'] : "";
$dbh = new PDO("mysql:host=localhost;dbnmame=slep_db", "root", "");
$remarks = $_POST['remarks'];
date_default_timezone_set("Asia/Manila");
$date = date("F d, Y h:i:s A");

if(isset($_POST['submit'])){
	if(empty($remarks)){
		$remarks = "NONE";
	}
	$status = "APPROVED";

	$statement = $dbh->prepare("update slep_db.reservations set status=?, date_checked=?, remarks=? where reservation_id=?");
	$statement->bindParam(1, $status);
	$statement->bindParam(2, $date);
	$statement->bindParam(3, $remarks);
	$statement->bindParam(4, $id);
	$statement->execute();

	header("location: ../osa-approval-venue.php");
	exit();
}

if(isset($_POST['delete'])){
	if(empty($remarks)){
		$remarks = "NONE";
	}
	$status = "UNAPPROVED";

	$statement = $dbh->prepare("update slep_db.reservations set status=?, date_checked=?, remarks=? where reservation_id=?");
	$statement->bindParam(1, $status);
	$statement->bindParam(2, $date);
	$statement->bindParam(3, $remarks);
	$statement->bindParam(4, $id);
	$statement->execute();

	header("location: ../osa-approval-venue.php");
	exit();
}