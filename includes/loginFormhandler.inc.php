<?php
session_start();
require 'dbh.inc.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $pwd = $_POST['pwd'];

    $sql = "SELECT users.*, classes.class_name, class_arms.class_arm
            FROM users
            LEFT JOIN classes ON users.class_id = classes.id 
            LEFT JOIN class_arms ON users.arm_id = class_arms.id
            WHERE users.email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if (!$row = mysqli_fetch_assoc($result)) {
        header("Location: ../login.php?error=invalidcredentials");
        exit();
    }

    if (!password_verify($pwd, $row['pwd'])) {
        header("Location: ../login.php?error=invalidcredentials");
        exit();
    }

    $_SESSION['id'] = $row['id'];
    $_SESSION['role'] = $row['roles'];
    $_SESSION["gender"] = $row['gender'];
    $_SESSION['dob'] = $row['dob'];
    $_SESSION['class_name'] = $row['class_name'] ?? 'Not Assigned';
    $_SESSION['class_id'] = $row['class_id'];
    $_SESSION['class_arm'] = $row['class_arm'];
    $_SESSION['arm_id'] = $row['arm_id'];
    $_SESSION["surname"] = $row["surname"];
    $_SESSION["firstname"] = $row["firstname"];
    $_SESSION["othername"] = $row["othername"];
    $login_count = (int)$row['login_count'];

    if ($login_count === 0 && $row['roles'] === 'student') {
        header("Location: ../selectSubjects.php");
        exit();
    }

    header("Location: ../dashboard.php");
    exit();
}