<?php
session_start();
include 'includes/dbh.inc.php';
include 'components/icons.php';
include 'components/header.php';
include 'components/logoutDialogue.php';
include 'includes/cards.php';

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$id = $_SESSION["user_id"];
$surname = $_SESSION['surname'];
$firstname = $_SESSION['firstname'];
$class_name = $_SESSION['class_name'];
$role = $_SESSION['role'];

// Fetch available subjects
$subjectsQuery = "SELECT * FROM subjects";
$subjectsResult = mysqli_query($conn, $subjectsQuery);

function getSelectedSubjects($conn, $student_id) {
    $subjectsSql = "SELECT subject_name FROM student_subjects WHERE student_id = ?";
    $stmt = mysqli_prepare($conn, $subjectsSql);
    mysqli_stmt_bind_param($stmt, "i", $student_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $subjects = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $subjects[] = $row['subject_name'];
    }
    return $subjects;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script> 
    <title><?= htmlspecialchars($firstname) ?>'s Dashboard</title>
</head>
<body class="bg-neutral-50">
    <?php renderHeader($id) ?>
    <main class="max-w-7xl w-full p-2 mx-auto relative">
        <section class="mx-auto w-11/12 lg:w-10/12 flex flex-col lg:flex-row lg:gap-4 gap-2">
            <div class="w-full lg:w-9/12 md:h-38 lg:h-48 bg-blue-500/90 rounded-md p-3 lg:pt-3 lg:p-5 flex justify-center items-center">
                <div class="w-full h-full flex flex-col justify-between gap-4 lg:gap-0">
                    <div>
                        <p class="text-xl lg:text-2xl font-semibold text-zinc-200">Lorem, ipsum dolor.</p>
                        <p class="text-xs lg:text-sm text-zinc-300 font-semibold">Lorem ipsum dolor sit amet consectetur adipisicing elit. Debitis, nisi sequi tenetur possimus veniam beatae.</p>
                    </div>
                    <div class="flex flex-col md:flex-row gap-2 md:gap-x-14 lg:gap-28">
                        <div class="flex lg:justify-center lg:items-center gap-2">
                            <div class="w-10 h-10 border rounded-full flex justify-center items-center">
                                <?php renderIcon('person', 'w-6 h-6') ?>
                            </div>
                            <div>
                                <p class="text-xl font-semibold text-zinc-50"><?= htmlspecialchars($surname) ?>&nbsp;<?= htmlspecialchars($firstname) ?></p>
                                <p class="text-xs text-zinc-300 font-semibold -mt-1">Fullname</p>
                            </div>
                        </div>
                        <div class="flex lg:justify-center lg:items-center gap-2">
                            <div class="w-10 h-10 border rounded-full flex justify-center items-center">
                                <?php renderIcon('grade', 'w-6 h-6') ?>
                            </div>
                            <div>
                                <p class="text-xl font-semibold text-zinc-50"><?= htmlspecialchars($class_name) ?></p>
                                <p class="text-xs text-zinc-300 font-semibold -mt-1">class</p>
                            </div>
                        </div>
                    </div>
                </div>
                <img src="public\Graduation.png" class="w-64 hidden lg:block" />
            </div>
            <div class="w-full lg:w-1/4 flex flex-col gap-2">
                <?php
                    if ($role === 'student') {
                        echo '<a href="studentResult.php" class="w-full p-2 flex justify-center items-center bg-blue-400 hover:bg-blue-500 duration-300 transition-all text-zinc-50 font-semibold text-sm rounded-md">
                            Result Profile  
                        </a>';
                    } else {
                        echo '<a href="teacherResult.php" class="w-full p-2 flex justify-center items-center bg-blue-400 hover:bg-blue-500 duration-300 transition-all text-zinc-50 font-semibold text-sm rounded-md">
                            View Student  
                        </a>';
                    }
                ?>
                <div class="w-full h-18 bg-white flex flex-col rounded-b-xl shadow-gray-950">
                    <div class="w-full p-2 flex justify-center items-center bg-blue-300/30 text-blue-500/80 font-semibold text-sm rounded-b-md shadow-black">Current Time</div>
                    <p 
                        x-data="{ time: '' }" 
                        x-init="
                            setInterval(() => {
                            const now = new Date();
                            let hours = now.getHours() % 12 || 12;
                            let minutes = String(now.getMinutes()).padStart(2, '0');
                            let seconds = String(now.getSeconds()).padStart(2, '0');
                            let ampm = now.getHours() >= 12 ? 'pm' : 'am';
                            time = `${hours}:${minutes}:${seconds}${ampm}`;
                            }, 1000);
                        " 
                        x-text="time" 
                        class="w-full flex-1 text-neutral-900 text-center font-semibold pt-1"></p>
                </div>
                <div class="bg-white h-20 w-full rounded hover:shadow-2xl duration-300 transition-all p-2 flex items-center gap-2 border-zinc-200/65 border">
                    <div class="w-20 bg-amber-400 rounded h-full flex justify-center items-center">
                        <?php renderIcon('sessionStatus', 'w-8 h-8 text-white') ?>
                    </div>
                    <div>
                        <p class="text-xs text-zinc-400 font-semibold">School Mode</p>
                        <p class="text-sm text-neutral-900 font-semibold">Currently in Session/Holiday</p>
                    </div>
                </div>
            </div>
        </section>
        <section class="mx-auto w-11/12 lg:w-10/12 mt-5">
            <?php 
                if ($role === 'student') {
                    ?>
                        <h2 class="font-bold text-xl pl-5 mb-2">Daily Assesment</h2>
                        <div class="w-full flex flex-col md:flex-row gap-4">
                            <div class="w-full lg:w-1/2 h-32 bg-white flex flex-col lg:flex-1 rounded-b-xl shadow-gray-950">
                                <div class="w-full p-2 flex justify-center items-center bg-blue-300/30 text-blue-500/80 font-semibold text-sm shadow-black">Assigment</div>
                                <p class="w-full flex-1 text-neutral-900 text-center font-semibold pt-5">You don't have any assignment at this time.</p>
                                <a href="assignment.php" class="text-xs mb-2 self-end mr-3 border-b border-dotted border-b-blue-400 text-neutral-700 hover:text-neutral-900 duration-300 transition-all font-semibold">View assignments</a>
                            </div>
                            <div class="w-full lg:w-1/2 h-32 bg-white flex flex-col lg:flex-1 rounded-b-xl shadow-gray-950">
                                <div class="w-full p-2 flex justify-center items-center bg-blue-300/30 text-blue-500/80 font-semibold text-sm shadow-black">Last Attendance</div>
                                <p class="w-full flex-1 text-neutral-900 text-3xl lg:text-5xl text-center font-semibold pt-5">7th, Oct</p>
                                <a href="" class="text-xs mb-2 self-end mr-3 border-b border-dotted border-b-blue-400 text-neutral-700 hover:text-neutral-900 duration-300 transition-all font-semibold">View attendance</a>
                            </div>
                        </div>
                    <?php
                } else {
                    ?>
                        <div class="w-full">
                            <div class="w-1/4 p-3 rounded-md bg-white border-zinc-200/65 border shadow-xl">
                                <div class="w-full flex justify-center items-center">
                                    <?php renderIcon('book', 'w-14 h-14') ?>
                                </div>
                                <p class="text-sm text-neutral-900 font-semibold">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Natus dolorum quis nihil debitis inventore illo!</p>
                                <button class="w-full py-2 font-semibold text-center rounded-full bg-blue-500 text-neutral-900 mt-2 text-xs hover:bg-blue-600 transition duration-300">
                                    <a href="assignment.php" class="py-2 px-16 text-neutral-100 font-semibold">Give Assignments</a>
                                </button>
                            </div>
                        </div>
                    <?php
                }
            ?>
        </section>
        <section class="mx-auto w-11/12 lg:w-10/12 mt-5">
            <div class="w-full flex flex-col md:flex-row gap-4">
                <?php
                    if ($role === 'student') {
                    ?>
                        <div class="w-full lg:w-1/2">
                            <h3 class="font-bold text-xl pl-5 mb-2">Term Assesment</h3>
                            <div class="w-full">
                                <?php renderCards($cards, 'term', $conn, $id, $class_name); ?>
                            </div>
                        </div>
                        <div class="w-full lg:w-1/2">
                            <h3 class="font-bold text-xl pl-5 mb-2">Session Assesment</h3>
                            <div class="w-full">
                                <?php renderCards($cards, 'session', $conn, $id, $class_name); ?>
                            </div>
                        </div>
                    <?php
                    } else {
                        echo '';
                    }
                ?>
            </div>
        </section>
    </main>
</div>
</body>
</html>