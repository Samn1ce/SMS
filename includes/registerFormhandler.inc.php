<?php
session_start();
include 'dbh.inc.php';

$email = $_POST["email"];
$pwd = $_POST["pwd"];
$confirmPwd = $_POST["confirmPwd"];
$username = $_POST["username"];
$mname = $_POST["mname"];
$role = $_POST["role"];

// Function to easily redirect with old input values
function redirectWithData($error, $email, $username, $mname) {
    $url = "../register.php?error=$error" 
         . "&email=" . urlencode($email)
         . "&username=" . urlencode($username)
         . "&mname=" . urlencode($mname);
    header("Location: $url");
    exit();
}

// Validate all fields
if (empty($email) || empty($mname) || empty($pwd) || empty($confirmPwd) || empty($username) || empty($role)) {
    redirectWithData("emptyfields", $email, $username, $mname);
}

// Confirm password check
if ($pwd !== $confirmPwd) {
    redirectWithData("verifyconfirmpassword", $email, $username, $mname);
}

// Hash password
$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

// Choose table based on role
if ($role === "student") {
    $sql = "INSERT INTO students (username, studentName, email, pwd) VALUES (?, ?, ?, ?)";
} elseif ($role === "teacher") {
    $sql = "INSERT INTO teachers (username, teacherName, email, pwd) VALUES (?, ?, ?, ?)";
} else {
    redirectWithData("invalidrole", $email, $username, $mname);
}

// Insert user data
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ssss", $username, $mname, $email, $hashedPwd);

if (mysqli_stmt_execute($stmt)) {
    header("Location: ../login.php?register=success");
    exit();
} else {
    redirectWithData("sqlerror", $email, $username, $mname);
}