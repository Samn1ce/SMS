<?php
    include 'includes/dbh.inc.php';
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
    <h1 class="text-blue-500 text-xl">REGISTER</h1>
    <form action="includes/registerFormhandler.inc.php" method="post">
        <input 
            type="text" 
            name="email" 
            placeholder="email" 
            value="<?= isset($_GET['email']) ? htmlspecialchars($_GET['email']) : '' ?>" 
            class="w-60 h-10 border mt-2 <?= (isset($_GET['error']) && ($_GET['error'] === 'emptyfields') && ($_GET['email'] === '') ? 'border-red-500' : 'border-black') ?>" 
        />
        <input 
            type="text" 
            name="mname" 
            placeholder="name" 
            value="<?= isset($_GET['mname']) ? htmlspecialchars($_GET['mname']) : '' ?>" 
            class="w-60 h-10 border mt-2 <?= (isset($_GET['error']) && ($_GET['error'] === 'emptyfields') && ($_GET['mname'] === '') ? 'border-red-500' : 'border-black') ?>" 
        />
        <input 
            type="text" 
            name="username" 
            placeholder="username" 
            value="<?= isset($_GET['username']) ? htmlspecialchars($_GET['username']) : '' ?>" 
            class="w-60 border h-10 mt-2 <?= (isset($_GET['error']) && ($_GET['error'] === 'emptyfields') && ($_GET['username'] === '') ? 'border-red-500' : 'border-black') ?>" 
        />
        <select 
            name="role" 
            class="w-60 h-10 border mt-2 <?= (isset($_GET['error']) && ($_GET['error'] === 'emptyfields') && ($_GET['role'] === "none") ? 'border-red-500' : 'border-black') ?>"
        >
            <option value="none">What's your role?</option>
            <option value="student">Student</option>
            <option value="teacher">Teacher</option>
        </select>
        <select name="class_id" id="class" class="border p-2 rounded w-60 h-10">
            <option value="">-- Select Class --</option>
            <?php while ($class = mysqli_fetch_assoc($classResult)) : ?>
            <option value="<?= $class['id'] ?>">
                <?= htmlspecialchars($class['class_name']) ?>
            </option>
            <?php endwhile; ?>
        </select>
        <input type="password" name="pwd" placeholder="password" class="w-60 h-10 border border-black mt-2" />
        <input type="password" name="confirmPwd" placeholder="confirm password" class="w-60 h-10 border border-black mt-2" />
        <button class="block border border-black mt-2 p-2 cursor-pointer">REGISTER</button>
    </form>
</body>
</html>