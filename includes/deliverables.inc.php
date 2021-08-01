<?php

$id = isset($_GET['id'])? $_GET['id'] : "";

if(isset($_POST['submit'])){
	$document = $_POST['document'];
	$docu = $_FILES['myfile']['name'];
	$mime = $_FILES['myfile']['type'];
	$consent = $_POST['consent'];

	if(empty($document) || empty($consent) || !file_exists($_FILES['myfile']['tmp_name'])){
		header("location: ../deliverables.php?id=".$id."&error=1");
		exit();
	}else{
		$data = file_get_contents($_FILES['myfile']['tmp_name']);
		$status = "PENDING";
		date_default_timezone_set("Asia/Manila");
	    $date = date("F d, Y h:i:s A");
	    $days = date("Y-m-d h:i:s");
		$dbh = new PDO("mysql:host=localhost;dbnmame=project", "root", "");

		$org_statement = $dbh->prepare("select * from slep_db.organizations where organization_id=?");
		$org_statement->bindParam(1, $id);
		$org_statement->execute();
		$org = $org_statement->fetch();

		$statement = $dbh->prepare("insert into slep_db.deliverables values('', ?, ?, ?, ?, ?, ?, ?, ?, ?, '')");
		$statement->bindParam(1, $org['organization_id']);
		$statement->bindParam(2, $org['organization_name']);
		$statement->bindParam(3, $docu);
		$statement->bindParam(4, $mime);
		$statement->bindParam(5, $data);
		$statement->bindParam(6, $status);
		$statement->bindParam(7, $date);
		$statement->bindParam(8, $document);
		$statement->bindParam(9, $days);

		$statement->execute();
		header("location: ../deliverables.php?id=".$id);
		exit();
	}
}
?>