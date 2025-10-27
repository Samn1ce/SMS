<?php 
    include 'components/icons.php'
?>


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
        <div class="w-full h-screen border bg-black p-3 flex items-end justify-end">
            <!-- <h1 class="text-blue-500 text-xl">LOGIN</h1> -->
            <div class="w-1/2 p-3 bg-zinc-50 h-full rounded-md flex justify-center items-center">
                <div class="w-3/4 h-3/4 flex flex-col gap-8">
                    <div>
                        <h1 class=" text-4xl font-bold">Welcome!</h1>
                        <p class=" text-sm">Lorem ipsum dolor, sit amet consectetur adipisicing elit.</p>
                    </div>
                    <div class="w-full flex flex-col gap-4">
                        <div class="flex flex-col gap-2">
                            <div class="w-full flex gap-2 items-center border-b-2 border-zinc-400 rounded-md p-3">
                                <?php renderIcon('email', 'w-6 h-6') ?>
                                <input 
                                    type="text" name="email" 
                                    placeholder="Email" 
                                    class="w-full font-semibold outline-none <?= 
                                        (isset($_GET['error']) && ($_GET['error'] === 'invalidcredentials' || $_GET['error'] === 'emptyfields')) ? 'border-red-500' : 'border-black' 
                                    ?>" 
                                />
                                    <?php 
                                        if (isset($_GET['error']) && $_GET['error'] === 'emptyfields') { echo '<p class="text-red-500 text-xs">This field is empty</p>';}
                                    ?>
                            </div>
                        </div>
                        <div class="w-full flex gap-2 items-center border-b-2 border-zinc-400 rounded-md p-3">
                            <select name="role" class="w-full outline-none">
                                <option value="">What's your role?</option>
                                <option value="student">Student</option>
                                <option value="teacher">Teacher</option>
                            </select>
                        </div>
                        <div class="flex flex-col gap-2">
                            <div class="w-full flex gap-2 items-center border-b-2 border-zinc-400 rounded-md p-3">
                                <?php renderIcon('password', 'w-6 h-6') ?>
                                <input 
                                    type="password" 
                                    name="pwd" 
                                    placeholder="Password" 
                                    class="w-full font-semibold outline-none <?= (isset($_GET['error']) && ($_GET['error'] === 'invalidcredentials' || $_GET['error'] === 'emptyfields')) ? 'border-red-500' : 'border-black' ?>" 
                                />
                                <?php 
                                    if (isset($_GET['error']) && ($_GET['error'] === 'emptyfields')) { echo '<p class="text-red-500 text-xs">This field is empty</p>'; } 
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col gap-2 justify-end items-end mt-2">
                        <button class="bg-black/90 hover:bg-black transition-all duration-300 cursor-pointer w-full text-zinc-50 p-3 font-semibold rounded-full">Login</button>
                        <a href="register.php" class="hover:text-red-500 text-blue-400 text-xs border-b border-dotted border-blue-400">I don't have an account</a>
                    </div>
                </div>
            </div>
            <div class="flex gap-4">
                <p class="text-red-500 <?= (isset($_GET['error']) && $_GET['error'] === 'invalidcredentials') ? 'block' : 'hidden' ?>">Invalid Credentials. Check your crendentials and try again</p>
            </div>
        </div>
    </form>
</body>
</html>