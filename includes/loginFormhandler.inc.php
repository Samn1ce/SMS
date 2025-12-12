<?php
session_start();
include 'dbh.inc.php';

$email = $_POST["email"];
$pwd = $_POST["pwd"];
$role = $_POST["role"];

// Check for empty fields
if (empty($email) || empty($pwd) || empty($role)) {
    header("Location: ../login.php?error=emptyfields");
    exit();
}

// Choose correct table based on role
if ($role === "student") {
    $sql = "SELECT students.*, classes.class_name 
            FROM students 
            LEFT JOIN classes ON students.class_id = classes.id 
            WHERE students.email = ?";
} elseif ($role === "teacher") {
    $sql = "SELECT * FROM teachers WHERE email = ?";
} else {
    header("Location: ../login.php?error=invalidrole");
    exit();
}

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $email); 
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($row = mysqli_fetch_assoc($result)) {
    // Verify password
    if (password_verify($pwd, $row["pwd"])) {
        $_SESSION["user_id"] = $row["id"];
        $_SESSION["role"] = $role;
        $_SESSION["gender"] = $row['gender'];
        $_SESSION['dob'] = $row['dob'];
        $_SESSION['class_name'] = $row['class_name'] ?? 'Not Assigned';


        // Redirect to correct dashboard
        if ($role === "student") {
        $_SESSION["surname"] = $row["student_surname"];
        $_SESSION["firstname"] = $row["student_firstname"];
        $_SESSION["othername"] = $row["student_othername"];

            $loginStmt = mysqli_prepare($conn, "SELECT login_count FROM students WHERE id = ?");
            mysqli_stmt_bind_param($loginStmt, "i", $row['id']);
            mysqli_stmt_execute($loginStmt);
            $result = mysqli_stmt_get_result($loginStmt);
            $row = mysqli_fetch_assoc($result);
            if ($row["login_count"] < 1) {
                header("Location: ../selectSubjects.php");
            } else {
                header("Location: ../dashboard.php");
            }
        } else {
            $_SESSION["surname"] = $row["teacher_surname"];
            $_SESSION["firstname"] = $row["teacher_firstname"];
            $_SESSION["othername"] = $row["teacher_othername"];
            header("Location: ../dashboard.php");
        }
        exit();
    } else {
        header("Location: ../login.php?error=invalidcredentials");
        exit();
    }
} else {
    header("Location: ../login.php?error=invalidcredentials");
    exit();
}
