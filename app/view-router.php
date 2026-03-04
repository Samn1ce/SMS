<?php
define('APP_ROOT', dirname(__DIR__));
session_start();

if (!isset($_SESSION['id'])) {
    http_response_code(401);
    exit('Unauthorized');
}

$view = $_GET['view'] ?? 'dashboard';
$slug = $_SESSION['school_slug'];

$allowed = ['dashboard', 'assignment', 'result', 'profile', 'attendance', 'viewStudents'];

if (!in_array($view, $allowed)) {
    http_response_code(404);
    exit('Not found');
}

$viewPath = __DIR__ . "/views/{$view}.php";

if (!file_exists($viewPath)) {
    http_response_code(404);
    exit('View file missing');
}

require $viewPath;