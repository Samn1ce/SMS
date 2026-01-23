<?php
include APP_ROOT . '/includes/dbh.inc.php';
include APP_ROOT . '/components/icons.php';
include APP_ROOT . '/includes/cards.php';

$id = $_SESSION["id"];
$surname = $_SESSION['surname'];
$firstname = $_SESSION['firstname'];
$class_id = $_SESSION['class_id'];
$class_name = $_SESSION['class_name'];
$class_arm = $_SESSION['class_arm'];
$arm_id = $_SESSION['arm_id'];
$role = $_SESSION['role'];

function getSelectedSubjects($conn, $user_id) {
    $subjectsSql = "SELECT subject_name FROM student_subjects WHERE user_id = ?";
    $stmt = mysqli_prepare($conn, $subjectsSql);
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $subjects = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $subjects[] = $row['subject_name'];
    }
    return $subjects;
}

$assignmentQuery = "SELECT * FROM assignments
                       WHERE class_id = ? 
                       AND (arm_id IS NULL OR arm_id = ?)
                       AND due_date >= NOW()";
$assignmentStmt = mysqli_prepare($conn, $assignmentQuery);
mysqli_stmt_bind_param($assignmentStmt, "ii", $class_id, $arm_id);
mysqli_stmt_execute($assignmentStmt);
$assignmentResult = mysqli_stmt_get_result($assignmentStmt);
$assignmentCount = mysqli_num_rows($assignmentResult);
?>

    
    <main class="max-w-7xl w-full p-2 mx-auto relative">
        <section class="mx-auto w-full lg:w-11/12 flex flex-col lg:flex-row lg:gap-4 gap-2">
            <div class="w-full lg:w-9/12 md:h-38 lg:h-48 bg-purple-500/90 rounded-md p-3 lg:pt-3 lg:pl-5 flex justify-center items-center">
                <div class="w-full h-full flex flex-wrap flex-col justify-between gap-4 lg:gap-0">
                    <div>
                        <p class="text-xl lg:text-2xl font-semibold text-neutral-50">Lorem, ipsum dolor.</p>
                        <p class="text-xs lg:text-sm text-neutral-200 font-semibold">Lorem ipsum dolor sit amet consectetur adipisicing elit. Debitis, nisi sequi tenetur possimus veniam beatae.</p>
                    </div>
                    <div class="flex flex-col md:flex-row gap-2 md:gap-x-14 lg:gap-20">
                        <div class="flex lg:justify-center lg:items-center gap-2">
                            <div class="w-10 h-10 border rounded-full flex justify-center items-center">
                                <?php renderIcon('person', 'w-6 h-6') ?>
                            </div>
                            <div>
                                <p class="text-xl font-semibold text-neutral-50"><?= htmlspecialchars($surname) ?>&nbsp;<?= htmlspecialchars($firstname) ?></p>
                                <p class="text-xs text-neutral-200 font-semibold -mt-1">Fullname</p>
                            </div>
                        </div>
                        <div class="flex lg:justify-center lg:items-center gap-2">
                            <div class="w-10 h-10 border rounded-full flex justify-center items-center">
                                <?php renderIcon('grade', 'w-6 h-6') ?>
                            </div>
                            <div>
                                <p class="text-xl font-semibold text-neutral-50"><?= htmlspecialchars($class_name) ?>&#40;<?= htmlspecialchars($class_arm) ?>&#41;</p>
                                <p class="text-xs text-neutral-200 font-semibold -mt-1">class</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <img src="public\Graduation.png" class="w-64 hidden lg:block" /> -->
            </div>
            <div class="w-full lg:w-1/4 flex flex-col gap-2">
                <?php if ($role === 'student'): ?>
                    <a
                        href="#"
                        @click.prevent="navigate('result')"
                        class="w-full p-2 flex justify-center items-center bg-purple-400 hover:bg-purple-500 duration-300 transition-all text-zinc-50 font-semibold text-sm rounded-md"
                    >
                        Result Profile
                    </a>
                <?php else: ?>
                    <a
                        href="#"
                        @click.prevent="navigate('viewStudents')"
                        class="w-full p-2 flex justify-center items-center bg-purple-400 hover:bg-purple-500 duration-300 transition-all text-zinc-50 font-semibold text-sm rounded-md"
                    >
                        View Student
                    </a>
                <?php endif; ?>
                <div class="w-full h-18 bg-white flex flex-col rounded-b-xl shadow-gray-950">
                    <div class="w-full p-2 flex justify-center items-center bg-purple-300/30 text-purple-500/80 font-semibold text-sm shadow-black">Current Time</div>
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
        <section class="mx-auto w-full lg:w-11/12 mt-5">
            <?php 
                if ($role === 'student') {
                    ?>
                        <h2 class="font-bold text-xl pl-5 mb-2">Daily Assesment</h2>
                        <div class="w-full flex flex-col md:flex-row gap-4">
                            <div class="w-full lg:w-1/2 h-32 bg-white flex flex-col lg:flex-1 rounded-b-xl shadow-gray-950">
                                <div class="w-full p-2 flex justify-center items-center bg-purple-300/30 text-purple-500/80 font-semibold text-sm shadow-black">Assigment</div>
                                <p class="w-full flex-1 text-neutral-900 text-center font-semibold pt-5">
                                    <?php 
                                        if ($assignmentCount > 0) {
                                            echo "You have $assignmentCount assignment(s).";
                                        } else {
                                            echo 'You don\'t have any assignment at this time.';
                                        }
                                    ?>
                                </p>
                                <a href="#" @click.prevent="navigate('assignment')" class="text-xs mb-2 self-end mr-3 border-b border-dotted border-b-purple-400 text-neutral-700 hover:text-neutral-900 duration-300 transition-all font-semibold">View assignments</a>
                            </div>
                            <div class="w-full lg:w-1/2 h-32 bg-white flex flex-col lg:flex-1 rounded-b-xl shadow-gray-950">
                                <div class="w-full p-2 flex justify-center items-center bg-purple-300/30 text-purple-500/80 font-semibold text-sm shadow-black">Last Attendance</div>
                                <p class="w-full flex-1 text-neutral-900 text-3xl lg:text-5xl text-center font-semibold pt-5">7th, Oct</p>
                                <a href="#" @click.prevent="navigate('attendance')" class="text-xs mb-2 self-end mr-3 border-b border-dotted border-b-purple-400 text-neutral-700 hover:text-neutral-900 duration-300 transition-all font-semibold">View attendance</a>
                            </div>
                        </div>
                    <?php
                } else {
                    ?>
                        <div class="w-full">
                            <div class="w-full md:w-1/2 lg:w-1/4 p-3 rounded-md bg-white border-zinc-200/65 border shadow-xl">
                                <div class="w-full flex justify-center items-center">
                                    <?php renderIcon('book', 'w-14 h-14') ?>
                                </div>
                                <p class="text-sm text-neutral-900 font-semibold">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Natus dolorum quis nihil debitis inventore illo!</p>
                                <button @click.prevent="navigate('assignment')" class="w-full py-2 text-center rounded-full bg-purple-500 text-xs hover:bg-purple-600 transition duration-300 mt-2 cursor-pointer text-neutral-50 font-semibold">
                                    Give Assignments
                                </button>
                            </div>
                        </div>
                    <?php
                }
            ?>
        </section>
        <section class="mx-auto w-full lg:w-11/12 mt-5">
            <div class="w-full flex flex-col md:flex-row gap-4">
                <?php
                    if ($role === 'student') {
                    ?>
                        <div class="w-full lg:w-1/2">
                            <h3 class="font-bold text-xl pl-5 mb-2">Term Assesment</h3>
                            <div class="w-full">
                                <?php renderCards($cards, 'term', $conn, $id, $class_name); ?>
                            </div>
                        </div>
                        <div class="w-full lg:w-1/2">
                            <h3 class="font-bold text-xl pl-5 mb-2">Session Assesment</h3>
                            <div class="w-full">
                                <?php renderCards($cards, 'session', $conn, $id, $class_name); ?>
                            </div>
                        </div>
                    <?php
                    } else {
                        echo '';
                    }
                ?>
            </div>
        </section>
    </main>