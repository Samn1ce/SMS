<?php
    session_start();

    // if(!$_SESSION['id']) {
    //     header("Location: login.php");
    // };
    $request_path = $_GET['path'] ?? 'dashboard';

    // Define allowed paths and what to show
    $allowed_paths = ['dashboard', 'assignment', 'result', 'student', 'login', 'logout'];

    // Check if path is allowed
    if (!in_array($request_path, $allowed_paths)) {
        $request_path = 'dashboard'; // Default to dashboard
    }

    // If user is not logged in, redirect to login
    if (!isset($_SESSION['user_id']) && $request_path !== 'login') {
        header('Location: login.php');
        exit();
    }

    // Include the main layout
    include 'app/layout.php';
    define('APP_ROOT', __DIR__);
?>