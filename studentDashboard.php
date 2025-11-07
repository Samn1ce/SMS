<?php
session_start();
include 'includes/dbh.inc.php';
include 'components/icons.php';
include 'components/header.php';
include 'components/logoutDialogue.php';

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$id = $_SESSION["user_id"];

// Fetch login count
$loginStmt = mysqli_prepare($conn, "SELECT login_count FROM students WHERE id = ?");
mysqli_stmt_bind_param($loginStmt, "i", $id);
mysqli_stmt_execute($loginStmt);
$result = mysqli_stmt_get_result($loginStmt);
$row = mysqli_fetch_assoc($result);
$showModal = $row["login_count"] < 1;

// 2. Fetch student's class name using JOIN
$classStmt = mysqli_prepare($conn, "
    SELECT class_name 
    FROM classes 
    JOIN students ON students.class_id = classes.id 
    WHERE students.id = ?
");
mysqli_stmt_bind_param($classStmt, "i", $id);
mysqli_stmt_execute($classStmt);
$classResult = mysqli_stmt_get_result($classStmt);
$classRow = mysqli_fetch_assoc($classResult);
$className = $classRow['class_name'] ?? 'Unknown';

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
    <title><?= $_SESSION['student_name'] ?> Dashboard</title>
</head>
<body class="bg-neutral-50">
    <?php renderHeader('student_name', 'role', $id) ?>
    <main class="w-full min-h-[700px] p-2 mx-auto relative">
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
                                <p class="text-xl font-semibold text-zinc-50"><?= htmlspecialchars($_SESSION['student_name']) ?></p>
                                <p class="text-xs text-zinc-300 font-semibold -mt-1">Fullname</p>
                            </div>
                        </div>
                        <div class="flex lg:justify-center lg:items-center gap-2">
                            <div class="w-10 h-10 border rounded-full flex justify-center items-center">
                                <?php renderIcon('grade', 'w-6 h-6') ?>
                            </div>
                            <div>
                                <p class="text-xl font-semibold text-zinc-50"><?= htmlspecialchars($className) ?></p>
                                <p class="text-xs text-zinc-300 font-semibold -mt-1">class</p>
                            </div>
                        </div>
                    </div>
                </div>
                <img src="public\Graduation.png" class="w-64 hidden lg:block" />
            </div>
            <div class="w-full lg:w-1/4 flex flex-col gap-2">
                <a href="studentResult.php" class="w-full p-2 flex justify-center items-center bg-blue-400 hover:bg-blue-500 duration-300 transition-all text-zinc-50 font-semibold text-sm rounded-md">Results Profile</a>
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
            <h2 class="font-bold text-xl pl-5 mb-2">Daily Assesment</h2>
            <div class="w-full flex flex-col md:flex-row gap-4">
                <div class="w-full lg:w-1/2 h-32 bg-white flex flex-col lg:flex-1 rounded-b-xl shadow-gray-950">
                    <div class="w-full p-2 flex justify-center items-center bg-blue-300/30 text-blue-500/80 font-semibold text-sm shadow-black">Assigment</div>
                    <p class="w-full flex-1 text-neutral-900 text-center font-semibold pt-5">You don't have any assignment at this time.</p>
                    <a href="" class="text-xs mb-2 self-end mr-3 border-b border-dotted border-b-blue-400 text-neutral-700 hover:text-neutral-900 duration-300 transition-all font-semibold">View assignments</a>
                </div>
                <div class="w-full lg:w-1/2 h-32 bg-white flex flex-col lg:flex-1 rounded-b-xl shadow-gray-950">
                    <div class="w-full p-2 flex justify-center items-center bg-blue-300/30 text-blue-500/80 font-semibold text-sm shadow-black">Last Attendance</div>
                    <p class="w-full flex-1 text-neutral-900 text-3xl lg:text-5xl text-center font-semibold pt-5">7th, Oct</p>
                    <a href="" class="text-xs mb-2 self-end mr-3 border-b border-dotted border-b-blue-400 text-neutral-700 hover:text-neutral-900 duration-300 transition-all font-semibold">View attendance</a>
                </div>
            </div>
        </section>
        <section class="mx-auto w-11/12 lg:w-10/12 mt-5">
            <div class="w-full flex flex-col md:flex-row gap-4">
                <div class="w-full lg:w-1/2">
                    <h3 class="font-bold text-xl pl-5 mb-2">Term Assesment</h3>
                    <div class="w-full">
                        <div class="w-full h-24 bg-white rounded-md p-3 flex items-center gap-4 hover:shadow-2xl duration-300 transition-all mb-4 border-zinc-200/65 border">
                            <div class="h-full w-20 rounded-md flex justify-center items-center bg-indigo-600">
                                <?php renderIcon('term', 'w-8 h-8 text-white') ?>
                            </div>
                            <div>
                                <p class="text-sm text-zinc-400 font-semibold">Current Term</p>
                                <p class="text-neutral-900 font-semibold">First Term</p>
                            </div>
                        </div>
                        <div class="w-full h-24 bg-white rounded-md p-3 flex items-center gap-4 hover:shadow-2xl duration-300 transition-all mb-4 border-zinc-200/65 border">
                            <div class="h-full w-20 rounded-md flex justify-center items-center bg-fuchsia-500">
                                <?php renderIcon('subjects', 'w-8 h-8 text-white') ?>
                            </div>
                            <div x-data="{ open: false }" x-transition>
                                <p class="text-sm text-zinc-400 font-semibold">Offered Subjects</p>
                                <p class="text-neutral-900 font-semibold">You are Offering 12 subjects. <span x-on:click=" open = !open " class="text-blue-400 border-dotted border-b-blue-400 border-b cursor-pointer">View Offered subjects</span></p>

                                <div x-show="open">
                                    <div x-transition.opacity.duration.300ms class="bg-zinc-100/20 fixed h-screen top-0 left-0 w-full flex justify-center items-center backdrop-blur-sm p-5">
                                        <div x-transition.opacity.scale.duration.350ms class="bg-white/40 w-11/12 lg:w-2/5 flex justify-center items-center p-5 rounded-4xl backdrop-blur-md border-zinc-100 border shadow-lg">
                                            <div class="flex flex-col w-full rounded-3xl p-2 md:p-5 bg-neutral-50 border border-neutral-100 gap-4">
                                                <p class="font-bold text-center text-3xl text-neutral-800">Your Subjects are:</p>
                                                <ul class="list-disc pl-6 mt-2">
                                                    <?php foreach (getSelectedSubjects($conn, $id) as $subject): ?>
                                                        <li><?= htmlspecialchars($subject) ?></li>
                                                    <?php endforeach; ?>
                                                </ul>
                                                <p class="text-center text-sm text-neutral-800">A subject is missing? <span><a href="#" class="font-semibold text-blue-400 border-b border-dotted border-b-blue-400">Check Here</a></span>, to see which one you omitted.</p>
                                                <button x-on:click="open = false" class="p-2 cursor-pointer rounded-xl bg-red-500 hover:bg-red-600/90 transition-all duration-300 text-neutral-100 font-semibold">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="w-full h-24 bg-white rounded-md p-3 flex items-center gap-4 hover:shadow-2xl duration-300 transition-all mb-4 border-zinc-200/65 border">
                            <div class="h-full w-20 rounded-md flex justify-center items-center bg-sky-600">
                                <?php renderIcon('fees', 'w-8 h-8 text-white') ?>
                            </div>
                            <div>
                                <p class="text-sm text-zinc-400 font-semibold">School Fees</p>
                                <p class="text-neutral-900 font-semibold">Paid. <span><a href="" class="text-blue-400 border-dotted border-b-blue-400 border-b cursor-pointer">View details</a></span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full lg:w-1/2">
                    <h3 class="font-bold text-xl pl-5 mb-2">Session Assesment</h3>
                    <div class="w-full">
                        <div class="w-full h-24 bg-white rounded-md p-3 flex items-center gap-4 hover:shadow-2xl duration-300 transition-all mb-4 border-zinc-200/65 border">
                            <div class="h-full w-20 rounded-md flex justify-center items-center bg-teal-600">
                                <?php renderIcon('session', 'w-8 h-8 text-white') ?>
                            </div>
                            <div>
                                <p class="text-sm text-zinc-400 font-semibold">Current Session</p>
                                <p class="text-neutral-900 font-semibold">2025/2026 Session</p>
                            </div>
                        </div>
                        <div class="w-full h-24 bg-white rounded-md p-3 flex items-center gap-4 hover:shadow-2xl duration-300 transition-all mb-4 border-zinc-200/65 border">
                            <div class="h-full w-20 rounded-md flex justify-center items-center bg-sky-400">
                                <?php renderIcon('grade', 'w-8 h-8 text-white') ?>
                            </div>
                            <div>
                                <p class="text-sm text-zinc-400 font-semibold">Current class</p>
                                <p class="text-neutral-900 font-semibold"><?= htmlspecialchars($className) ?></p>
                            </div>
                        </div>
                        <div class="w-full h-24 bg-white rounded-md p-3 flex items-center gap-4 hover:shadow-2xl duration-300 transition-all mb-4 border-zinc-200/65 border">
                            <div class="h-full w-20 rounded-md flex justify-center items-center bg-emerald-600">
                                <?php renderIcon('termsCompleted', 'w-8 h-8 text-white') ?>
                            </div>
                            <div>
                                <p class="text-sm text-zinc-400 font-semibold">Terms Completed in 2025/26 Session</p>
                                <p class="text-neutral-900 font-semibold">First, Second Term</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    
   <?php renderLogoutDialogue('Log out', 'bg-blue-600 text-neutral-100 font-semibold rounded-xl p-3 cursor-pointer') ?>
</div>
</body>
</html>