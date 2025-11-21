<?php 
    include 'components/icons.php';
    session_start();

    if (isset($_SESSION['user_id'])) {
        header("Location: ./studentDashboard.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>  -->
    <link href="./src/output.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <a href="login.php" class="text-blue-400 underline text-xl hover:text-red-500">LOGIN</a>
    <a href="register.php" class="text-blue-400 underline text-xl hover:text-red-500">REGISTER</a>

    <?php
        
    ?>
    
</body>
</html>