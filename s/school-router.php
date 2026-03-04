<?php
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/api/api-error.log');
error_reporting(E_ALL);

session_start();
require_once __DIR__ . '/../includes/dbh.inc.php';

$school_slug = $_GET['school'] ?? null;
$path = $_GET['path'] ?? 'login';

/* ── 1. Block missing slug ───────────────────────────── */
if (!$school_slug) {
  http_response_code(404);
  exit('Invalid school link');
}

/* ── 2. Verify school in DB ──────────────────────────── */
$stmt = mysqli_prepare($conn,
  "SELECT id, school_name FROM schools WHERE school_slug = ?"
);
mysqli_stmt_bind_param($stmt, "s", $school_slug);
mysqli_stmt_execute($stmt);
$school = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

if (!$school) {
  http_response_code(404);
  exit('School not found');
}

/* ── 3. Store school in session ──────────────────────── */
$_SESSION['school_id'] = $school['id'];
$_SESSION['school_slug'] = $school_slug;
$_SESSION['school_name'] = $school['school_name'];

/* ── 4. Valid SPA views ──────────────────────────────── */
$spa_views = ['dashboard', 'assignment', 'result', 'profile', 'attendance', 'viewStudents'];

/* ── 5. Detect AJAX request ──────────────────────────── */
$is_ajax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';

/* ── 6. Route ────────────────────────────────────────── */
switch ($path) {
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
        require __DIR__ . '/../selectSubjects.php';
    }
    break;

  case 'includes/logout.php':
    require __DIR__ . '/../includes/logout.php';
    break;

    default:
      if (!isset($_SESSION['id'])) {
        header("Location: /schoolManagementSystem/s/$school_slug/login");
        exit;
      }

      $view = in_array($path, $spa_views) ? $path : 'dashboard';

      if ($is_ajax) {
        define('APP_ROOT', dirname(__DIR__));
        $viewPath = APP_ROOT . "/app/views/{$view}.php";

        if (!file_exists($viewPath)) {
          http_response_code(404);
          exit('View not found');
        }
          
        require $viewPath;
      } else {
        $_GET['view'] = $view;
        require __DIR__ . '/../app/layout.php';
      }
      break;
}