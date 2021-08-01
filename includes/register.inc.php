<?php

if(isset($_POST['submit'])){
	session_start();

	$abb = $_POST['org'];
	$dbh = new PDO("mysql:host=localhost;dbnmame=slep_db", "root", "");

	$reg_stat = $dbh->prepare("insert into slep_db.registrations values ('', ?, ?, ?, ?, '', '', '', '', ?, '', '', '')");

	$org_stat = $dbh->prepare("select *  from slep_db.organizations where organization_abb=?");
	$org_stat->bindParam(1, $abb);
	$org_stat->execute();
	$org_row = $org_stat->fetch();

    date_default_timezone_set("Asia/Manila");
    $date = date("F d, Y h:i:s A");
    $status = "PENDING";
	$reg_stat->bindParam(1, $_SESSION['student_id']);
	$reg_stat->bindParam(2, $org_row['organization_id']);
	$reg_stat->bindParam(3, $org_row['organization_name']);
	$reg_stat->bindParam(4, $date);
	$reg_stat->bindParam(5, $status);
	$reg_stat->execute();

	header("location: ../organization-payment.php");
	exit();

	echo "SUCCESS";
}