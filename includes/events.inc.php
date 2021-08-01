<?php

session_start();

if(!empty($_SESSION["student_id"]) || !empty($_SESSION["admin_id"])){
	header("location: /SLEPv2.0/events.php");
	exit();
}else{
	header("location: ../SLEPv2.0/index.php");
	exit();
}