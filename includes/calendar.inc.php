<?php

if(isset($_POST['submit'])){

	$dbh = new PDO("mysql:host=localhost;dbnmame=slep_db", "root", "");
	$statement = $dbh->prepare("insert into slep_db.calendar values('', ?, ?, ?, ?, ?, ?, ?)");
	$date = $_POST['date'];
	$name = $_POST['name'];
	$desc = $_POST['description'];
	$venue = $_POST['venue'];
	$date_convert = strtotime($date);
    $date_year = date("Y", $date_convert);
    $date_month = date("m", $date_convert);
    $date_day = date("d", $date_convert);
    $month;

    switch($date_month){
    	case 1:
    		$month = "January";
    		break;
    	case 2:
    		$month = "February";
    		break;
    	case 3:
    		$month = "March";
    		break;
    	case 4:
    		$month = "April";
    		break;
    	case 5:
    		$month = "May";
    		break;
    	case 6:
    		$month = "June";
    		break;
    	case 7:
    		$month = "July";
    		break;
    	case 8:
    		$month = "August";
    		break;
    	case 9:
    		$month = "September";
    		break;
    	case 10:
    		$month = "October";
    		break;
    	case 11:
    		$month = "November";
    		break;
    	case 12:
    		$month = "December";
    		break;
    }

    $statement->bindParam(1, $name);
    $statement->bindParam(2, $desc);
    $statement->bindParam(3, $venue);
    $statement->bindParam(4, $date);
    $statement->bindParam(5, $date_year);
    $statement->bindParam(6, $month);
    $statement->bindParam(7, $date_day);

    $statement->execute();

    header("location: ../events-school-calendar.php");
    exit();
}