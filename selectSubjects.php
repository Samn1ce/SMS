<?php 
session_start();
include 'includes/dbh.inc.php';
include 'components/header.php';
include 'components/logoutDialogue.php';

$id = $_SESSION["id"];
$surname = $_SESSION['surname'];
$firstname = $_SESSION['firstname'];
$arm_id = $_SESSION['arm_id'];
$role = $_SESSION['role'];

if (!isset($_SESSION["id"])) {
    header("Location: login.php");
    exit();
}

$subjectsQuery = "SELECT * FROM subjects";
$subjectsResult = mysqli_query($conn, $subjectsQuery);

$class_armQuery = "SELECT * FROM class_arms";
$class_armResult = mysqli_query($conn, $class_armQuery);

function getSelectedSubjects($conn, $user_id) {
    $subjectsSql = "SELECT user_id FROM student_subjects WHERE user_id = ?";
    $stmt = mysqli_prepare($conn, $subjectsSql);
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $subjects = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $subjects[] = $row['subject_id'];
    }
    return $subjects;
}
$selectedSubjects = getSelectedSubjects($conn, $id);

$coreSubjectIds = [];
$coreQuery = "SELECT id FROM subjects WHERE subject_name IN ('Mathematics', 'English')";
$coreResult = mysqli_query($conn, $coreQuery);
while ($coreRow = mysqli_fetch_assoc($coreResult)) {
    $coreSubjectIds[] = (int)$coreRow['id'];
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
    <?php renderHeader('student_name', 'role', $id) ?>
    <main class="w-full relative">
        <div class="mx-auto max-w-7xl w-11/12 md:w-10/12 border-zinc-200/65 border mt-3 rounded-md bg-white flex flex-col lg:flex-row lg:flex-wrap gap-4 lg:gap-0 p-3 lg:p-2">
            <div class="w-1/2">
                <img src="public/BookLover.png" class="lg:block hidden" />
            </div>
            <div class="w-full lg:w-1/2 flex flex-col justify-center gap-6 p-3">
                <div>
                    <h2 class="text-neutral-900 text-3xl lg:text-4xl">Welcome <span class="font-semibold"><?= htmlspecialchars($surname) ?>&nbsp;<?= htmlspecialchars($firstname) ?></span>!</h2>
                </div>
                <div>
                    <form action="includes/saveStudentData.php" method="POST" class="space-y-3">
                        <p class="text-zinc-400 font-semibold">Select your Class Arm...</p>
                        <div class="flex gap-2">
                            <input type="hidden" name="user_id" value="<?= $id ?>">
                            <?php while($class_arm = mysqli_fetch_assoc($class_armResult)) : 
                                $selectedArm = $arm_id ?? null;
                                $isChecked = ($selectedArm == $class_arm['id']) ? 'checked' : '';
                            ?>
                                <label class="flex gap-1">
                                    <input 
                                        type="radio" 
                                        name="arm_id" 
                                        value="<?= htmlspecialchars($class_arm['id']) ?>" 
                                        class="cursor-pointer"
                                        required
                                        <?= $isChecked ?>
                                    />
                                    <span><?= htmlspecialchars($class_arm['class_arm']) ?></span>
                                </label>
                            <?php endwhile; ?>
                        </div>
                        <p class="text-zinc-400 font-semibold">Select your Offered Subjects...</p>
                        <!-- <input type="hidden" name="user_id" value="<?= $id ?>"> -->
                        <?php while ($subject = mysqli_fetch_assoc($subjectsResult)) : 
                            $isCore = in_array($subject['id'], $coreSubjectIds);
                            $isSelected = in_array($subject['id'], $selectedSubjects);
                            $isChecked = ($isCore || $isSelected) ? 'checked' : '';
                            $isDisabled = $isCore ? 'disabled' : '';
                        ?>
                            <label class="flex items-center space-x-2">
                                <input 
                                    type="checkbox" 
                                    name="subjects[]" 
                                    value="<?= htmlspecialchars($subject['id']) ?>"
                                    <?= $isChecked ?>
                                    <?= $isDisabled ?>
                                    class="<?= $isCore ? 'cursor-not-allowed' : 'cursor-pointer' ?>"
                                > 
                                <span><?= htmlspecialchars($subject['subject_name']) ?></span>
                            </label>
                        <?php endwhile; ?>

                        <button 
                            type="submit"
                            class="bg-blue-600 text-white px-4 py-2 rounded-md w-full mt-3 hover:bg-blue-700 cursor-pointer"
                        >
                            Save Subjects
                        </button>
                    </form>
                </div>
            </div>
            <?php renderLogoutDialogue('mx-auto', 'Log Out', 'cursor-pointer font-semibold text-blue-400 border-dotted border-b-blue-400 border-b', 'Not Sure about subjects? ', 'mx-auto text-sm 2xl:-mt-5', ', while you confirm.') ?>
        </div>
    </main>
</body>
</html>