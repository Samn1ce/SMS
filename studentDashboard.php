<?php
session_start();
include 'includes/dbh.inc.php';
include 'components/icons.php';

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
    <title>Student Dashboard</title>
</head>
<body class="bg-zinc-200/60">
    <header class="w-full border-b">
        <div class="w-full mx-auto">
            <div class="mx-auto w-11/12 lg:w-10/12 flex justify-between p-2">
                <div class="flex justify-center items-center">
                    <img src="public\png-aura.com.png" class="w-10 h-10" />
                    <h1 class="font-bold text-3xl">SCHOOL NAME</h1>
                </div>
                <a href="studentProfile.php?id=<?= $id ?>" class="hidden lg:flex flex-col justify-end items-end cursor-pointer p-2 hover:bg-zinc-300 duration-300 transition-all">
                    <h2 class="font-semibold text-xl"><?= htmlspecialchars($_SESSION['student_name']) ?></h2>
                    <p class="text-zinc-400 text-sm -mt-1"><?= htmlspecialchars($_SESSION['role']) ?></p>
                </a>
            </div>
        </div>
    </header>
    <main class="w-full min-h-[700px] p-2 mx-auto">
        <section class="mx-auto w-11/12 lg:w-10/12 flex flex-col lg:flex-row lg:gap-4 gap-2">
            <div class="w-full lg:w-9/12 lg:h-48 bg-blue-500/90 rounded-md p-3 lg:pt-3 lg:p-5 flex justify-center items-center">
                <div class="w-full h-full flex flex-col justify-between gap-4 lg:gap-0">
                    <div>
                        <p class="text-xl lg:text-2xl font-semibold text-zinc-200">Lorem, ipsum dolor.</p>
                        <p class="text-xs lg:text-sm text-zinc-300 font-semibold">Lorem ipsum dolor sit amet consectetur adipisicing elit. Debitis, nisi sequi tenetur possimus veniam beatae.</p>
                    </div>
                    <div class="flex flex-col lg:flex-row gap-2 lg:gap-28">
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
                <div class="bg-white h-20 w-full rounded hover:shadow-2xl duration-300 transition-all p-2 flex items-center gap-2">
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
            <div class="w-full flex flex-col lg:flex-row gap-4">
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
            <div class="w-full flex flex-col lg:flex-row gap-4">
                <div class="w-full lg:w-1/2">
                    <h3 class="font-bold text-xl pl-5 mb-2">Term Assesment</h3>
                    <div class="w-full">
                        <div class="w-full h-24 bg-white rounded-md p-3 flex items-center gap-4 hover:shadow-2xl duration-300 transition-all">
                            <div class="h-full w-20 rounded-md flex justify-center items-center bg-indigo-600">
                                <?php renderIcon('term', 'w-8 h-8 text-white') ?>
                            </div>
                            <div>
                                <p class="text-sm text-zinc-400 font-semibold">Current Term</p>
                                <p class="text-neutral-900 font-semibold">First Term</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full lg:w-1/2">
                    <h3 class="font-bold text-xl pl-5 mb-2">Session Assesment</h3>
                    <div class="w-full">
                        <div class="w-full h-24 bg-white rounded-md p-3 flex items-center gap-4 hover:shadow-2xl duration-300 transition-all">
                            <div class="h-full w-20 rounded-md flex justify-center items-center bg-teal-600">
                                <?php renderIcon('session', 'w-8 h-8 text-white') ?>
                            </div>
                            <div>
                                <p class="text-sm text-zinc-400 font-semibold">Current Session</p>
                                <p class="text-neutral-900 font-semibold">2025/2026 Session</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

   <div>
        <p>
        <?php
            echo "Hello <b>" . htmlspecialchars($_SESSION["student_name"]) . "</b>(" . htmlspecialchars($className) . "), you're a " . $_SESSION["role"];
        ?>
        </p>
   </div>
   <div>
    <a href="studentResult.php?id=<?= $id ?>" class="text-blue-800 underline">Check Result</a>
    <a href="" class="text-blue-800 underline">Check Attendance</a>
   </div>

    <div x-data="{ showModal: <?= $showModal ? 'true' : 'false' ?> }" class="w-full flex flex-col items-center absolute">
  <!-- SUBJECT SELECTION MODAL -->
        <div x-show="showModal">
            <div class="bg-zinc-300 p-6 rounded-xl w-96 shadow-lg">
                <h2 class="text-xl font-semibold mb-4 text-center">Select Your Subjects</h2>

                <form action="includes/saveSubjects.php" method="POST" class="space-y-3">
                    <input type="hidden" name="student_id" value="<?= $id ?>">

                    <?php while ($subject = mysqli_fetch_assoc($subjectsResult)) : ?>
                        <label class="flex items-center space-x-2">
                        <input type="checkbox" name="subjects[]" value="<?= htmlspecialchars($subject['id']) ?>"> 
                        <span><?= htmlspecialchars($subject['subject_name']) ?></span>
                        </label>
                    <?php endwhile; ?>

                    <button 
                        type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded-md w-full mt-3 hover:bg-blue-700"
                        x-on:click="showModal = ! showModal"
                    >
                        Save Subjects
                    </button>
                </form>
            </div>
        </div>
    </div>
    <br/>
    <div>
        <p class="font-bold">Your Subjects are:</p>
        <ul class="list-disc pl-6">
            <?php foreach (getSelectedSubjects($conn, $id) as $subject): ?>
                <li><?= htmlspecialchars($subject) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <br/>

    <a href="studentProfile.php?id=<?= $id ?>" class="px-2 py-1 border bg-zinc-200 rounded">View Profile</a>
    <br/>
   <div x-data="{ open: false }">
        <button  class="border-2 border-black cursor-pointer p-3 mt-2" x-on:click="open = ! open">Log out</button>

        <div x-show="open">
            <div>
                <p>Are you sure you want to log out</p>
                <a href="logout.php" class="text-blue-400 underline">Yes</a> / <a x-on:click="open = ! open" href="#" class="text-blue-400 underline" >No</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>