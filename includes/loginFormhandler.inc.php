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
    $sql = "SELECT * FROM students WHERE email = ?";
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
        $_SESSION["username"] = $row["username"];
        $_SESSION["student_name"] = $row["studentName"];
        $_SESSION["role"] = $role;

        // Redirect to correct dashboard
        if ($role === "student") {
            $loginStmt = mysqli_prepare($conn, "SELECT login_count FROM students WHERE id = ?");
            mysqli_stmt_bind_param($loginStmt, "i", $row['id']);
            mysqli_stmt_execute($loginStmt);
            $result = mysqli_stmt_get_result($loginStmt);
            $row = mysqli_fetch_assoc($result);
            if ($row["login_count"] < 1) {
                header("Location: ../selectSubjects.php");
            } else {
                header("Location: ../studentDashboard.php");
            }
        } else {
            header("Location: ../teacherDashboard.php");
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
