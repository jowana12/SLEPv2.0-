<?php

session_start();

if(!empty($_SESSION["student_id"])){
	header("location: ../student-dashboard.php");
	exit();
}else{
	header("location: ../studens-login.php");
	exit();
}