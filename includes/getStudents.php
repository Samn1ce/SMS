<?php
//getStudents.php
include "dbh.inc.php";

$class_id = $_GET['class_id'];
$search = $_GET['search'] ?? '';

if (!$class_id) {
    echo json_encode([]);
    exit;
}   

$sql = "SELECT s.id, s.studentName AS name, c.class_name 
        FROM students s
        JOIN classes c ON s.class_id = c.id
        WHERE s.class_id = ? AND s.studentName LIKE ?";
$stmt = mysqli_prepare($conn, $sql);
$searchTerm = "%$search%";
mysqli_stmt_bind_param($stmt, "is", $class_id, $searchTerm);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$students = [];
while ($row = mysqli_fetch_assoc($result)) {
    $students[] = $row;
}

header('Content-Type: application/json');
echo json_encode($students);
