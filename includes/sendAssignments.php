<?php
include 'dbh.inc.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $class_id = (int) $_POST['class_id'];
    $arm_id = empty($_POST['arm_id']) ? null : (int) $_POST['arm_id'];
    $subject_id = (int) $_POST['subject_id'];
    $description = trim($_POST['description']);
    $due_date = date('Y-m-d H:i:s', strtotime($_POST['due_date']));
    $id = (int) $_SESSION['id'];
    $role = $_SESSION['role'];

    if ($role !== 'teacher') {
        header("Location: ../assignment.php");
        exit;
    }

    if (!empty($class_id && $subject_id && $description && $due_date)) {
        if ($arm_id === null) {
            $sql = "
                INSERT INTO assignments 
                (user_id, class_id, arm_id, subject_id, description, due_date)
                VALUES (?, ?, NULL, ?, ?, ?)
            ";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "iiiss", $id, $class_id, $subject_id, $description, $due_date);
        } else {
            $sql = "
                INSERT INTO assignments 
                (user_id, class_id, arm_id, subject_id, description, due_date)
                VALUES (?, ?, ?, ?, ?, ?)
            ";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "iiiiss", $id, $class_id, $arm_id, $subject_id, $description, $due_date);
        }
        mysqli_stmt_execute($stmt);
        header("Location: ../assignment.php?assignment=sentout");
        exit;
    }
    header("Location: ../assignment.php?emptyfields");
}