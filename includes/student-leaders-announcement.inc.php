<?php

session_start();

if(!empty($_SESSION["student_id"])){
	header("location: ../student-leaders-announcement.php");
	exit();
}else{
	header("location: ../index.php");
	exit();
}