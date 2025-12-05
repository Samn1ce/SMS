<?php
    include 'includes/dbh.inc.php';
    include 'includes/cards.php';
    include 'components/header.php';
    include 'components/icons.php';
    include 'components/logoutDialogue.php';

    session_start();

    // ✅ Check that an ID is provided in the URL
    if (!isset($_GET['id'])) {
        header("Location: ../teacherResult.php");
        die("Student ID not provided");
    }
    if ($_GET['id'] != $_SESSION['user_id']) {
        header("Location: ./studentDashboard.php");
        exit();
    }

    $id = $_GET['id'];

    // ✅ Fetch student basic details and class
    $sql = "SELECT s.id, s.studentName, c.class_name, s.gender, s.dob
            FROM students s
            JOIN classes c ON s.class_id = c.id
            WHERE s.id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if ($student = mysqli_fetch_assoc($result)) {
        $student_name = $student['studentName'];
        $class_name = $student['class_name'];
        $gender = $_SESSION['gender'];
        $dob = $_SESSION['dob'];
    }

    if (!$student) {
        die("Student not found");
    }

    // ✅ Fetch subjects offered by this student
    function getSelectedSubjects($conn, $id) {
        $subjectQuery = "SELECT subject_name FROM student_subjects WHERE student_id = ?";
        $subjectStmt = mysqli_prepare($conn, $subjectQuery);
        mysqli_stmt_bind_param($subjectStmt, "i", $id);
        mysqli_stmt_execute($subjectStmt);
        $subjectResult = mysqli_stmt_get_result($subjectStmt);

        $subjects = [];
        while ($row = mysqli_fetch_assoc($subjectResult)) {
            $subjects[] = $row['subject_name'];
        };
        return $subjects;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title><?= htmlspecialchars($_SESSION['student_name']) ?> Profile</title>
    <style>
    </style>
</head>
<body>
    <div class="bg-neutral-50 lg:h-screen">
        <?php renderHeader($id) ?>
        <div class="max-w-7xl mx-auto w-11/12 lg:w-10/12 lg:h-[85vh] 2xl:h-auto flex flex-col lg:flex-row gap-4 mt-3 text-neutral-900 relative">
            <div class="w-full lg:w-1/2 flex flex-col md:flex-row lg:flex-col justify-center items-center gap-6 rounded-md bg-white border border-zinc-200/65 p-5 md:p-10 lg:p-2">
                <div class="border border-zinc-200/65 w-40 h-40 rounded-full"></div>
                <div class="mx-auto md:mx-0 lg:mx-auto flex flex-col gap-2">
                    <div class="flex gap-2 items-center">
                        <?php renderIcon('personProfile', 'w-6 h-6') ?>
                        <p class="text-xl font-semibold text-neutral-900"><?= htmlspecialchars($student_name) ?></p>
                    </div>
                    <div class="flex gap-2 items-center">
                        <?php renderIcon('grade', 'w-6 h-6') ?>
                        <p class="text-xl font-semibold text-neutral-900"><?= htmlspecialchars($class_name) ?></p>
                    </div>
                    <div class="flex gap-2 items-center">
                        <?php renderIcon('gender', 'w-6 h-6') ?>
                        <p class="text-xl font-semibold text-neutral-900"><?= htmlspecialchars($gender) ?></p>
                    </div>
                    <div class="flex gap-2 items-center">
                        <?php renderIcon('date', 'w-6 h-6') ?>
                        <p class="text-xl font-semibold text-neutral-900"><?= htmlspecialchars($dob) ?></p>
                    </div>
                    <div class="flex gap-2 items-center">
                        <?php renderIcon('grade', 'w-6 h-6') ?>
                        <p class="text-xl font-semibold text-neutral-900"><?= htmlspecialchars($student_name) ?></p>
                    </div>
                </div>
                <div class="w-1/2 mx-auto flex gap-4 mt-2">
                    <a href="studentDashboard.php" class="w-1/2 bg-blue-600 hover:bg-neutral-200 text-neutral-100 hover:text-neutral-900 hover:border hover:border-neutral-300 font-semibold rounded-full py-3 px-5 cursor-pointer text-center transition-all">Dashboard</a>
                    <div class="w-1/2 rounded-full bg-blue-600 flex justify-center items-center hover:bg-neutral-200 text-neutral-100 hover:text-neutral-900 transition-all hover:border hover:border-neutral-300">
                        <?php renderLogoutDialogue("w-full", "Log Out", "font-semibold w-full py-4 px-5 cursor-pointer", '', 'w-full h-fit justify-center items-center flex') ?>
                    </div>
                </div>
            </div>
            <div class="mx-auto w-full lg:w-1/2 rounded-md lg:overflow-y-scroll scrollbar-hide">
                <?php renderCards($cards, 'profile', $conn, $id, $class_name); ?>
                <?php renderCards($cards, 'session', $conn, $id, $class_name); ?>
                <?php renderCards($cards, 'term', $conn, $id, $class_name); ?>
            </div>
        </div>
    </div>
</body>
</html>