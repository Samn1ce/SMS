<?php
define('APP_ROOT', dirname(__DIR__));
// session_start();

if (!isset($_SESSION['id'])) {
    http_response_code(401);
    exit('Unauthorized');
}

$view = $_GET['path'] ?? 'dashboard';

$allowed = ['dashboard', 'assignment', 'result', 'profile', 'attendance', 'viewStudents'];

if (!in_array($view, $allowed)) {
    http_response_code(404);
    exit('Not found');
}

ob_start(); 

// 2. Include the view (HTML goes into the buffer, not the screen)
require __DIR__ . "/views/{$view}.php";

// 3. Capture the buffer into a variable
$content = ob_get_clean();

// 4. Pass that content to the layout
require __DIR__ . '/layout.php';