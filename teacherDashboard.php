<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script> 
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>Teacher Dashboard</title>
</head>
<body class="p-6">

    <p class="text-xl text-blue-600 font-bold">
        <?php
        echo "Hello " . $_SESSION["username"] . ", you're a " . $_SESSION["role"];
        ?>
    </p>
    <div x-data="{ open: false }">
    <button  class="border-2 border-black cursor-pointer p-3" x-on:click="open = ! open">Log out</button>
 
    <div x-show="open">
        <div>
            <p>Are you sure you want to log out</p>
            <a href="logout.php" class="text-blue-400 underline">Yes</a> / <a x-on:click="open = ! open" href="#" class="text-blue-400 underline" >No</a>
        </div>
    </div>
</body>
</html>
