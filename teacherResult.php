<?php
    include "includes/dbh.inc.php";
    session_start();

    $classQuery = "SELECT * FROM classes";
    $classResult = mysqli_query($conn, $classQuery);
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
    <select name="class_id" id="class" required class="border p-2 rounded w-60 h-10">
            <option value="">-- Select Class --</option>
            <?php while ($class = mysqli_fetch_assoc($classResult)) : ?>
            <option value="<?= $class['id'] ?>">
                <?= htmlspecialchars($class['class_name']) ?>
            </option>
            <?php endwhile; ?>
        </select>
    <br/>
    <form action="" method="POST">

    </form>
</body>
</html>