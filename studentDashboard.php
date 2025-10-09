<?php
session_start();
include 'includes/dbh.inc.php';

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$id = $_SESSION["user_id"];

// Fetch login count
$sql = "SELECT login_count FROM students WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);
$showModal = $row["login_count"] <= 1;

// Fetch available subjects
$subjectsQuery = "SELECT * FROM subjects";
$subjectsResult = mysqli_query($conn, $subjectsQuery);
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
<body>
   <div>
        <p>
        <?php
            echo "Hello " . $_SESSION["username"] . ", you're a " . $_SESSION["role"];
        ?>
        </p>
   </div>
   <div>
    <a href="">Check Result</a>
    <a href="">Check Attendance</a>
   </div>

    <div x-data="{ showModal: <?= $showModal ? 'true' : 'false' ?> }" class="w-full flex flex-col items-center absolute">
  <!-- SUBJECT SELECTION MODAL -->
        <div x-if="showModal">
            <div class="bg-zinc-300 p-6 rounded-xl w-96 shadow-lg">
                <h2 class="text-xl font-semibold mb-4 text-center">Select Your Subjects</h2>

                <form action="includes/saveSubjects.php" method="POST" class="space-y-3">
                    <input type="hidden" name="student_id" value="<?= $id ?>">

                    <?php while ($subject = mysqli_fetch_assoc($subjectsResult)) : ?>
                        <label class="flex items-center space-x-2">
                        <input type="checkbox" name="subjects[]" value="<?= htmlspecialchars($subject['subject_name']) ?>"> 
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

   <div x-data="{ open: false }">
        <button  class="border-2 border-black cursor-pointer p-3" x-on:click="open = ! open">Log out</button>
    
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