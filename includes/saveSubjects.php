<?php
session_start();
include 'dbh.inc.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $student_id = $_POST["student_id"];
    $subjects = $_POST["subjects"] ?? [];

     // Get core subject IDs (Mathematics and English)
    $coreQuery = "SELECT id FROM subjects WHERE subject_name IN ('Mathematics', 'English')";
    $coreResult = mysqli_query($conn, $coreQuery);
    $coreSubjects = [];
    while ($row = mysqli_fetch_assoc($coreResult)) {
        $coreSubjects[] = $row['id'];
    }
    
    // Force-add core subjects to ensure they're always included
    // This protects against form tampering or accidental removal
    $subjects = array_unique(array_merge($subjects, $coreSubjects));

    mysqli_begin_transaction($conn);

    try {
        $deleteSql = "DELETE FROM student_subjects WHERE student_id = ?";
        $deleteStmt = mysqli_prepare($conn, $deleteSql);
        mysqli_stmt_bind_param($deleteStmt, "i", $student_id);
        mysqli_stmt_execute($deleteStmt);
        mysqli_stmt_close($deleteStmt);

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
        $updateStmt = mysqli_prepare($conn, $update);
        mysqli_stmt_bind_param($updateStmt, "i", $student_id);
        mysqli_stmt_execute($updateStmt);
        mysqli_stmt_close($updateStmt);

        mysqli_commit($conn);

        header("Location: ../studentDashboard.php");
        exit();
    } catch (Exception $e) {
       // Rollback on error
        mysqli_rollback($conn);
        header("Location: ../selectSubject.php?error=1");
        exit();
    }
}