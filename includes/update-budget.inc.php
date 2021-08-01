<?php
session_start();

$id = isset($_GET['id'])? $_GET['id'] : "";

if(isset($_POST['submit'])){
	$event = $_POST['event'];
	$description = $_POST['description'];
	$expenses = $_POST['expenses'];

	if(empty($event) || empty($description) || empty($expenses)){
		header("location: ../organization-budget.php?error=1&id=".$id);
		exit();
	}else{
		$dbh = new PDO("mysql:host=localhost;dbnmame=slep_db", "root", "");
		$statement = $dbh->prepare("select * from slep_db.organizations where organization_id=?");
		$statement->bindParam(1, $id);
		$statement->execute();
		$row = $statement->fetch();

		if($expenses > $row['budget']){
			header("location: ../organization-budget.php?error=2&id=".$id);
			exit();
		}else if($expenses < 1){
			header("location: ../organization-budget.php?error=3&id=".$id);
			exit();
		}else{
			$updated_expenses = $expenses + $row['expenses'];
			$updated_budget = $row['budget'] - $expenses;
			echo $updated_expenses . "<br>" . $updated_budget;

			$update_statement = $dbh->prepare("update slep_db.organizations set budget=?, expenses=? where organization_id=?");
			$update_statement->bindParam(1, $updated_budget);
			$update_statement->bindParam(2, $updated_expenses);
			$update_statement->bindParam(3, $id);
			$update_statement->execute();

			$user_statement = $dbh->prepare("select * from slep_db.users where id_number=?");
			$user_statement->bindParam(1, $_SESSION['student_id']);
			$user_statement->execute();
			$user = $user_statement->fetch();
			$name = $user['firstname'] . " " . $user['lastname'];

			date_default_timezone_set("Asia/Manila");
		    $date = date("F d, Y h:i:s A");

			$expense_statement = $dbh->prepare("insert into slep_db.expenses values('', ?, ?, ?, ?, ?, ?)");
			$expense_statement->bindParam(1, $id);
			$expense_statement->bindParam(2, $expenses);
			$expense_statement->bindParam(3, $name);
			$expense_statement->bindParam(4, $date);
			$expense_statement->bindParam(5, $event);
			$expense_statement->bindParam(6, $description);
			$expense_statement->execute();

			header("location: ../organization-budget.php?id=".$id);
			exit();
		}
	}
}