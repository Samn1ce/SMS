<?php
define('APP_ROOT', dirname(__DIR__));
session_start();

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    exit('Unauthorized');
}

$view = $_GET['view'] ?? 'dashboard';

$allowed = ['dashboard', 'assignment', 'result', 'student'];

if (!in_array($view, $allowed)) {
    http_response_code(404);
    exit('Not found');
}

require __DIR__ . "/views/{$view}.php";
