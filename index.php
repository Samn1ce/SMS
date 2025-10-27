<?php 
    include 'components/icons.php'
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>  -->
     <link href="./src/output.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <!-- <a href="login.php" class="text-blue-400 underline text-xl hover:text-red-500">LOGIN</a>
    <a href="register.php" class="text-blue-400 underline text-xl hover:text-red-500">REGISTER</a> -->

    <div class="w-full h-screen bg-black p-3 flex items-end justify-end">
        <div class=" w-1/2 p-3 bg-zinc-50 h-full rounded-md flex justify-center items-center">
           <div class="w-3/4 h-3/4 flex flex-col gap-4">
                <div>
                    <h1 class=" text-4xl font-bold">Welcome!</h1>
                    <p class=" text-sm">Lorem ipsum dolor, sit amet consectetur adipisicing elit.</p>
                </div>
                <div class="w-full flex flex-col gap-4">
                    <div class="flex flex-col gap-2">
                        <!-- <label for="email" class="font-semibold text-sm">Email</label> -->
                        <!-- <input type="text" id="email" placeholder="Enter your email..." class="w-full p-3 border border-zinc-400 rounded-md text-sm outline-none" /> -->
                        <div class="w-full flex gap-2 items-center border-b-2 border-zinc-600 rounded-md p-3">
                            <?php renderIcon('email', 'w-6 h-6') ?>
                            <input type="text" id="email" placeholder="Enter your email..." class="w-full font-semibold outline-none" />
                        </div>
                    </div>

                    <div class="flex flex-col gap-2">
                        <!-- <label for="email" class="font-semibold text-sm">Email</label> -->
                        <!-- <input type="text" id="email" placeholder="Enter your email..." class="w-full p-3 border border-zinc-400 rounded-md text-sm outline-none" /> -->
                        <div class="w-full flex gap-2 items-center border-b-2 border-zinc-600 rounded-md p-3">
                            <?php renderIcon('password', 'w-6 h-6') ?>
                            <input type="text" id="email" placeholder="Enter your password..." class="w-full font-semibold outline-none" />
                        </div>
                    </div>

                    <button class="bg-black w-full text-zinc-50 p-3 font-semibold rounded-full">Submit</button>
                </div>
           </div>
        </div>
    </div>
 
</body>
</html>