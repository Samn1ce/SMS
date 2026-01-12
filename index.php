<?php
    session_start();

    $request_path = $_GET['path'] ?? 'dashboard';

    $allowed_paths = ['dashboard', 'assignment', 'result', 'profile', 'viewStudents', 'login', 'logout'];

    if (!in_array($request_path, $allowed_paths)) {
        $request_path = 'dashboard';
    }

    if (!isset($_SESSION['id']) && $request_path !== 'login') {
        header('Location: login.php');
        exit();
    }

    include 'app/layout.php';
?>