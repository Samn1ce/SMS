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
    <form action="includes/registerFormhandler.inc.php" method="post">
        <div class="w-full h-screen border bg-zinc-50">
            <h1 class="text-blue-500 text-xl">REGISTER</h1>
            <div class="w-full flex justify-center items-center">  
                <div class="w-1/4 rounded-md bg-white p-3 flex flex-col gap-4 items-center">
                    <div class="border-b rounded w-11/12 h-8 p-1">
                        <input 
                            type="text" 
                            name="email" 
                            placeholder="email" 
                            value="<?= isset($_GET['email']) ? htmlspecialchars($_GET['email']) : '' ?>" 
                            class="w-full outline-none <?= (isset($_GET['error']) && ($_GET['error'] === 'emptyfields') && ($_GET['email'] === '') ? 'border-b-red-500' : 'border-black') ?>"
                        />
                    </div>
                    <div class="border-b rounded w-11/12 h-8 p-1">
                        <input 
                            type="text" 
                            name="mname" 
                            placeholder="name" 
                            value="<?= isset($_GET['mname']) ? htmlspecialchars($_GET['mname']) : '' ?>" 
                            class="w-full outline-none <?= (isset($_GET['error']) && ($_GET['error'] === 'emptyfields') && ($_GET['mname'] === '') ? 'border-red-500' : 'border-black') ?>" 
                        />
                    </div>
                    <div class="border-b rounded w-11/12 h-8 p-1">
                        <input 
                            type="text" 
                            name="username" 
                            placeholder="username" 
                            value="<?= isset($_GET['username']) ? htmlspecialchars($_GET['username']) : '' ?>" 
                            class="w-full outline-none <?= (isset($_GET['error']) && ($_GET['error'] === 'emptyfields') && ($_GET['username'] === '') ? 'border-red-500' : 'border-black') ?>" 
                        />
                    </div>
                    <div class="border-b rounded w-11/12 h-8 p-1">
                        <select 
                            name="role" 
                            class="w-full outline-none <?= (isset($_GET['error']) && ($_GET['error'] === 'emptyfields') && ($_GET['role'] === "none") ? 'border-red-500' : 'border-black') ?>"
                        >
                            <option value="none">What's your role?</option>
                            <option value="student">Student</option>
                            <option value="teacher">Teacher</option>
                        </select>
                    </div>
                    <div class="border-b rounded w-11/12 h-8 p-1">
                        <select name="class_id" id="class" class="w-full outline-none">
                            <option value="">-- Select Class --</option>
                            <?php while ($class = mysqli_fetch_assoc($classResult)) : ?>
                            <option value="<?= $class['id'] ?>">
                                <?= htmlspecialchars($class['class_name']) ?>
                            </option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="border-b rounded w-11/12 h-8 p-1">
                        <select name="sex" class="w-full outline-none">
                            <option value="">-- Select Sex --</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                    <div class="border-b rounded w-11/12 h-8 p-1">
                        <input type="date" name="dob" class="w-full outline-none" />
                    </div>
                    <div class="border-b rounded w-11/12 h-8 p-1">
                        <input type="password" name="pwd" placeholder="password" class="w-full outline-none" />
                    </div>
                    <div class="border-b rounded w-11/12 h-8 p-1">
                        <input type="password" name="confirmPwd" placeholder="confirm password" class="w-full outline-none" />
                    </div>
                    <div>
                        <button class="block border border-black text-sm font-semibold mt-2 p-1 rounded cursor-pointer mx-auto">REGISTER</button>
                        <a href="login.php" class="border-b border-dotted border-blue-400 text-sm text-blue-400">I already have an account</a>
                    </div>
                </div>            
            </div>
        </div>
    </form>
</body>
</html>