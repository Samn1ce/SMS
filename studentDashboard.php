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
    <title>Student Dashboard</title>
</head>
<body>
   <div>
    <p>
    <?php
        echo "Hello " . $_SESSION["username"] . ", you're a " . $_SESSION["role"];
    ?>
   </p>
   </div>
   <div>
    <p>Check Result</p>
    <p>Check Attendance</p>
   </div>
</div>
</body>
</html>