<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script> 
    <title>Document</title>
</head>
<body>
    <h1 class="text-blue-500 text-xl">LOGIN</h1>
    <form action="includes/loginFormhandler.inc.php" method="post">
        <div class="flex gap-4">
            <div>
                <input type="text" name="email" placeholder="email" class="w-60 h-10 border mt-2 <?= (isset($_GET['error']) && ($_GET['error'] === 'invalidcredentials' || $_GET['error'] === 'emptyfields')) ? 'border-red-500' : 'border-black' ?>" />
                <?php if (isset($_GET['error']) && $_GET['error'] === 'emptyfields') { echo '<p class="text-red-500 text-xs">This field is empty</p>'; } ?>
            </div>
            <select name="role" class="w-60 h-10 border border-black mt-2">
                <option value="">What's your role?</option>
                <option value="student">Student</option>
                <option value="teacher">Teacher</option>
            </select>
            <div>
                <input type="password" name="pwd" placeholder="password" class="w-60 h-10 border mt-2 <?= (isset($_GET['error']) && ($_GET['error'] === 'invalidcredentials' || $_GET['error'] === 'emptyfields')) ? 'border-red-500' : 'border-black' ?>" />
                <?php if (isset($_GET['error']) && ($_GET['error'] === 'emptyfields')) { echo '<p class="text-red-500 text-xs">This field is empty</p>'; } ?>
            </div>
        </div>
        <div class="flex gap-4">
            <a href="register.php" class="hover:text-red-500 underline">I don't have an account</a>
            <p class="text-red-500 <?= (isset($_GET['error']) && $_GET['error'] === 'invalidcredentials') ? 'block' : 'hidden' ?>">Invalid Credentials. Check your crendentials and try again</p>
        </div>
        <button class="block border border-black mt-2 p-2 cursor-pointer">Login</button>
    </form>
</body>
</html>