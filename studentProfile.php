<?php
    include 'includes/dbh.inc.php';
    include 'includes/cards.php';
    include 'components/header.php';
    include 'components/icons.php';

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
    $sql = "SELECT s.id, s.studentName, c.class_name
            FROM students s
            JOIN classes c ON s.class_id = c.id
            WHERE s.id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if ($student = mysqli_fetch_assoc($result)) {
        $_SESSION['student_name'] = $student['studentName'];
        $className = $student['class_name'];
    }

    if (!$student) {
        die("Student not found");
    }

    // ✅ Fetch subjects offered by this student
    $subjectQuery = "SELECT sub.subject_name
                    FROM student_subjects ss
                    JOIN subjects sub ON ss.subject_id = sub.id
                    WHERE ss.id = ?";
    $subjectStmt = mysqli_prepare($conn, $subjectQuery);
    mysqli_stmt_bind_param($subjectStmt, "i", $id);
    mysqli_stmt_execute($subjectStmt);
    $subjectResult = mysqli_stmt_get_result($subjectStmt);

    $subjects = [];
    while ($row = mysqli_fetch_assoc($subjectResult)) {
        $subjects[] = $row['subject_name'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script> 
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title><?= htmlspecialchars($_SESSION['student_name']) ?> Profile</title>
    <style>
        .scrollbar-hide::-webkit-scrollbar { display: none; }
        .scrollbar-hide {
        -ms-overflow-style: none;
        scrollbar-width: none;
        }
    </style>
</head>
<body class="bg-neutral-50 h-screen">
    <?php renderHeader($id) ?>
    <div class="mx-auto w-10/12 h-[85vh] flex gap-4 mt-3 text-neutral-900 relative">
        <div class="w-1/2 flex flex-col justify-center items-center gap-6 rounded-md bg-white border">
            <div class="border w-40 h-40 rounded-full"></div>
            <div class="mx-auto flex flex-col gap-2">
                <div class="flex gap-2 items-center">
                    <?php renderIcon('personProfile', 'w-6 h-6') ?>
                    <p class="text-xl font-semibold text-neutral-900"><?= htmlspecialchars($_SESSION['student_name']) ?></p>
                </div>
                <div class="flex gap-2 items-center">
                    <?php renderIcon('grade', 'w-6 h-6') ?>
                    <p class="text-xl font-semibold text-neutral-900"><?= htmlspecialchars($student['class_name']) ?></p>
                </div>
                <div class="flex gap-2 items-center">
                    <?php renderIcon('personProfile', 'w-6 h-6') ?>
                    <p class="text-xl font-semibold text-neutral-900"><?= htmlspecialchars($_SESSION['student_name']) ?></p>
                </div>
                <div class="flex gap-2 items-center">
                    <?php renderIcon('grade', 'w-6 h-6') ?>
                    <p class="text-xl font-semibold text-neutral-900"><?= htmlspecialchars($student['class_name']) ?></p>
                </div>
                <div class="flex gap-2 items-center">
                    <?php renderIcon('grade', 'w-6 h-6') ?>
                    <p class="text-xl font-semibold text-neutral-900"><?= htmlspecialchars($student['class_name']) ?></p>
                </div>
            </div>
        </div>
        <div class="w-1/2 rounded-md overflow-y-scroll scrollbar-hide">
            <?php renderCards($cards, 'session', $conn, $id, $className); ?>
            <?php renderCards($cards, 'session', $conn, $id, $className); ?>
        </div>
    </div>

    <!-- <h1>Student Summary</h1>
   <div>
     <p class="font-semibold"><?= htmlspecialchars($_SESSION['student_name']) ?></p>
     <p>Class: <?= htmlspecialchars($student['class_name']) ?></p>
     <p>Gender: M</p>
     <p>DOB: 12-02-02</p>
   </div>
   <br/>
   <h3 class="text-xl font-semibold">Offered Subjects</h3>
    <?php if (count($subjects) > 0): ?>
        <ul class="list-disc pl-6 space-y-1 mt-2">
            <?php foreach ($subjects as $subject): ?>
                <li><?= htmlspecialchars($subject) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p class="text-gray-500 mt-2">No subjects found for this student.</p>
    <?php endif; ?> -->
</body>
</html>