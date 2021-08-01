<?php
$dbh = new PDO("mysql:host=localhost;dbnmame=project", "root", "");
$id = isset($_GET['id'])? $_GET['id'] : "";
$stat = $dbh->prepare("select * from slep_db.events where event_id=?");
$stat->bindParam(1, $id);
$stat->execute();
$row = $stat->fetch();

if($row['event_name'] == "Yellow and Black Festival"){
	header("location: yellow-and-black.inc.php");
	exit();
}else{
	header("location: ../events-details.php");
	exit();
}