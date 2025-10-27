<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script> 
    <title>Document</title>
</head>
<body>
    <form action="includes/loginFormhandler.inc.php" method="post">
        <div class="w-full h-screen border bg-zinc-50">
            <h1 class="text-blue-500 text-xl">LOGIN</h1>
            <div class="w-full flex justify-center items-center">
                <div class="w-1/4 rounded-md bg-white p-3 flex flex-col gap-4 items-center">
                <div class="border-b rounded w-11/12 h-8 p-1">
                    <input 
                        type="text" name="email" 
                        placeholder="email" 
                        class="w-full outline-none <?= 
                            (isset($_GET['error']) && ($_GET['error'] === 'invalidcredentials' || $_GET['error'] === 'emptyfields')) ? 'border-red-500' : 'border-black' 
                        ?>" 
                    />
                        <?php 
                            if (isset($_GET['error']) && $_GET['error'] === 'emptyfields') { echo '<p class="text-red-500 text-xs">This field is empty</p>';}
                        ?>
                </div>
                <div class="border-b rounded w-11/12 h-8 p-1">
                    <select name="role" class="w-full outline-none">
                        <option value="">What's your role?</option>
                        <option value="student">Student</option>
                        <option value="teacher">Teacher</option>
                    </select>
                </div>
                <div class="border-b rounded w-11/12 h-8 p-1">
                    <input 
                        type="password" 
                        name="pwd" 
                        placeholder="password" 
                        class="w-full outline-none<?= (isset($_GET['error']) && ($_GET['error'] === 'invalidcredentials' || $_GET['error'] === 'emptyfields')) ? 'border-red-500' : 'border-black' ?>" 
                    />
                    <?php 
                        if (isset($_GET['error']) && ($_GET['error'] === 'emptyfields')) { echo '<p class="text-red-500 text-xs">This field is empty</p>'; } 
                    ?>
                </div>
                <div>
                    <button class="mx-auto block border border-black mt-2 p-1 font-semibold rounded cursor-pointer">Login</button>
                    <a href="register.php" class="hover:text-red-500 text-blue-400 text-xs border-b border-dotted border-blue-400">I don't have an account</a>
                </div>
            </div>
            <div class="flex gap-4">
                <p class="text-red-500 <?= (isset($_GET['error']) && $_GET['error'] === 'invalidcredentials') ? 'block' : 'hidden' ?>">Invalid Credentials. Check your crendentials and try again</p>
            </div>
        </div>
    </form>
</body>
</html>