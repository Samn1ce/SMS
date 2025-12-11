<?php
include 'dbh.inc.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $class = $_POST['class'];
    $class_arm = $_POST['class_arm'];
    $due_date = $_POST['due_date'];
    $description = $_POST['description'];
    $subject = $_POST['subject'];
    $id = $_SESSION['id'];
    $role = $_SESSION['role'];

    if (!empty($class) || !empty($class_arm) || !empty($due_date) || !empty($description) || !empty($subject)) {
        if ($role === 'teacher') {
            $sql = "INSERT INTO assignments (teacher_id, class_id, arm_id, subject_id, description, due_date) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "iiiiss", $id, $class, $class_arm, $subject, $description, $due_date);
            if (mysqli_stmt_execute($stmt)){
                header("Location: ../assignment.php?assignment=sentout");
            }
        } else {
            header("Location: ../assignment.php");
        }
    } else {
         header("Location: ../assignment.php?emptyfields");
    }
}