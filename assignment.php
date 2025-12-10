<?php 
    session_start();
    include 'includes/dbh.inc.php';
    include 'components/header.php';

    $id = $_SESSION["user_id"];
    $surname = $_SESSION['surname'];
    $firstname = $_SESSION['firstname'];
    $class_name = $_SESSION['class_name'];
    $role = $_SESSION['role'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script> 
    <title>Assignments</title>
</head>
<body class="bg-neutral-50">
    <?php renderHeader($id) ?>
    <main class="w-full border min-h-[700px]">
        <div>
            
        </div>
    </main>
</body>
</html>