<?php

session_start();

if(!empty($_SESSION["student_id"])){
	header("location: /SLEPv2.0/student-leaders-announcement.php");
	exit();
}else{
	header("location: ../SLEPv2.0/students-login.php");
	exit();
}