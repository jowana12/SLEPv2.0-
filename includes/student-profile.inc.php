<?php

session_start();

if(!empty($_SESSION["student_id"])){
	header("location: ../students-profile.php");
	exit();
}else{
	header("location: ../students-login.php");
	exit();
}