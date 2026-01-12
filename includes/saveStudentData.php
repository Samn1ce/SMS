<?php
include 'dbh.inc.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $arm_id = $_POST['arm_id'];
    $subjects = $_POST["subjects"] ?? [];
    $user_id = $_POST['user_id'];
    if ($user_id != $_SESSION['id']) {
        exit("Unauthorized");
    }

    if (empty($arm_id) || empty($user_id)) {
        header("Location: ../selectSubjects.php?error=empty");
        exit();
    }

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

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    mysqli_begin_transaction($conn);

    try {
        $deleteSql = "DELETE FROM student_subjects WHERE user_id = ?";
        $deleteStmt = mysqli_prepare($conn, $deleteSql);
        mysqli_stmt_bind_param($deleteStmt, "i", $user_id);
        mysqli_stmt_execute($deleteStmt);
        mysqli_stmt_close($deleteStmt);

        $sql = "UPDATE users SET arm_id = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ii", $arm_id, $user_id);
        mysqli_stmt_execute($stmt);


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
                $sql = "INSERT INTO student_subjects (user_id, subject_name, subject_id) VALUES (?, ?, ?)";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, "isi", $user_id, $subject_name, $subject_id);
                mysqli_stmt_execute($stmt);
            }
        }

        // Increase login_count again so modal won’t show next time
        $update = "UPDATE users SET login_count = login_count + 1 WHERE id = ?";
        $updateStmt = mysqli_prepare($conn, $update);
        mysqli_stmt_bind_param($updateStmt, "i", $user_id);
        mysqli_stmt_execute($updateStmt);
        mysqli_stmt_close($updateStmt);

        mysqli_commit($conn);

        header("Location: ../dashboard.php");
        exit();
    } catch (Exception $e) {
       // Rollback on error
        mysqli_rollback($conn);
        error_log($e->getMessage());
        header("Location: ../selectSubjects.php?error=1");
        exit();
    }
}