<?php
    session_start();

    $request_path = $_GET['path'] ?? 'dashboard';

    $allowed_paths = ['dashboard', 'assignment', 'result', 'profile', 'login', 'logout'];

    if (!in_array($request_path, $allowed_paths)) {
        $request_path = 'dashboard';
    }

    if (!isset($_SESSION['user_id']) && $request_path !== 'login') {
        header('Location: login.php');
        exit();
    }

    include 'app/layout.php';
?>