<?php 
    // session_start();
    include APP_ROOT . '/includes/dbh.inc.php';

    $id = $_SESSION['user_id'];
    $surname = $_SESSION['surname'];
    $firstname = $_SESSION['firstname'];
    $class_name = $_SESSION['class_name'];
    $gender = $_SESSION['gender'];
    $dob = $_SESSION['dob'];

    // Handle AJAX requests
    if (isset($_GET['ajax']) && $_GET['ajax'] === '1') {
        $classId = (int)$_GET['class_id'];
        $termId = (int)$_GET['term_id'];
        $studentId = (int)$_GET['student_id'];

        // Get class and term names
        $classNameQuery = "SELECT class_name FROM classes WHERE id = $classId";
        $classNameResult = mysqli_query($conn, $classNameQuery);
        $classNameRow = mysqli_fetch_assoc($classNameResult);
        $className = $classNameRow['class_name'] ?? '';

        $termNameQuery = "SELECT term_name FROM terms WHERE id = $termId";
        $termNameResult = mysqli_query($conn, $termNameQuery);
        $termNameRow = mysqli_fetch_assoc($termNameResult);
        $termName = $termNameRow['term_name'] ?? '';

        // Get results
        $resultDataQuery = "SELECT r.*, s.subject_name
                            FROM results r
                            JOIN subjects s ON r.subject_id = s.id
                            WHERE r.student_id = $studentId
                            AND r.class_id = $classId
                            AND r.term_id = $termId";
        $resultData = mysqli_query($conn, $resultDataQuery);
        
        $results = [];
        while ($row = mysqli_fetch_assoc($resultData)) {
            $results[] = $row;
        }

        header('Content-Type: application/json');
        echo json_encode([
            'success' => true,
            'hasResults' => count($results) > 0,
            'results' => $results,
            'className' => $className,
            'termName' => $termName
        ]);
        exit;
    }

    $classQuery = "SELECT * FROM classes";
    $classResult = mysqli_query($conn, $classQuery);

    $termQuery = "SELECT * FROM terms";
    $termResult = mysqli_query($conn, $termQuery);

    // Get the latest result for initial load
    $reportCardQuery = "SELECT r.class_id, r.term_id, r.session_id
                        FROM results r
                        WHERE r.student_id = $id
                        ORDER BY r.session_id DESC, r.term_id DESC
                        LIMIT 1";
    $reportCardResult = mysqli_query($conn, $reportCardQuery);
    $latestResult = mysqli_fetch_assoc($reportCardResult);

    $selectedClass = $latestResult['class_id'] ?? null;
    $selectedTerm = $latestResult['term_id'] ?? null;

    // Get selected class and term names for display
    $selectedClassName = '';
    $selectedTermName = '';
    
    if ($selectedClass && $selectedTerm) {
        $classNameQuery = "SELECT class_name FROM classes WHERE id = $selectedClass";
        $classNameResult = mysqli_query($conn, $classNameQuery);
        $classNameRow = mysqli_fetch_assoc($classNameResult);
        $selectedClassName = $classNameRow['class_name'] ?? '';

        $termNameQuery = "SELECT term_name FROM terms WHERE id = $selectedTerm";
        $termNameResult = mysqli_query($conn, $termNameQuery);
        $termNameRow = mysqli_fetch_assoc($termNameResult);
        $selectedTermName = $termNameRow['term_name'] ?? '';
    }

    // Query for initial result data
    $resultData = null;
    $hasResults = false;
    $resultsArray = [];
    
    if ($selectedClass && $selectedTerm) {
        $resultDataQuery = "SELECT r.*, s.subject_name
                            FROM results r
                            JOIN subjects s ON r.subject_id = s.id
                            WHERE r.student_id = $id
                            AND r.class_id = $selectedClass
                            AND r.term_id = $selectedTerm";
        $resultData = mysqli_query($conn, $resultDataQuery);
        $hasResults = mysqli_num_rows($resultData) > 0;
        
        while ($row = mysqli_fetch_assoc($resultData)) {
            $resultsArray[] = $row;
        }
    }

    // Reset class result for dropdown
    mysqli_data_seek($classResult, 0);
    mysqli_data_seek($termResult, 0);

    $resultData = [
        'classId'   => $selectedClass,
        'termId'    => $selectedTerm,
        'studentId' => $id,
        'results'   => $resultsArray,
        'hasResults'=> $hasResults,
        'className' => $selectedClassName,
        'termName'  => $selectedTermName,
    ];
?>

    <main class="max-w-7xl w-full p-2 mx-auto flex flex-col gap-2 md:gap-4">
        <section class="bg-white lg:h-40 border border-zinc-200/65 shadow-lg md:shadow-2xl rounded-md mx-auto px-3 py-2 flex flex-col gap-2 w-full lg:w-11/12">
            <h3 class="font-semibold text-blue-400">Student Details</h3>
            <div class="px-5 flex-1 flex gap-4">
                <div class="rounded-full h-28 w-28 border hidden md:block"></div>
                <div class="flex flex-wrap flex-1 items-center text-neutral-800 text-xs md:text-sm lg:text-base">
                    <div class="flex flex-col gap-2 pr-3 mr-3 md:border-r border-zinc-200">
                        <div class="flex">
                            <p class="italic">Student Name:&nbsp;</p>
                            <p class="font-semibold"><?= htmlspecialchars($surname) ?>&nbsp;<?= htmlspecialchars($firstname) ?></p>
                        </div>
                        <hr class="border border-zinc-200 w-11/12 mx-auto" />
                        <div class="flex">
                            <p class="italic">Class:&nbsp;</p>
                            <p class="font-semibold"><?= htmlspecialchars($class_name) ?></p>
                        </div>
                    </div>
                    <div class="flex flex-col gap-2 pr-3 mr-3 md:border-r border-zinc-200">
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
        
        <section 
            class="bg-white max-w-7xl w-full lg:w-11/12 p-3 mx-auto rounded-md shadow-lg md:shadow-2xl overflow-scroll border border-zinc-200/65 result-scrollbar-hide"
            x-data='resultComponent(<?= json_encode($resultData, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>)'
        >
            <!-- Title -->
            <div class="w-full px-4 flex gap-2 md:gap-0 flex-col md:flex-row justify-between md:items-center">
                <h3 class="font-semibold text-lg text-blue-400">Marks</h3>
                <div class="text-xs md:text-sm">
                    <p class="italic md:text-center">Choose Result to Preview:&nbsp;</p>
                    <label class="font-semibold">Class:</label>
                    <select 
                        x-model="classId" 
                        @change="updateResults()"
                        class="outline-none"
                        :disabled="loading"
                    >
                        <?php while ($class = mysqli_fetch_assoc($classResult)) : ?>
                            <option value="<?= $class['id'] ?>">
                                <?= htmlspecialchars($class['class_name']) ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                    <label class="font-semibold">Term:</label>
                    <select 
                        x-model="termId" 
                        @change="updateResults()"
                        class="outline-none"
                        :disabled="loading"
                    >
                        <?php while ($term = mysqli_fetch_assoc($termResult)) : ?>
                            <option value="<?= $term['id']; ?>">
                                <?= htmlspecialchars($term['term_name']) ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
            </div>
            <div x-show="loading" class="h-full flex items-center justify-center">
                <div class="text-center">
                    <div class="inline-block animate-spin rounded-full h-8 w-8 border-t-2 border-b-2 border-purple-500"></div>
                    <p class="mt-2 text-gray-600">Loading Results...</p>
                </div>
            </div>
                <div x-show="!loading && hasResults">
                    <table class="w-full mt-2">
                        <thead>
                            <tr class="bg-gray-50 text-sm text-gray-600">
                                <th class="border px-3 py-2 text-left" rowspan="2">Subjects</th>
                                <th class="border px-3 py-2 text-center" rowspan="2">Exam Score</th>
                                <th class="border px-3 py-2 text-center" colspan="2">Continuous Assessments</th>
                                <th class="border px-3 py-2 text-center" rowspan="2">Total</th>
                                <th class="border px-3 py-2 text-center" rowspan="2">Grade</th>
                            </tr>
                            <tr class="bg-gray-50 text-sm text-gray-600">
                                <th class="border px-3 py-1 text-center">C.A 1</th>
                                <th class="border px-3 py-1 text-center">C.A 2</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm text-gray-700">
                            <template x-for="(result, index) in results" :key="result.id">
                                <tr :class="result.subject_id % 2 === 0 ? 'bg-gray-50' : ''">
                                    <td class="border px-3 py-2" x-text="result.subject_name"></td>
                                    <td class="border px-3 py-2 text-center" x-text="result.exam"></td>
                                    <td class="border px-3 py-2 text-center" x-text="result.ca1"></td>
                                    <td class="border px-3 py-2 text-center" x-text="result.ca2"></td>
                                    <td class="border px-3 py-2 text-center" x-text="result.total || '-'"></td>
                                    <td class="border px-3 py-2 text-center" x-text="getGrade(result.total)"></td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>

            <!-- No Results Message -->
            <div x-show="!loading && !hasResults" class="mt-4 p-4 bg-yellow-50 border border-yellow-200 rounded-md text-center">
                <p class="text-gray-700">
                    Student does not have a result for 
                    <span class="font-semibold" x-text="className"></span>
                    &nbsp;
                    <span class="font-semibold" x-text="termName"></span>
                </p>
            </div>
        </section>
        
        <section>
            <div class="w-full lg:w-11/12 lg:h-20 bg-blue-400 rounded-md mx-auto px-3 py-2 shadow-lg md:shadow-2xl">
                <h3 class="font-semibold text-neutral-100/95">Grading Scale:</h3>
                <div class="text-neutral-100 ml-5 flex flex-wrap gap-2 md:gap-8">
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
                    <div class="flex">
                        <p class="italic">D7:&nbsp;</p>
                        <p class="font-semibold">53 - 45</p>
                    </div>
                    <div class="flex">
                        <p class="italic">E8:&nbsp;</p>
                        <p class="font-semibold">45 - 40</p>
                    </div>
                    <div class="flex">
                        <p class="italic">F9:&nbsp;</p>
                        <p class="font-semibold">39 - 00</p>
                    </div>
                </div>
            </div>
        </section>
    </main>