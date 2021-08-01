<?php

if(isset($_POST['submit'])){
	$abb = $_POST['abb'];
	$name = $_POST['name'];
	$desc = $_POST['desc'];
	$logo = $_FILES['logo']['name'];
	$mime = $_FILES['logo']['type'];

	if(empty($abb) || empty($name) || empty($desc) || !file_exists($_FILES['logo']['tmp_name'])){
		header("location: ../osa-add-organization.php?error=1");
		exit();
	}else{
		$data = file_get_contents($_FILES['logo']['tmp_name']);
		$dbh = new PDO("mysql:host=localhost;dbnmame=slep_db", "root", "");
		$statement = $dbh->prepare("insert into slep_db.organizations values('', ?, ?, ?, ?, ?, ?, ?, '', '','')");
		$statement->bindParam(1, $name);
		$statement->bindParam(2, $abb);
		$statement->bindParam(3, $desc);
		$statement->bindParam(4, $logo);
		$statement->bindParam(5, $mime);
		$statement->bindParam(6, $data);
		$statement->bindParam(7, $data);

		$statement->execute();

		header("location: ../osa-add-organization.php");
		exit();
	}
	

}