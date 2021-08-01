<?php
$id = isset($_GET['id'])? $_GET['id'] : "";

if(isset($_POST['submit'])){
	$nature = $_POST['org'];
	$title = $_POST['title'];
	$date_from = $_POST['date_from'];
	$date_to = $_POST['date_to'];
	$attendees = $_POST['attendees'];
	$venue = $_POST['venue'];
	$poster = $_FILES['poster']['name'];
	$mime = $_FILES['poster']['type'];

	if(empty($nature) || empty($title) || empty($date_from) || empty($date_to) || empty($attendees) || empty($venue) || !file_exists($_FILES['poster']['tmp_name'])){
		header("location: ../organization-reserve.php?id=".$id."&error=1");
		exit();
	}else{
		$data = file_get_contents($_FILES['poster']['tmp_name']);
		date_default_timezone_set("Asia/Manila");
	    $date = date("F d, Y h:i:s A");
	    $days = date("Y-m-d h:i:s");
	    $status = "PENDING";
		$dbh = new PDO("mysql:host=localhost;dbnmame=slep_db", "root", "");
		$org_stat = $dbh->prepare("select * from slep_db.organizations where organization_id=?");
		$org_stat->bindParam(1, $id);
		$org_stat->execute();
		$org_row = $org_stat->fetch();

		$statement = $dbh->prepare("insert into slep_db.reservations values('', ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '', ?, ?, '')");
		$statement->bindParam(1, $org_row['organization_id']);
		$statement->bindParam(2, $org_row['organization_name']);
		$statement->bindParam(3, $nature);
		$statement->bindParam(4, $date_from);
		$statement->bindParam(5, $date_to);
		$statement->bindParam(6, $attendees);
		$statement->bindParam(7, $venue);
		$statement->bindParam(8, $poster);
		$statement->bindParam(9, $mime);
		$statement->bindParam(10, $data);
		$statement->bindParam(11, $status);
		$statement->bindParam(12, $date);
		$statement->bindParam(13, $title);
		$statement->bindParam(14, $days);

		$statement->execute();


		header("location: ../organization-reserve.php?id=".$id);
		exit();
	
		
	}
		
}