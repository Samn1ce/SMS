<?php 
    // session_start();
    include APP_ROOT . '/includes/dbh.inc.php';
    include APP_ROOT . '/components/header.php';
    include APP_ROOT . '/components/icons.php';

    $id = $_SESSION["user_id"];
    $surname = $_SESSION['surname'];
    $firstname = $_SESSION['firstname'];
    $class_name = $_SESSION['class_name'];
    $class_id = $_SESSION['class_id'];
    $arm_id = $_SESSION['arm_id'];
    $role = $_SESSION['role'];

    $classQuery = "SELECT * FROM classes";
    $classResult = mysqli_query($conn, $classQuery);

    $class_armQuery = "SELECT * FROM class_arms";
    $class_armResult = mysqli_query($conn, $class_armQuery);

    $subjects = "SELECT * FROM subjects";
    $subjectsResult = mysqli_query($conn, $subjects);

    if ($role === 'teacher') {
        // Teachers see only assignments they created
        $assignmentsQuery = "
            SELECT 
                a.*,
                c.class_name,
                ca.class_arm,
                s.subject_name,
                CONCAT(t.teacher_firstname, ' ', t.teacher_surname) as teacher_name
            FROM assignments a
            LEFT JOIN classes c ON a.class_id = c.id
            LEFT JOIN class_arms ca ON a.arm_id = ca.id
            LEFT JOIN subjects s ON a.subject_id = s.id
            LEFT JOIN teachers t ON a.teacher_id = t.id
            WHERE a.teacher_id = ?
            ORDER BY a.created_at DESC
        ";
        $stmt = mysqli_prepare($conn, $assignmentsQuery);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $assignmentsResult = mysqli_stmt_get_result($stmt);
    } elseif ($role === 'student') {
        // Students see assignments for their class
        // If arm_id is NULL in assignment = for all arms
        // If arm_id matches student's arm = for specific arm
        $assignmentsQuery = "
            SELECT 
                a.*,
                c.class_name,
                ca.class_arm,
                s.subject_name,
                CONCAT(t.teacher_firstname, ' ', t.teacher_surname) as teacher_name
            FROM assignments a
            LEFT JOIN classes c ON a.class_id = c.id
            LEFT JOIN class_arms ca ON a.arm_id = ca.id
            LEFT JOIN subjects s ON a.subject_id = s.id
            LEFT JOIN teachers t ON a.teacher_id = t.id
            WHERE a.class_id = ?
            AND (a.arm_id IS NULL OR a.arm_id = ?)
            ORDER BY a.created_at DESC
        ";
        $stmt = mysqli_prepare($conn, $assignmentsQuery);
        mysqli_stmt_bind_param($stmt, "ii", $class_id, $arm_id);
        mysqli_stmt_execute($stmt);
        $assignmentsResult = mysqli_stmt_get_result($stmt);
    }
?>

    <main class="w-full text-neutral-800 p-2">
        <div class="max-w-7xl w-full lg:w-11/12 mx-auto">
            <div class="w-full flex flex-col md:flex-row justify-between md:items-center gap-4 md:gap-0 p-2">
                <h2 class="text-2xl font-semibold">Assignments</h2>
                <div class="flex gap-4">
                    <select class="border outline-none p-2 rounded-md bg-white border-zinc-200/65 hover:border-zinc-800/60 transition-all duration-300 cursor-pointer">
                        <option>--Sort By--</option>
                        <option>Submission Date</option>
                        <option>Date Given</option>
                    </select>
                    <?php if ($role === 'teacher') {
                    ?>
                        <div x-data="{ open: false }">
                            <button 
                                @click="open = ! open"
                                class="font-semibold border p-2 rounded-md flex gap-2 bg-white border-zinc-200/65 hover:border-zinc-800/60 transition-all duration-300 cursor-pointer"
                            >
                                <span><?php renderIcon('new', 'w-6 h-6') ?></span> 
                                New
                            </button>

                            <div x-show="open" x-transition.opacity.duration.300ms class="bg-zinc-100/20 fixed h-screen top-0 left-0 w-full flex justify-center items-center backdrop-blur-sm p-5">
                                <div x-transition.opacity.scale.duration.350ms class="bg-white/40 w-11/12 lg:w-2/5 flex justify-center items-center p-5 rounded-4xl backdrop-blur-md border-zinc-100 border shadow-lg">
                                    <div class="flex flex-col w-full rounded-3xl p-3 md:p-5 bg-neutral-50 border border-neutral-100">
                                        <h3 class="font-semibold text-xl">New Assigment</h3>
                                        <form 
                                            method="POST"
                                            action="includes/sendAssignments.php"
                                        >
                                            <div class="flex flex-col md:flex-row justify-between gap-4 w-full mt-3">
                                                <div class="flex flex-col w-full">
                                                    <label id="class" for="class" class="italic text-xs md:text-sm font-semibold">Class:</label>
                                                    <select required name="class_id" id="class" class="border rounded-md p-1 text-xs md:text-sm">
                                                        <option value="">-- Select Class --</option>
                                                        <?php while ($class = mysqli_fetch_assoc($classResult)) : ?>
                                                        <option value="<?= $class['id'] ?>">
                                                            <?= htmlspecialchars($class['class_name']) ?>
                                                        </option>
                                                        <?php endwhile; ?>
                                                    </select>
                                                </div>
                                                <div required class="flex flex-col w-full">
                                                    <label id="class" for="class" class="italic text-xs md:text-sm font-semibold">Class Arm:</label>
                                                    <select name="arm_id" class="border rounded-md p-1 text-xs md:text-sm">
                                                        <option>-- Select Arm --</option>
                                                        <?php while ($class_arm = mysqli_fetch_assoc($class_armResult)) : ?>
                                                        <option value="<?= $class_arm['id'] ?>">
                                                            <?= htmlspecialchars($class_arm['class_arm']) ?>
                                                        </option>
                                                        <?php endwhile; ?>
                                                    </select>
                                                </div>
                                                <div required class="flex flex-col w-full">
                                                    <label id="class" for="class" class="italic text-xs md:text-sm font-semibold">To be submitted:</label>
                                                    <input type="date" name="due_date" class="border rounded-md p-0.5">
                                                </div>
                                            </div>
                                            <select required name="subject_id" id="subject" class="border rounded-md p-1 text-xs md:text-sm w-full mt-3">
                                                <option value="">-- Select Subject --</option>
                                                <?php while ($subjects = mysqli_fetch_assoc($subjectsResult)) : ?>
                                                    <option value="<?= $subjects['id'] ?>">
                                                        <?= htmlspecialchars($subjects['subject_name']) ?>
                                                    </option>
                                                <?php endwhile; ?>
                                            </select>                                        
                                            <textarea required name="description" class="border rounded-md w-full min-h-40 mt-3 p-3" placeholder="Type Assignments here..."></textarea>
                                            <button type="submit" class="w-full mt-3 p-2 cursor-pointer rounded-xl bg-blue-500 hover:bg-blue-600/90 transition-all duration-300 text-neutral-100 font-semibold">Send Out</button>
                                        </form>
                                        <button x-on:click="open = false" class="w-full mt-3 p-2 cursor-pointer rounded-xl bg-red-500 hover:bg-red-600/90 transition-all duration-300 text-neutral-100 font-semibold">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="w-full">
                <div class="w-full grid grid-cols-1 lg:grid-cols-2 gap-4">
                    <?php 
                    if (isset($assignmentsResult) && mysqli_num_rows($assignmentsResult) > 0) {
                        while ($assignment = mysqli_fetch_assoc($assignmentsResult)) {
                            // Format dates
                            $dueDate = date('l, d F Y', strtotime($assignment['due_date']));
                            $createdDate = date('l, d F Y', strtotime($assignment['created_at']));                    
                            // Display arm info
                            $armDisplay = $assignment['class_arm'] 
                                ? ' - ' . htmlspecialchars($assignment['class_arm']) 
                                : ' (All Arms)';
                    ?>
                            <div class="w-full rounded-xl p-2 bg-white border border-zinc-200/65 hover:border-zinc-700/30 hover:shadow-md duration-300 transition-all">
                                <p class="font-semibold text-xl"><?= htmlspecialchars($assignment['subject_name']) ?> Assignment</p>
                                <div class="pl-2 flex justify-between">
                                    <p class="italic text-xs md:text-sm">From: <span class="font-semibold"><?= htmlspecialchars($assignment['teacher_name']) ?></span></p>
                                    <div>
                                        <p class="italic text-xs md:text-sm">Date Given: <span class="font-semibold"><?htmlspecialchars($createdDate) ?></span></p>
                                        <p class="italic text-xs md:text-sm">To be Submitted: <span class="font-semibold"><?= htmlspecialchars($dueDate) ?>. 12:00pm</span></p>
                                    </div>
                                </div>
                                <p class="mt-4"><?= nl2br(htmlspecialchars($assignment['description'])) ?></p>
                            </div>
                    <?php 
                        }
                    } else {
                    ?>
                        <div class="w-full text-center py-10">
                            <p class="text-gray-500 text-lg font-semibold">
                                <?= $role === 'teacher' ? 'You haven\'t sent out any assignments yet' : 'No assignments available' ?>
                            </p>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </main>