<?php
session_start();

ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/api-error.log');
error_reporting(E_ALL);

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

require_once '../includes/dbh.inc.php';

// ── Auth guard ────────────────────────────────────────────────────────────────
if (!isset($_SESSION['id'], $_SESSION['school_id'], $_SESSION['role'])) {
  echo json_encode(['success' => false, 'message' => 'Unauthorised.']);
  exit();
}

if ($_SESSION['role'] !== 'admin') {
  echo json_encode(['success' => false, 'message' => 'Forbidden: admin access only.']);
  exit();
}

$adminId = (int) $_SESSION['id'];
$schoolId = (int) $_SESSION['school_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $data = json_decode(file_get_contents('php://input'), true);
  $action = $data['action'] ?? '';

  // ── ACTION: post_notice ───────────────────────────────────────────────────
  if ($action === 'post_notice') {
    $subject = trim($data['subject'] ?? '');
    $message = trim($data['message'] ?? '');
    $priority = trim($data['priority'] ?? 'normal');
    $expires_at = trim($data['expires_at'] ?? '');
    $audienceRaw = $data['audience'] ?? ['all'];

    // Resolve audience array → single ENUM value
    $audienceMap = [
      'all' => 'all',
      'students' => 'student',
      'student' => 'student',
      'teachers' => 'teacher',
      'teacher' => 'teacher',
    ];
    $normalised = array_unique(
      array_filter(array_map(fn($v) => $audienceMap[strtolower($v)] ?? null, $audienceRaw)),
    );
    $audience =
      count($normalised) >= 2 || in_array('all', $normalised, true)
        ? 'all'
        : $normalised[0] ?? 'all';

    // --- Validate ---
    if (empty($subject) || empty($message) || empty($expires_at)) {
      echo json_encode([
        'success' => false,
        'message' => 'Subject, message, and expiry date are required.',
      ]);
      exit();
    }

    if (mb_strlen($subject) > 255) {
      echo json_encode([
        'success' => false,
        'message' => 'Subject must be 255 characters or fewer.',
      ]);
      exit();
    }

    if (mb_strlen($message) > 500) {
      echo json_encode([
        'success' => false,
        'message' => 'Message must be 500 characters or fewer.',
      ]);
      exit();
    }

    if (!in_array($priority, ['normal', 'urgent', 'critical'], true)) {
      echo json_encode([
        'success' => false,
        'message' => 'Invalid priority value.',
      ]);
      exit();
    }

    if (!in_array($audience, ['all', 'student', 'teacher'], true)) {
      echo json_encode([
        'success' => false,
        'message' => 'Invalid audience value.',
      ]);
      exit();
    }

    $expiry = DateTimeImmutable::createFromFormat('Y-m-d', $expires_at);
    $today = new DateTimeImmutable('today');

    if (!$expiry || $expiry->format('Y-m-d') !== $expires_at) {
      echo json_encode([
        'success' => false,
        'message' => 'Invalid expiry date format. Use YYYY-MM-DD.',
      ]);
      exit();
    }

    if ($expiry < $today) {
      echo json_encode([
        'success' => false,
        'message' => 'Expiry date cannot be in the past.',
      ]);
      exit();
    }

    // --- Insert ---
    mysqli_begin_transaction($conn);

    try {
      $stmt = mysqli_prepare(
        $conn,
        "
            INSERT INTO notice (school_id, admin_id, subject, message, audience, priority, expires_at)
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ",
      );
      mysqli_stmt_bind_param(
        $stmt,
        'iisssss',
        $schoolId,
        $adminId,
        $subject,
        $message,
        $audience,
        $priority,
        $expires_at,
      );

      if (!mysqli_stmt_execute($stmt)) {
        throw new Exception('Failed to post notice.');
      }

      $newId = mysqli_insert_id($conn);

      mysqli_commit($conn);

      echo json_encode([
        'success' => true,
        'message' => 'Notice posted successfully.',
        'data' => [
          'id' => $newId,
          'subject' => $subject,
          'audience' => $audience,
          'priority' => $priority,
          'expires_at' => $expires_at,
          'posted_at' => date('Y-m-d H:i:s'),
        ],
      ]);
    } catch (Exception $e) {
      mysqli_rollback($conn);
      echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }

    // ── ACTION: delete_notice ─────────────────────────────────────────────────
  } elseif ($action === 'delete_notice') {
    $id = (int) ($data['id'] ?? 0);

    if ($id <= 0) {
      echo json_encode(['success' => false, 'message' => 'A valid notice ID is required.']);
      exit();
    }

    try {
      // Verify ownership before deleting
      $stmt = mysqli_prepare(
        $conn,
        "
            SELECT id FROM notice WHERE id = ? AND school_id = ? AND admin_id = ?
        ",
      );
      mysqli_stmt_bind_param($stmt, 'iii', $id, $schoolId, $adminId);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_store_result($stmt);

      if (mysqli_stmt_num_rows($stmt) === 0) {
        echo json_encode(['success' => false, 'message' => 'Notice not found or access denied.']);
        exit();
      }

      $del = mysqli_prepare($conn, 'DELETE FROM notice WHERE id = ?');
      mysqli_stmt_bind_param($del, 'i', $id);

      if (!mysqli_stmt_execute($del)) {
        throw new Exception('Failed to delete notice.');
      }

      echo json_encode(['success' => true, 'message' => 'Notice deleted successfully.']);
    } catch (Exception $e) {
      echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }

    // ── Unknown action ────────────────────────────────────────────────────────
  } else {
    echo json_encode(['success' => false, 'message' => 'Invalid action.']);
  }
}
