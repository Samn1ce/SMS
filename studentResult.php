<?php 
    session_start();
    include 'includes/dbh.inc.php';
    include 'components/header.php';

    $id = $_SESSION['user_id'];
    $student_name = $_SESSION['student_name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script> 
    <title><?= $_SESSION['student_name'] ?> Results</title>
</head>
<body class="bg-neutral-50">
    <?php renderHeader($id) ?>
    <main class="max-w-7xl w-full min-h-[700px] p-2 mx-auto">
        <section class="bg-white h-40 w-10/12 shadow-2xl rounded-md mx-auto px-3 py-2 flex flex-col gap-2">
            <h3 class="font-semibold text-blue-400">Student Details</h3>
            <div class="px-5 flex-1 flex gap-4">
                <div class="rounded-full h-28 w-28 border"></div>
                <div class="flex flex-1 items-center">
                    <div class="flex flex-col gap-2 pr-3 mr-3 border-r border-zinc-200">
                        <div class="flex">
                            <p>Student Name:&nbsp;</p>
                            <p><?= $_SESSION['student_name'] ?></p>
                        </div>
                        <hr class="border border-zinc-200 w-11/12 mx-auto" />
                        <div class="flex">
                            <p>Class:&nbsp;</p>
                            <p><?= $_SESSION['class_name'] ?></p>
                        </div>
                    </div>
                    <div class="flex flex-col gap-2 pr-3 mr-3 border-r border-zinc-200">
                        <div class="flex">
                            <p>Student Name:&nbsp;</p>
                            <p><?= $_SESSION['student_name'] ?></p>
                        </div>
                        <hr class="border border-zinc-200 w-11/12 mx-auto" />
                        <div class="flex">
                            <p>Student Name:&nbsp;</p>
                            <p><?= $_SESSION['student_name'] ?></p>
                        </div>
                    </div>
                    <div class="flex flex-col gap-2 pr-3 mr-3 border-r border-zinc-200">
                        <div class="flex">
                            <p>Student Name:&nbsp;</p>
                            <p><?= $_SESSION['student_name'] ?></p>
                        </div>
                        <hr class="border border-zinc-200 w-11/12 mx-auto" />
                        <div class="flex">
                            <p>Student Name:&nbsp;</p>
                            <p><?= $_SESSION['student_name'] ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>
</html>