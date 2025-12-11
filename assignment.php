<?php 
    session_start();
    include 'includes/dbh.inc.php';
    include 'components/header.php';
    include 'components/icons.php';

    $id = $_SESSION["user_id"];
    $surname = $_SESSION['surname'];
    $firstname = $_SESSION['firstname'];
    $class_name = $_SESSION['class_name'];
    $role = $_SESSION['role'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script> 
    <title>Assignments</title>
</head>
<body class="bg-neutral-50">
    <?php renderHeader($id) ?>
    <main class="w-full text-neutral-800">
        <div class="max-w-7xl w-11/12 lg:w-10/12 mx-auto">
            <div class="w-full flex flex-col md:flex-row justify-between md:items-center gap-4 md:gap-0 p-2">
                <h2 class="text-2xl font-semibold">Assignments</h2>
                <div class="flex gap-4">
                    <select class="border outline-none p-2 rounded-md bg-white border-zinc-200/65 hover:border-zinc-800/60 transition-all duration-300 cursor-pointer">
                        <option>--Sort By--</option>
                        <option>Submission Date</option>
                        <option>Date Given</option>
                    </select>
                    <button class="font-semibold border p-2 rounded-md flex gap-2 bg-white border-zinc-200/65 hover:border-zinc-800/60 transition-all duration-300 cursor-pointer"><span><?php renderIcon('new', 'w-6 h-6') ?></span> New</button>
                </div>
            </div>
            <div class="w-full">
                <div class="w-full flex flex-col lg:flex-row gap-4 p-5">
                    <div class="w-full rounded-xl p-2 bg-white border border-zinc-200/65 hover:border-zinc-700/30 hover:shadow-md duration-300 transition-all">
                        <p class="font-semibold text-xl">Mathematics Assignment</p>
                        <div class="pl-2 flex justify-between">
                            <p class="italic text-xs md:text-sm">From: <span class="font-semibold">John Doe</span></p>
                            <div>
                                <p class="italic text-xs md:text-sm">Date Given: <span class="font-semibold">Monday, 20 August.</span></p>
                                <p class="italic text-xs md:text-sm">To be Submitted: <span class="font-semibold">Thursday, 24 August. 12:00pm</span></p>
                            </div>
                        </div>
                        <p class="mt-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia veritatis quas ipsam consequatur ipsum facere quaerat obcaecati facilis itaque repellat cum, totam sequi? Ea qui ipsa veniam, facilis deleniti velit.</p>
                    </div>
                    <div class="w-full rounded-xl p-2 bg-white border border-zinc-200/65 hover:border-zinc-700/30 hover:shadow-md duration-300 transition-all">
                        <p class="font-semibold text-xl">Mathematics Assignment</p>
                        <div class="pl-2 flex justify-between">
                            <p class="italic text-xs md:text-sm">From: <span class="font-semibold">John Doe</span></p>
                            <div>
                                <p class="italic text-xs md:text-sm">Date Given: <span class="font-semibold">Monday, 20 August.</span></p>
                                <p class="italic text-xs md:text-sm">To be Submitted: <span class="font-semibold">Thursday, 24 August. 12:00pm</span></p>
                            </div>
                        </div>
                        <p class="mt-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia veritatis quas ipsam consequatur ipsum facere quaerat obcaecati facilis itaque repellat cum, totam sequi? Ea qui ipsa veniam, facilis deleniti velit.</p>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>