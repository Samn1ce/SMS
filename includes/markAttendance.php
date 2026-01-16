<?php
session_start();
require 'dbh.inc.php';

header('Content-Type: application/json');

// 1️⃣ Only teachers
if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'teacher') {
    http_response_code(403);
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

$student_id = $_POST['user_id'] ?? null;
$term_id = $_POST['term_id'] ?? null;
$status = $_POST['status'] ?? null; // present | absent
$teacher_id = $_SESSION['id'];

if (!$student_id || !$term_id || !in_array($status, ['present', 'absent'])) {
    echo json_encode(['error' => 'Invalid data']);
    exit;
}

// 2️⃣ Time window enforcement
$now = new DateTime();
$open = new DateTime('07:00');
$close = new DateTime('17:00');

if ($now < $open || $now > $close) {
    echo json_encode(['error' => 'Attendance window closed']);
    exit;
}

$today = date('Y-m-d');

// 3️⃣ Prevent re-marking
$check = mysqli_prepare(
    $conn,
    "SELECT id FROM attendance WHERE user_id = ? AND attendance_date = ?"
);
mysqli_stmt_bind_param($check, "is", $student_id, $today);
mysqli_stmt_execute($check);
mysqli_stmt_store_result($check);

if (mysqli_stmt_num_rows($check) > 0) {
    echo json_encode(['error' => 'Attendance already marked']);
    exit;
}

// 4️⃣ Insert attendance
$stmt = mysqli_prepare(
    $conn,
    "INSERT INTO attendance 
    (user_id, term_id, attendance_date, status, marked_by)
    VALUES (?, ?, ?, ?, ?)"
);
mysqli_stmt_bind_param(
    $stmt,
    "iissi",
    $student_id,
    $term_id,
    $today,
    $status,
    $teacher_id
);
mysqli_stmt_execute($stmt);

echo json_encode(['success' => true]);
