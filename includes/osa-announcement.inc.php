<?php

session_start();

if(!empty($_SESSION["admin_id"])){
	header("location: /SLEPv2.0/osa-announcement.php");
	exit();
}else{
	header("location: ../SLEPv2.0/index.php");
	exit();
}