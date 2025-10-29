<?php
session_start();
include 'dbh.inc.php';

$email = $_POST["email"];
$pwd = $_POST["pwd"];
$confirmPwd = $_POST["confirmPwd"];
$username = $_POST["username"];
$mname = $_POST["mname"];
$role = $_POST["role"];
$class = $_POST["class_id"];
$gender = $_POST["gender"];
$dob = $_POST["dob"];

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
if (empty($email) || empty($mname) || empty($pwd) || empty($confirmPwd) || empty($username) || empty($role) || empty($dob) || empty($gender)) {
    if ($role === "student") {
        redirectWithData("emptyfields", $email, $username, $mname, $role, $class);
    }
}

if ($role === "student" && empty($class)) {
    redirectWithData("emptyfields", $email, $username, $mname, $role, $class);
}

// Confirm password check
if ($pwd !== $confirmPwd) {
    redirectWithData("verifyconfirmpassword", $email, $username, $mname, $role, $class);
}

// Hash password
$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

// Choose table based on role
if ($role === "student") {
    $sql = "INSERT INTO students (username, studentName, email, pwd, class_id, gender, dob) VALUES (?, ?, ?, ?, ?, ?, ?)";
} elseif ($role === "teacher") {
    $sql = "INSERT INTO teachers (username, teacherName, email, pwd, gender, dob) VALUES (?, ?, ?, ?, ?, ?)";
} else {
    redirectWithData("invalidrole", $email, $username, $mname, $role, $class);
}

// Insert user data
$stmt = mysqli_prepare($conn, $sql);
if ($role === "student") {
    mysqli_stmt_bind_param($stmt, "ssssiss", $username, $mname, $email, $hashedPwd, $class, $gender, $dob);
} else {
    mysqli_stmt_bind_param($stmt, "ssssss", $username, $mname, $email, $hashedPwd, $gender, $dob);

}

if (mysqli_stmt_execute($stmt)) {
    header("Location: ../login.php?register=success");
    exit();
} else {
    redirectWithData("sqlerror", $email, $username, $mname, $role, $class);
}