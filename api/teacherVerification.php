<?php
session_start();
include 'dbh.inc.php';

header('Content-Type: application/json');

function respond(bool $success, string $message, int $code = 200): void
{
  http_response_code($code);
  echo json_encode(['success' => $success, 'message' => $message]);
  exit();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  respond(false, 'Method not allowed', 405);
}

if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'admin') {
  respond(false, 'Unauthorized', 403);
}

$data = json_decode(file_get_contents('php://input'), true);
$action = $data['action'] ?? '';
$teacher_id = (int) ($data['teacher_id'] ?? 0);
$school_id = $_SESSION['school_id'];

if (!$teacher_id || !in_array($action, ['accept', 'reject'])) {
  respond(false, 'Invalid request', 400);
}

if ($action === 'accept') {
  $sql = "UPDATE users SET status = 'accepted' 
             WHERE id = ? AND school_id = ? AND roles = 'teacher' AND status = 'pending'";
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_bind_param($stmt, 'ii', $teacher_id, $school_id);
  mysqli_stmt_execute($stmt);

  if (mysqli_stmt_affected_rows($stmt) === 0) {
    respond(false, 'Teacher not found or already processed', 404);
  }

  respond(true, 'Teacher accepted successfully');
} elseif ($action === 'reject') {
  $sql = "DELETE FROM users 
             WHERE id = ? AND school_id = ? AND roles = 'teacher' AND status = 'pending'";
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_bind_param($stmt, 'ii', $teacher_id, $school_id);
  mysqli_stmt_execute($stmt);

  if (mysqli_stmt_affected_rows($stmt) === 0) {
    respond(false, 'Teacher not found or already processed', 404);
  }

  respond(true, 'Teacher request rejected');
}
