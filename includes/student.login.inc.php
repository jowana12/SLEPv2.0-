<?php

if (isset($_POST['submit-student'])) {
	require_once 'connection.inc.php';
	require_once 'functions.login.inc.php';

    $student_id = $_POST['student_number'];
    $student_user = $_POST['student_email'];
    $student_pwd = $_POST['student_password'];

    if(emptyInputLogin($student_id, $student_user, $student_pwd) !== false){
		header("location: ../index.php?error=EmptyInput");
		exit();
	}

    loginUser($conn, $student_id, $student_user, $student_pwd);
} else {
    header("location: ../index.php");
	exit();
}