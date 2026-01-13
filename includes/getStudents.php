<?php
include "dbh.inc.php";

$class_id = $_GET['class_id'];
$search = $_GET['search'] ?? '';

if (!$class_id) {
    echo json_encode([]);
    exit;
}

$sql = "SELECT u.id, CONCAT(
            u.firstname, ' ',
            u.surname, ' ',
            COALESCE(u.othername, '')
        ) AS full_name, c.class_name, ca.class_arm
            FROM users u
            JOIN classes c ON u.class_id = c.id
            JOIN class_arms ca ON u.arm_id = ca.id
            WHERE u.class_id = ?
            AND CONCAT(
                u.firstname, ' ',
                u.surname, ' ',
                COALESCE(u.othername, '')
            ) LIKE ?";
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
