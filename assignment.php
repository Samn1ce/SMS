<?php 
    session_start();
    include 'includes/dbh.inc.php';
    include 'components/header.php';
    include 'components/icons.php';

    $id = $_SESSION["user_id"];
    $surname = $_SESSION['surname'];
    $firstname = $_SESSION['firstname'];
    $class_name = $_SESSION['class_name'];
    $role = $_SESSION['role'];

    $classQuery = "SELECT * FROM classes";
    $classResult = mysqli_query($conn, $classQuery);

    $class_armQuery = "SELECT * FROM class_arms";
    $class_armResult = mysqli_query($conn, $class_armQuery);

    $subjects = "SELECT * FROM subjects";
    $subjectsResult = mysqli_query($conn, $subjects);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script> 
    <title>Assignments</title>
</head>
<body class="bg-neutral-50">
    <?php renderHeader($id) ?>
    <main class="w-full text-neutral-800">
        <div class="max-w-7xl w-11/12 lg:w-10/12 mx-auto">
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
                <div class="w-full flex flex-col lg:flex-row gap-4 p-5">
                    <div class="w-full rounded-xl p-2 bg-white border border-zinc-200/65 hover:border-zinc-700/30 hover:shadow-md duration-300 transition-all">
                        <p class="font-semibold text-xl">Mathematics Assignment</p>
                        <div class="pl-2 flex justify-between">
                            <p class="italic text-xs md:text-sm">From: <span class="font-semibold">John Doe</span></p>
                            <div>
                                <p class="italic text-xs md:text-sm">Date Given: <span class="font-semibold">Monday, 20 August.</span></p>
                                <p class="italic text-xs md:text-sm">To be Submitted: <span class="font-semibold">Thursday, 24 August. 12:00pm</span></p>
                            </div>
                        </div>
                        <p class="mt-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia veritatis quas ipsam consequatur ipsum facere quaerat obcaecati facilis itaque repellat cum, totam sequi? Ea qui ipsa veniam, facilis deleniti velit.</p>
                    </div>
                    <div class="w-full rounded-xl p-2 bg-white border border-zinc-200/65 hover:border-zinc-700/30 hover:shadow-md duration-300 transition-all">
                        <p class="font-semibold text-xl">Mathematics Assignment</p>
                        <div class="pl-2 flex justify-between">
                            <p class="italic text-xs md:text-sm">From: <span class="font-semibold">John Doe</span></p>
                            <div>
                                <p class="italic text-xs md:text-sm">Date Given: <span class="font-semibold">Monday, 20 August.</span></p>
                                <p class="italic text-xs md:text-sm">To be Submitted: <span class="font-semibold">Thursday, 24 August. 12:00pm</span></p>
                            </div>
                        </div>
                        <p class="mt-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia veritatis quas ipsam consequatur ipsum facere quaerat obcaecati facilis itaque repellat cum, totam sequi? Ea qui ipsa veniam, facilis deleniti velit.</p>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>