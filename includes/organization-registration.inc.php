<?php

session_start();

if(!empty($_SESSION["student_id"])){
	header("location: /SLEPv2.0/organization-registration.php");
	exit();
}else{
	header("location: ../SLEPv2.0/index.php");
	exit();
}