<?php
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . 'api/api-error.log');
error_reporting(E_ALL);

session_start();
require_once __DIR__ . '/../includes/dbh.inc.php';

$school_slug = $_GET['school'] ?? null;
$path = $_GET['path'] ?? 'login';

/* 1️⃣ Block invalid links */
if (!$school_slug) {
  http_response_code(404);
  exit('Invalid school link');
}

/* 2️⃣ Verify school */
$stmt = mysqli_prepare(
  $conn,
  "SELECT id, school_name FROM schools WHERE school_slug = ?"
);
mysqli_stmt_bind_param($stmt, "s", $school_slug);
mysqli_stmt_execute($stmt);
$school = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

if (!$school) {
  http_response_code(404);
  exit('School not found');
}

/* 3️⃣ Store school context */
$_SESSION['school_id']   = $school['id'];
$_SESSION['school_slug'] = $school_slug;
$_SESSION['school_name'] = $school['school_name'];

switch ($path) {

    // 🔓 Standalone (not logged in)
    case 'login':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          require __DIR__ . '/../includes/loginFormHandler.inc.php';
        } else {
          require __DIR__ . '/../auth/login.php';
        }
        break;

    case 'register':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          require __DIR__ . '/../includes/registerFormHandler.inc.php';
        } else {
          require __DIR__ . '/../auth/register.php';
        }
        break;

    case 'selectSubjects':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          require __DIR__ . '/../includes/saveStudentData.php';
        } else {
          require __DIR__ . '/../includes/saveStudentData.php';
        }
        require __DIR__ . '/../auth/selectSubjects.php';
        break;

    // 🔐 Logged-in area
    default:
      if (!isset($_SESSION['id'])) {
          header("Location: /schoolManagementSystem/s/$school_slug/login");
          exit;
      }
      require __DIR__ . '/../app/view-router.php';
}