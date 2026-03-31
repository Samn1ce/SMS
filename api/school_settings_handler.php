<?php
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/api-error.log');
error_reporting(E_ALL);

session_start();
require_once '../includes/dbh.inc.php';

header('Content-Type: application/json');

$school_id = (int) $_SESSION['school_id'];
$admin_id = (int) $_SESSION['id'];
$action = $_POST['action'] ?? '';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  echo json_encode(['success' => false, 'message' => 'Invalid request']);
  exit();
}

// ── Save active term + session ───────────────────────────────────────────────
if ($action === 'save_settings') {
  $term_id = (int) $_POST['term_id'];
  $session_id = (int) $_POST['session_id'];

  // verify session belongs to this school
  $check = mysqli_prepare($conn, 'SELECT id FROM sessions WHERE id = ? AND school_id = ?');
  mysqli_stmt_bind_param($check, 'ii', $session_id, $school_id);
  mysqli_stmt_execute($check);
  if (!mysqli_fetch_assoc(mysqli_stmt_get_result($check))) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit();
  }

  // verify term exists
  $check = mysqli_prepare($conn, 'SELECT id FROM terms WHERE id = ?');
  mysqli_stmt_bind_param($check, 'i', $term_id);
  mysqli_stmt_execute($check);
  if (!mysqli_fetch_assoc(mysqli_stmt_get_result($check))) {
    echo json_encode(['success' => false, 'message' => 'Invalid term']);
    exit();
  }

  // upsert — one row per school
  $stmt = mysqli_prepare(
    $conn,
    "
        INSERT INTO school_term_settings (school_id, admin_id, session_id, term_id)
        VALUES (?, ?, ?, ?)
        ON DUPLICATE KEY UPDATE
            admin_id = VALUES(admin_id),
            session_id = VALUES(session_id),
            term_id = VALUES(term_id),
            created_at = current_timestamp()
    ",
  );
  mysqli_stmt_bind_param($stmt, 'iiii', $school_id, $admin_id, $session_id, $term_id);

  if (!mysqli_stmt_execute($stmt)) {
    echo json_encode(['success' => false, 'message' => 'Failed to save settings']);
    exit();
  }

  echo json_encode(['success' => true, 'message' => 'Settings saved']);
  exit();
}

// ── Create new session ───────────────────────────────────────────────────────
if ($action === 'create_session') {
  $name = trim($_POST['session_name'] ?? '');

  // backend guard — catches anything that bypasses the frontend
  if (!preg_match('/^\d{4}\/\d{4}$/', $name)) {
    echo json_encode(['success' => false, 'message' => 'Format must be YYYY/YYYY e.g. 2025/2026']);
    exit();
  }

  // consecutive years check
  [$year_one, $year_two] = explode('/', $name);
  if ((int) $year_two !== (int) $year_one + 1) {
    echo json_encode(['success' => false, 'message' => 'Years must be consecutive e.g. 2025/2026']);
    exit();
  }

  // duplicate check
  $dup = mysqli_prepare($conn, 'SELECT id FROM sessions WHERE session_name = ? AND school_id = ?');
  mysqli_stmt_bind_param($dup, 'si', $name, $school_id);
  mysqli_stmt_execute($dup);
  if (mysqli_fetch_assoc(mysqli_stmt_get_result($dup))) {
    echo json_encode(['success' => false, 'message' => 'Session already exists']);
    exit();
  }

  $stmt = mysqli_prepare(
    $conn,
    'INSERT INTO sessions (school_id, admin_id, session_name) VALUES (?, ?, ?)',
  );
  mysqli_stmt_bind_param($stmt, 'iis', $school_id, $admin_id, $name);

  if (!mysqli_stmt_execute($stmt)) {
    echo json_encode(['success' => false, 'message' => 'Failed to create session']);
    exit();
  }

  $new_id = mysqli_insert_id($conn);
  echo json_encode([
    'success' => true,
    'session' => ['id' => $new_id, 'session_name' => $name, 'is_active' => 0],
  ]);
  exit();
}

echo json_encode(['success' => false, 'message' => 'Unknown action']);
