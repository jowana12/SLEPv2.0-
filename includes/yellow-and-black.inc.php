<?php

session_start();

if(!empty($_SESSION["student_id"]) || !empty($_SESSION["admin_id"])){
	header("location: ../yellow-and-black.php");
	exit();
}else{
	header("location: ../index.php");
	exit();
}