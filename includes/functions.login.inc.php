<?php 

function emptyInputLogin($student_id, $student_user, $student_pwd){
	$result;

	if(empty($student_id) || empty($student_user) || empty($student_pwd)){
		$result = true;
	}else{
		$result = false;
	}

	return $result;
}

function usernameExists($conn, $student_id, $student_user){
	$sql = "SELECT * FROM users WHERE id_number=? AND username=?;";
	$stmt = mysqli_stmt_init($conn);

	if(!mysqli_stmt_prepare($stmt, $sql)){
		header("location: ../index.php?error=StatementFailed");
		exit();
	}else{
		mysqli_stmt_bind_param($stmt, "is", $student_id, $student_user);
		mysqli_stmt_execute($stmt);

		$resultData = mysqli_stmt_get_result($stmt);

		if($row = mysqli_fetch_assoc($resultData)){
			return $row;
		}else{
			$result = false;
			return $result;
		}
		mysqli_stmt_close($stmt);
	}
}

function loginUser($conn, $student_id, $student_user, $student_pwd){
	$userExists = usernameExists($conn, $student_id, $student_user);

	if($userExists === false){
		header("location: ../index.php?error=InvalidCredentials");
		exit();
	}else{
		$pwdHashed = $userExists["password"];
		$checkPwd = password_verify($student_pwd, $pwdHashed);

		if($checkPwd != $student_pwd){
			header("location: ../index.php?error=InvalidCredentials");
			exit();
		}else{
			session_start();
			$_SESSION["student_id"] = $userExists["id_number"];
			$_SESSION["type"] = $userExists["type"];
			if($userExists['type'] == "Student"){
				header("location: student-dashboard.inc.php");
				exit();
			}else if($userExists["type"] == "Student Leader"){
				header("location: student-leaders-dashboard.inc.php");
				exit();
			}
			
		}
	}
}

function adminExists($conn, $admin_id, $admin_user){
	$sql = "SELECT * FROM admins WHERE admin_id=? AND admin_user=?;";
	$stmt = mysqli_stmt_init($conn);

	if(!mysqli_stmt_prepare($stmt, $sql)){
		header("location: ../index.php?error=StatementFailed");
		exit();
	}else{
		mysqli_stmt_bind_param($stmt, "is", $admin_id, $admin_user);
		mysqli_stmt_execute($stmt);

		$resultData = mysqli_stmt_get_result($stmt);

		if($row = mysqli_fetch_assoc($resultData)){
			return $row;
		}else{
			$result = false;
			return $result;
		}
		mysqli_stmt_close($stmt);
	}
}

function loginAdmin($conn, $admin_id, $admin_user, $admin_pwd){
	$adminExists = adminExists($conn, $admin_id, $admin_user);

	if($userExists === false){
		header("location: ../index.php?error=InvalidCredentials");
		exit();
	}else{
		$pwdHashed = $adminExists["admin_password"];
		$checkPwd = password_verify($admin_pwd, $pwdHashed);

		if($pwdHashed != $admin_pwd){
			header("location: ../index.php?error=InvalidCredentials");
			exit();
		}else{
			session_start();
			$_SESSION["admin_id"] = $adminExists["admin_id"];
			header("location: osa-dashboard.inc.php");
			exit();
		}
	}
}