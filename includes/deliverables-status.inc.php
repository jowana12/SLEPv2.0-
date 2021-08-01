<?php

session_start();
$id = isset($_GET['id'])? $_GET['id'] : "";
if(!empty($_SESSION["student_id"])){
	header("location: /SLEPv2.0/deliverables-status.php?id=".$id);
	exit();
}else{
	header("location: ../SLEPv2.0/index.php");
	exit();
}