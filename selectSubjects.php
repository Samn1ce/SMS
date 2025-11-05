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
            <div class="w-1/2 flex flex-col justify-center gap-6 p-3 border">
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
            <div x-data="{ open = false }">
                <p class="mx-auto">Not Sure about subjects? <span><a x-on:click="open = ! open" class="cursor-pointer font-semibold text-blue-400 border-dotted border-b-blue-400 border-b">Log Out</a>, while you confirm.</span></p>
                <div x-show="open" class="absolute top-0 left-0 w-full h-screen flex justify-center items-center">
                    <div class="flex flex-col items-center w-60 h-40 border rounded-md p-3">
                        <h3 class="text-xl">Log out.</h3>
                        <div class="flex flex-col justify-center items-center">
                            <p class="text-2xl font-semibold mt-3">Are You Sure?</p>
                            <div class="flex gap-4 mt-1">
                                <a href="logout.php" class="border px-4 rounded">Yes</a>
                                <a x-on:click="open = ! open" href="#" class="border px-4 rounded">No</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>