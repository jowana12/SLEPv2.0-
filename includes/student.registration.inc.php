<?php
    if (isset($_POST['submit'])) {
        require_once 'connection.inc.php';
        require_once 'functions.registration.inc.php';

        $student_number = $_POST['student_number'];
        $student_firstname = $_POST['student_firstname'];
        $student_middlename = $_POST['student_middlename'];
        $student_lastname = $_POST['student_lastname'];
        $student_program = $_POST['student_program'];
        $student_year= $_POST['student_year'];
        $student_type = $_POST['student_type'];
        $student_email = $_POST['student_email'];
        $student_password = $_POST['student_password'];
        $student_confirm_password = $_POST['student_confirm_password'];

        if (emptyInputRegister($student_number, $student_firstname, $student_middlename, $student_lastname, $student_program, $student_year, $student_type, $student_email, $student_password, $student_confirm_password) !== false) {
            header("location: ../student-registration.php?error=EmptyInput");
            exit();
        } else if ($student_password !== $student_confirm_password) {
            header("location: ../student-registration.php?error=PasswordDoNotMatch");
            exit();
        } else if (!isset($_POST['terms-conditions'])) {
            header("location: ../student-registration.php?error=TermsConditions");
            exit();
        } else {
            $sql = "SELECT * FROM users WHERE id_number = ? AND username = ?;";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("location: ../student-registration.php?error=SqlError");
                exit();
            } else {
                mysqli_stmt_bind_param($stmt, "is", $student_number, $student_email);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                $rowCount = mysqli_stmt_num_rows($stmt);

                if ($rowCount > 0) {
                    header("location: ../student-registration.php?error=UsernameTaken");
                    exit();
                } else {
                    $sql = "INSERT INTO users (id_number, username, password, firstname, middlename, lastname, program, year_level, type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);";
                    $stmt = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                        header("location: ../student-registration.php?error=SqlError");
                        exit();
                    } else {
                        $hashedPass = password_hash($student_password, PASSWORD_DEFAULT);

                        mysqli_stmt_bind_param($stmt, "issssssss", $student_number, $student_email, $hashedPass, $student_firstname, $student_middlename, $student_lastname, $student_program, $student_year, $student_type);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_store_result($stmt);
                            header("location: ../student-registration.php?success=Registered");
                            exit();
                }
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}