<?php 
session_start();
include 'includes/dbh.inc.php';
include 'components/header.php';

$id = $_SESSION["user_id"];

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

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
    <title>Select Subjects</title>
</head>
<body class="bg-neutral-50">
    <?php renderHeader('student_name', 'role') ?>
    <main class="w-full relative">
        <div class="mx-auto w-10/12 border-zinc-200/65 border mt-3 rounded-md bg-white flex flex-wrap">
            <div class="w-1/2">
                <img src="public/BookLover.png" class="" />
            </div>
            <div class="w-1/2 flex flex-col justify-center gap-6 p-3">
                <div>
                    <h2 class="text-neutral-900 text-4xl font-semibold">Welcome <?= htmlspecialchars($_SESSION['student_name']) ?></h2>
                    <p class="text-zinc-400 font-semibold">Select your Offered Subjects...</p>
                </div>
                <div class="">
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
                        >
                            Save Subjects
                        </button>
                    </form>
                </div>
            </div>
            <div x-data="{ open: false }" class="mx-auto">
                <p class="mx-auto">Not Sure about subjects? <span><a x-on:click="open = ! open" class="cursor-pointer font-semibold text-blue-400 border-dotted border-b-blue-400 border-b">Log Out</a>, while you confirm.</span></p>
            </div>
        </div>
        <div x-show="open" class="bg-zinc-100/20 absolute top-0 left-0 w-full flex justify-center items-center backdrop-blur-sm p-5">
            <div class="bg-zinc-200/40 w-2/5 flex justify-center items-center p-5 rounded-4xl backdrop-blur-md border-zinc-100 border">
                <div class="flex flex-col items-center w-full rounded-3xl p-5 bg-neutral-50 border border-neutral-100">
                    <img src="public/LogOut.png" class="w-32 h-32" />
                    <div class="flex flex-col justify-center items-center w-10/12">
                        <p class="text-2xl font-semibold mt-3 text-neutral-800">Are You Sure?</p>
                        <div class="flex gap-4 mt-3 w-11/12">
                            <a href="logout.php" class="w-1/2 text-center px-4 py-1 rounded-xl bg-blue-600 text-neutral-100 font-semibold">Yes</a>
                            <a x-on:click="open = false" href="#" class="font-semibold w-1/2 border-zinc-400 border-2 px-4 rounded-xl text-center text-neutral-800">No</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>