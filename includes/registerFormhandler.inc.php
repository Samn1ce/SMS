<?php
session_start();
include 'dbh.inc.php';

$email = $_POST["email"];
$pwd = $_POST["pwd"];
$confirmPwd = $_POST["confirmPwd"];
$surname = $_POST["surname"];
$firstname = $_POST["firstname"];
$othername = $_POST["othername"];
$role = $_POST["role"];
$class = $_POST["class_id"];
$gender = $_POST["gender"];
$dob = $_POST["dob"];

// Function to easily redirect with old input values
function redirectWithData($error, $email, $surname, $firstname, $othername) {
    $url = "../register.php?error=$error"
         . "&email=" . urlencode($email)
         . "&surname=" . urlencode($surname)
         . "&firstname=" . urlencode($firstname)
         . "&othername=" . urlencode($othername);
    header("Location: $url");
    exit();
}

// Validate all fields
if (empty($email) || empty($surname) || empty($firstname) || empty($pwd) || empty($confirmPwd) || empty($role) || empty($dob) || empty($gender)) {
    if ($role === "student") {
        redirectWithData("emptyfields", $email, $surname, $firstname, $othername, $role, $class);
    }
}

if ($role === "student" && empty($class)) {
    redirectWithData("emptyfields", $email, $surname, $firstname, $othername, $role, $class);
}

// Confirm password check
if ($pwd !== $confirmPwd) {
    redirectWithData("verifyconfirmpassword", $email, $surname, $firstname, $othername, $role, $class);
}

// Hash password
$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

// Choose table based on role
if ($role === "student") {
    $sql = "INSERT INTO users (email, pwd, surname, firstname, othername, class_id, roles, gender, dob) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
} elseif ($role === "teacher") {
    $sql = "INSERT INTO teachers (email, pwd, surname, firstname, othername, roles, gender, dob) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
} else {
    redirectWithData("emptyfields", $email, $email, $surname, $firstname, $othername, $class);
}

// Insert user data
$stmt = mysqli_prepare($conn, $sql);
if ($role === "student") {
    mysqli_stmt_bind_param($stmt, "sssssisss", $email, $hashedPwd, $surname, $firstname, $othername, $class, $role, $gender, $dob);
} else {
    mysqli_stmt_bind_param($stmt, "ssssssss", $email, $hashedPwd, $surname, $firstname, $othername, $role, $gender, $dob);

}

if (mysqli_stmt_execute($stmt)) {
    header("Location: ../login.php?register=success");
    exit();
} else {
    redirectWithData("sqlerror", $email, $email, $surname, $firstname, $othername, $role, $class);
}