<?php
session_start();

if(isset($_POST['submit'])){
	$pic = $_FILES['picture']['name'];
	$type = $_FILES['picture']['type'];

	if(empty($pic) || !file_exists($_FILES['picture']['tmp_name'])){
		header("location: ../students-profile.php?error=1");
		exit();
	}else{
		$data = file_get_contents($_FILES['picture']['tmp_name']);

		$dbh = new PDO("mysql:host=localhost;dbnmame=slep_db", "root", "");
		$reg_stat = $dbh->prepare("update slep_db.users SET profile_pic=?, mime=?, data=? where id_number=?");
		$reg_stat->bindParam(1, $pic);
		$reg_stat->bindParam(2, $type);
		$reg_stat->bindParam(3, $data);
		$reg_stat->bindParam(4, $_SESSION["student_id"]);
				
		$reg_stat->execute();

		header("location: ../students-profile.php");
		exit();
	}
}