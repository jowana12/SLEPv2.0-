<?php

function emptyInputRegister($student_number, $student_firstname, $student_middlename, $student_lastname, $student_program, $student_year, $student_type, $student_email, $student_password, $student_confirm_password) {
    $result;

    if (empty($student_number) || empty($student_firstname) || empty($student_middlename) || empty($student_lastname) || empty($student_program) || empty($student_year) || empty($student_type) || empty($student_email) || empty($student_password) || empty($student_confirm_password)) {
        $result = true;
    } else {
        $result = false;
    }

    return $result;
}