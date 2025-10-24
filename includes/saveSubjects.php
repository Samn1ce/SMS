<?php
session_start();
include 'dbh.inc.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $student_id = $_POST["student_id"];
    $subject_id = $_POST['subject_id'];
    $subjects = $_POST["subjects"] ?? [];

    if (!empty($subjects)) {
        foreach ($subjects as $subject_id) {
            // Fetch subject name using the subject ID
            $query = "SELECT subject_name FROM subjects WHERE id = ?";
            $stmt_name = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt_name, "i", $subject_id);
            mysqli_stmt_execute($stmt_name);
            $result = mysqli_stmt_get_result($stmt_name);
            $row = mysqli_fetch_assoc($result);
            $subject_name = $row['subject_name'];

            // Insert both subject_id and subject_name into student_subjects
            $sql = "INSERT INTO student_subjects (student_id, subject_name, subject_id) VALUES (?, ?, ?)";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "isi", $student_id, $subject_name, $subject_id);
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