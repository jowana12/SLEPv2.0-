<?php

session_start();

if(!empty($_SESSION["student_id"])){
	header("location: ../student-announcement.php");
	exit();
}else{
	header("location: ../students-login.php");
	exit();
}