<?php
	if(isset($_POST['submit'])){
		$id = isset($_GET['id'])? $_GET['id'] : "";
		$title = $_POST['title'];
		$content = $_POST['content'];

		if(empty($title) || empty($content)){
			header("location: ../organization-announcement.php?error=1&id=".$id);
			exit();
		}else{
			date_default_timezone_set("Asia/Manila");
    		$date = date("F d, Y h:i:s A");
			$dbh = new PDO("mysql:host=localhost;dbnmame=slep_db", "root", "");
			
			$announcement_stat = $dbh->prepare("insert into slep_db.announcements values('', ?, ?, ?, ?, ?)");

			$org_stat = $dbh->prepare("select * from slep_db.organizations where organization_id=?");
			$org_stat->bindParam(1, $id);
			$org_stat->execute();
			$org_row = $org_stat->fetch();

			$announcement_stat->bindParam(1, $org_row['organization_id']);
			$announcement_stat->bindParam(2, $org_row['organization_name']);
			$announcement_stat->bindParam(3, $title);
			$announcement_stat->bindParam(4, $content);
			$announcement_stat->bindParam(5, $date);
			$announcement_stat->execute();

			header("location: ../organization-announcement.php?id=".$id);
			exit();
		}
	}

	if(isset($_POST['save'])){
		$title = $_POST['title'];
		$content = $_POST['content'];

		if(empty($title) || empty($content)){
			header("location: ../osa-announcement.php?error=1");
			exit();
		}else{
			$id = "0";
			$name = "Office of Student Affairs";
			date_default_timezone_set("Asia/Manila");
    		$date = date("F d, Y h:i:s A");
			$dbh = new PDO("mysql:host=localhost;dbnmame=slep_db", "root", "");
			$announcement_stat = $dbh->prepare("insert into slep_db.announcements values('', ?, ?, ?, ?, ?)");

			$announcement_stat->bindParam(1, $id);
			$announcement_stat->bindParam(2, $name);
			$announcement_stat->bindParam(3, $title);
			$announcement_stat->bindParam(4, $content);
			$announcement_stat->bindParam(5, $date);
			$announcement_stat->execute();

			header("location: ../osa-announcement.php");
			exit();
		}
	}
