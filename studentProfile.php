<?php
    include 'includes/dbh.inc.php';
    include 'components/header.php';
    session_start();

    // ✅ Check that an ID is provided in the URL
    if (!isset($_GET['id'])) {
        header("Location: ../teacherResult.php");
        die("Student ID not provided");
    }

    $student_id = $_GET['id'];

    // ✅ Fetch student basic details and class
    $sql = "SELECT s.id, s.studentName, c.class_name
            FROM students s
            JOIN classes c ON s.class_id = c.id
            WHERE s.id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $student_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if ($student = mysqli_fetch_assoc($result)) {
        $_SESSION['student_name'] = $student['studentName'];

    }

    if (!$student) {
        die("Student not found");
    }

    // ✅ Fetch subjects offered by this student
    $subjectQuery = "SELECT sub.subject_name
                    FROM student_subjects ss
                    JOIN subjects sub ON ss.subject_id = sub.id
                    WHERE ss.student_id = ?";
    $subjectStmt = mysqli_prepare($conn, $subjectQuery);
    mysqli_stmt_bind_param($subjectStmt, "i", $student_id);
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
</head>
<body>
    <?php renderHeader($student_id) ?>

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