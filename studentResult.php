<?php 
    session_start();
    include 'includes/dbh.inc.php';
    include 'components/header.php';

    $id = $_SESSION['user_id'];
    $student_name = $_SESSION['student_name'];
    $class_name = $_SESSION['class_name'];
    $gender = $_SESSION['gender'];
    $dob = $_SESSION['dob'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script> 
    <title><?= $_SESSION['student_name'] ?> Results</title>
</head>
<body class="bg-neutral-50">
    <?php renderHeader($id) ?>
    <main class="max-w-7xl w-full p-2 mx-auto flex flex-col gap-4">
        <section class="bg-white h-40 w-10/12 shadow-2xl rounded-md mx-auto px-3 py-2 flex flex-col gap-2">
            <h3 class="font-semibold text-blue-400">Student Details</h3>
            <div class="px-5 flex-1 flex gap-4">
                <div class="rounded-full h-28 w-28 border"></div>
                <div class="flex flex-1 items-center text-neutral-800">
                    <div class="flex flex-col gap-2 pr-3 mr-3 border-r border-zinc-200">
                        <div class="flex">
                            <p class="italic">Student Name:&nbsp;</p>
                            <p class="font-semibold"><?= htmlspecialchars($student_name) ?></p>
                        </div>
                        <hr class="border border-zinc-200 w-11/12 mx-auto" />
                        <div class="flex">
                            <p class="italic">Class:&nbsp;</p>
                            <p class="font-semibold"><?= htmlspecialchars($class_name) ?></p>
                        </div>
                    </div>
                    <div class="flex flex-col gap-2 pr-3 mr-3 border-r border-zinc-200">
                        <div class="flex">
                            <p class="italic">Gender:&nbsp;</p>
                            <p class="font-semibold"><?= htmlspecialchars($gender) ?></p>
                        </div>
                        <hr class="border border-zinc-200 w-11/12 mx-auto" />
                        <div class="flex">
                            <p class="italic">D-O-B:&nbsp;</p>
                            <p class="font-semibold"><?= htmlspecialchars($dob) ?></p>
                        </div>
                    </div>
                    <div class="flex flex-col gap-2 pr-3 mr-3">
                        <div class="flex">
                            <p class="italic">Year:&nbsp;</p>
                            <p class="font-semibold">20<?= date("y") ?></p>
                        </div>
                        <hr class="border border-zinc-200 w-11/12 mx-auto" />
                        <div class="flex">
                            <p class="italic">Position:&nbsp;</p>
                            <p class="font-semibold">N/A</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="bg-white max-w-7xl w-10/12 p-3 mx-auto rounded-md shadow-2xl overflow-hidden">
            <!-- Title -->
            <div class="w-full px-4 flex justify-between items-center">
                <h3 class="font-semibold text-lg text-blue-400">Marks</h3>
                <div class="text-sm">
                    <p class="italic text-center">Choose Result to Preview:&nbsp;</p>
                    <label class="font-semibold">Class:</label>
                    <select>
                        <option>JSS 1</option>
                        <option>JSS 2</option>
                        <option>JSS 3</option>
                    </select>
                    <label class="font-semibold">Term</label>
                    <select>
                        <option>First Term</option>
                        <option>Second Term</option>
                        <option>Third Term</option>
                    </select>
                </div>
            </div>

            <!-- Table -->
            <table class="w-full mt-2">
                <!-- Header -->
                <thead>
                    <tr class="bg-gray-50 text-sm text-gray-600">
                        <th class="border px-3 py-2 text-left" rowspan="2">Subjects</th>
                        <th class="border px-3 py-2 text-center" rowspan="2">Exam Score</th>
                        <th class="border px-3 py-2 text-center" colspan="2">Continuous Assesments</th>
                        <th class="border px-3 py-2 text-center" rowspan="2">Class Highest Mark</th>
                        <th class="border px-3 py-2 text-center" rowspan="2">Grade</th>
                    </tr>
                    <tr class="bg-gray-50 text-sm text-gray-600">
                        <th class="border px-3 py-1 text-center">C.A 1</th>
                        <th class="border px-3 py-1 text-center">C.A 2</th>
                    </tr>
                </thead>

                <!-- Body -->
                <tbody class="text-sm text-gray-700">
                <tr>
                    <td class="border px-3 py-2">English</td>
                    <td class="border px-3 py-2 text-center">85</td>
                    <td class="border px-3 py-2 text-center">85</td>
                    <td class="border px-3 py-2 text-center">85</td>
                    <td class="border px-3 py-2 text-center">85</td>
                    <td class="border px-3 py-2 text-center">A1</td>
                </tr>
                <tr class="bg-gray-50">
                    <td class="border px-3 py-2">Maths</td>
                    <td class="border px-3 py-2 text-center">78</td>
                    <td class="border px-3 py-2 text-center">78</td>
                    <td class="border px-3 py-2 text-center">78</td>
                    <td class="border px-3 py-2 text-center">78</td>
                    <td class="border px-3 py-2 text-center">A1</td>

                </tr>
                <tr>
                    <td class="border px-3 py-2">Science</td>
                    <td class="border px-3 py-2 text-center">65</td>
                    <td class="border px-3 py-2 text-center">65</td>
                    <td class="border px-3 py-2 text-center">65</td>
                    <td class="border px-3 py-2 text-center">65</td>
                    <td class="border px-3 py-2 text-center">B3</td>
                </tr>
                <tr class="bg-gray-50">
                    <td class="border px-3 py-2">History</td>
                    <td class="border px-3 py-2 text-center">52</td>
                    <td class="border px-3 py-2 text-center">52</td>
                    <td class="border px-3 py-2 text-center">52</td>
                    <td class="border px-3 py-2 text-center">52</td>
                    <td class="border px-3 py-2 text-center">C4</td>
                </tr>
                <tr>
                    <td class="border px-3 py-2">Hindi</td>
                    <td class="border px-3 py-2 text-center">75</td>
                    <td class="border px-3 py-2 text-center">75</td>
                    <td class="border px-3 py-2 text-center">75</td>
                    <td class="border px-3 py-2 text-center">75</td>
                    <td class="border px-3 py-2 text-center">A1</td>
                </tr>
                </tbody>
            </table>
        </section>
        <section>
            <div class="w-10/12 h-20 bg-blue-400 rounded-md mx-auto shadow px-3 py-2">
                <h3 class="font-semibold text-neutral-100/95">Grading Scale:</h3>
                <div class="text-neutral-100 ml-5 flex gap-8">
                    <div class="flex">
                        <p class="italic">A1:&nbsp;</p>
                        <p class="font-semibold">75 - 100</p>
                    </div>
                    <div class="flex">
                        <p class="italic">B2:&nbsp;</p>
                        <p class="font-semibold">65 - 74</p>
                    </div>
                    <div class="flex">
                        <p class="italic">B3:&nbsp;</p>
                        <p class="font-semibold">60 - 64</p>
                    </div>
                    <div class="flex">
                        <p class="italic">C4:&nbsp;</p>
                        <p class="font-semibold">55 - 59</p>
                    </div>
                    <div class="flex">
                        <p class="italic">C5:&nbsp;</p>
                        <p class="font-semibold">50 - 54</p>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>
</html>