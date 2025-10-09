<?php
include 'dbh.inc.php';

// Reset login_count for all students
mysqli_query($conn, "UPDATE students SET login_count = 0");

// Delete all subjects selected
mysqli_query($conn, "DELETE FROM student_subjects");

mysqli_query($conn, "DELETE FROM students");

mysqli_query($conn, "DELETE FROM teachers");

echo "✅ All student login counts reset and subjects cleared successfully.";
