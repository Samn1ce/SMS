<?php
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/api-error.log');
error_reporting(E_ALL);

session_start();
require_once '../includes/dbh.inc.php';

header('Content-Type: application/json');

if (!isset($_SESSION['school_id'], $_SESSION['id'])) {
  echo json_encode(['success' => false, 'message' => 'Unauthorized']);
  exit();
}

$school_id = (int) $_SESSION['school_id'];
$admin_id = (int) $_SESSION['id'];
$action = $_POST['action'] ?? '';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  echo json_encode(['success' => false, 'message' => 'Invalid request']);
  exit();
}

function getNextSessionToGenerate()
{
  $year = date('Y');
  return $year + 1 . '/' . ($year + 2);
}

if ($action === 'auto_generate_session') {
  $month = date('n');

  if ($month != 7) {
    echo json_encode([
      'success' => false,
      'message' => 'This runs only in July',
    ]);
    exit();
  }

  $session_name = getNextSessionToGenerate();

  // Check if already exists (prevents duplicates)
  $check = mysqli_prepare($conn, 'SELECT id FROM sessions WHERE session_name = ?');
  mysqli_stmt_bind_param($check, 's', $session_name);
  mysqli_stmt_execute($check);
  $existing = mysqli_fetch_assoc(mysqli_stmt_get_result($check));

  if ($existing) {
    echo json_encode([
      'success' => true,
      'message' => 'Session already exists',
      'session' => $existing,
    ]);
    exit();
  }

  // Insert NEXT session (NOT ACTIVE)
  // $stmt = mysqli_prepare($conn, 'INSERT INTO sessions (session_name) VALUES (?)');
  // mysqli_stmt_bind_param($stmt, 's', $session_name);
  // mysqli_stmt_execute($stmt);

  echo json_encode([
    'success' => true,
    'message' => 'Next session generated (not active)',
    'session' => [
      'id' => mysqli_insert_id($conn),
      'session_name' => $session_name,
    ],
  ]);

  exit();
}

if ($action === 'create_session') {
  $name = trim($_POST['session_name'] ?? '');

  if (!preg_match('/^\d{4}\/\d{4}$/', $name)) {
    echo json_encode(['success' => false, 'message' => 'Format must be YYYY/YYYY']);
    exit();
  }

  [$y1, $y2] = explode('/', $name);

  if ((int) $y2 !== (int) $y1 + 1) {
    echo json_encode(['success' => false, 'message' => 'Years must be consecutive']);
    exit();
  }

  // Prevent duplicates
  $dup = mysqli_prepare($conn, 'SELECT id FROM sessions WHERE session_name = ?');
  mysqli_stmt_bind_param($dup, 's', $name);
  mysqli_stmt_execute($dup);

  if (mysqli_fetch_assoc(mysqli_stmt_get_result($dup))) {
    echo json_encode(['success' => false, 'message' => 'Session already exists']);
    exit();
  }

  // Insert
  $stmt = mysqli_prepare($conn, 'INSERT INTO sessions (session_name) VALUES (?)');
  mysqli_stmt_bind_param($stmt, 's', $name);
  mysqli_stmt_execute($stmt);

  echo json_encode([
    'success' => true,
    'session' => [
      'id' => mysqli_insert_id($conn),
      'session_name' => $name,
    ],
  ]);

  exit();
}

if ($action === 'save_settings') {
  $term_id = (int) $_POST['term_id'];
  $session_id = (int) $_POST['session_id'];

  mysqli_begin_transaction($conn);

  try {
    $stmt = mysqli_prepare(
      $conn,
      '
      UPDATE school_settings
      SET is_active = 0
      WHERE school_id = ? AND is_active = 1
    ',
    );
    mysqli_stmt_bind_param($stmt, 'i', $school_id);
    mysqli_stmt_execute($stmt);

    $stmt = mysqli_prepare(
      $conn,
      '
      INSERT INTO school_settings
      (school_id, admin_id, session_id, term_id, is_active)
      VALUES (?, ?, ?, ?, 1)
    ',
    );
    mysqli_stmt_bind_param($stmt, 'iiii', $school_id, $admin_id, $session_id, $term_id);
    mysqli_stmt_execute($stmt);

    mysqli_commit($conn);

    echo json_encode([
      'success' => true,
      'message' => 'Settings updated',
    ]);
  } catch (Exception $e) {
    mysqli_rollback($conn);

    echo json_encode([
      'success' => false,
      'message' => 'Failed to update settings',
    ]);
  }

  exit();
}

echo json_encode([
  'success' => false,
  'message' => 'Invalid action',
]);
