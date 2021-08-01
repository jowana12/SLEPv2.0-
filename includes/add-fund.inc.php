<?php

if(isset($_POST['submit'])){
	$org = $_POST['org'];
	$fund = $_POST['fund'];

	if($fund <= 0){
		header("location: ../osa-add-budget.php?error=1");
		exit();
	}else{
		if(empty($org) || empty($fund)){
			header("location: ../osa-add-budget.php?error=2");
			exit();
		}else{
			$dbh = new PDO("mysql:host=localhost;dbnmame=slep_db", "root", "");
			$organization = $dbh->prepare("select * from slep_db.organizations where organization_name=?");
			$organization->bindParam(1, $org);
			$organization->execute();
			$org_row = $organization->fetch();

			$fund = $fund + $org_row['budget'];
			$checker = 1;

			$org_stat = $dbh->prepare("update slep_db.organizations set budget=?, checker=? where organization_name=?");
			$org_stat->bindParam(1, $fund);
			$org_stat->bindParam(2, $checker);
			$org_stat->bindParam(3, $org);
			$org_stat->execute();

			header("location: ../osa-add-budget.php?success=1");
			exit();
	}
	}

	
}