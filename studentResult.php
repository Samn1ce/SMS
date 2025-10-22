<?php 
    session_start();
    include 'includes/dbh.inc.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script> 
    <title>Document</title>
</head>
<body>
    <h1>Student Result</h1>
    <p>Student name: </p>
    <br/>
    <ul class="list-disc pl-6">
        <li>
            <p>maths: <span>A1</span></p>
        </li>
        <li>
            <p>English: <span>E8</span></p>
        </li>
        <li>
            <p>music: <span>B3</span></p>
        </li>
    </ul>
</body>
</html>