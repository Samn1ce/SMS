<?php
include 'dbh.inc.php';

mysqli_query($conn, "UPDATE users SET login_count = 0");

// Delete all subjects selected
mysqli_query($conn, "DELETE FROM student_subjects");

mysqli_query($conn, "DELETE FROM users");

mysqli_query($conn, "DELETE FROM student_subjects");

mysqli_query($conn, "DELETE FROM results");

mysqli_query($conn, "DELETE FROM attendance");

mysqli_query($conn, "DELETE FROM assignments");

mysqli_query($conn, "DELETE FROM schools");

echo "✅ All school management system database reset successfully.";
