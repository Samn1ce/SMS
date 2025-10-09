<?php
session_start();
include 'dbh.inc.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $student_id = $_POST["student_id"];
    $subjects = $_POST["subjects"] ?? [];

    if (!empty($subjects)) {
        foreach ($subjects as $subject) {
            $sql = "INSERT INTO student_subjects (student_id, subject_name) VALUES (?, ?)";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "is", $student_id, $subject);
            mysqli_stmt_execute($stmt);
        }
    }

    // Increase login_count again so modal won’t show next time
    $update = "UPDATE students SET login_count = login_count + 1 WHERE id = ?";
    $stmt = mysqli_prepare($conn, $update);
    mysqli_stmt_bind_param($stmt, "i", $student_id);
    mysqli_stmt_execute($stmt);

    header("Location: ../studentDashboard.php?subjects=saved");
    exit();
}