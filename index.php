<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script> 
    <title>Document</title>
</head>
<body>
    <a href="login.php" class="text-blue-400 underline text-xl hover:text-red-500">LOGIN</a>
    <a href="register.php" class="text-blue-400 underline text-xl hover:text-red-500">REGISTER</a>

    <div class="w-full h-screen border bg-zinc-200 flex justify-center items-center">
        <div class="w-1/4 h-60 rounded-md bg-white p-3 flex flex-col gap-4 items-center">
            <div class="border-b w-11/12 h-8">
                <input type="text" placeholder="email" class="w-full outline-none p-1"/>
            </div>
            <div class="border-b w-11/12 h-8">
                <input type="text" placeholder="email" class="w-full outline-none p-1"/>
            </div>
        </div>
    </div>
</body>
</html>