<?php 
include APP_ROOT . '/includes/dbh.inc.php';
include APP_ROOT . '/components/schoolStatus.php';

$id = $_SESSION['id'];

$classQuery = "SELECT * FROM classes";
$classResult = mysqli_query($conn, $classQuery);
?>

<main class="w-full max-w-7xl mx-auto">
    <section 
        x-data="studentManager"
        class="mx-auto w-11/12 lg:w-10/12"
    >
        <h3 class="text-3xl font-semibold">View Students</h3>
        <div class="mt-4 p-2 flex flex-col md:flex-row justify-between items-start md:items-center gap-4 md:gap-0">
            <select 
                name="class_id" 
                id="class" 
                required 
                class="border p-2 rounded-md w-60 h-10"
                x-model="selectedClass"
                @change="search = ''; fetchStudents()"
            >
                <option value="">-- Select Class --</option>
                <?php while ($class = mysqli_fetch_assoc($classResult)) : ?>
                    <option value="<?= $class['id'] ?>">
                        <?= htmlspecialchars($class['class_name']) ?>
                    </option>
                <?php endwhile; ?>
            </select>
            <input 
                type="text" 
                placeholder="Search students..." 
                name="searchQuery" 
                class="w-60 h-10 border rounded-md p-2" 
                x-model="search"
                :disabled="!selectedClass"
                @input.debounce.500ms="fetchStudents"
            />
        </div>
        <template x-if="students.length > 0">
            <div class="w-full mt-5">
                <template x-for="student in students" :key="student.id">
                    <div class="mt-2">
                        <div class="w-full border rounded-md px-4 py-2 hidden lg:flex justify-between items-center flex-wrap">
                            <div class="flex gap-4 justify-center items-center">
                            <div class="w-20 h-20 rounded-full border-red-500 border hidden lg:block"></div>
                                    <div>
                                        <p class="text-base md:text-lg font-semibold leading-4" x-text="student.full_name"></p>
                                        <p class="italic text-zinc-300 font-semibold text-xs md:text-sm">Lorwem</p>
                                    </div>
                                </div>
                                <p class="text-lg font-semibold" x-text="student.class_name + '(' + student.class_arm + ')'"></p>
                                <div x-data="{ open: false}" class="hidden lg:flex flex-col lg:flex-row gap-4">
                                    <button x-on:click="open = ! open" class="px-3 py-2 text-xs bg-blue-400 font-semibold text-neutral-100 rounded-md">Mark Attendance</button>
                                    <button class="px-3 py-2 text-xs bg-blue-400 font-semibold text-neutral-100 rounded-md">View Details</button>
                                    <button class="px-3 py-2 text-xs bg-blue-400 font-semibold text-neutral-100 rounded-md">Assign Scores</button>

                                    <div x-show="open" x-transition.opacity.duration.300ms class="bg-zinc-100/40 fixed z-10 h-screen top-0 left-0 w-full flex justify-center items-center backdrop-blur-sm p-5">
                                        <div x-transition.opacity.scale.duration.350ms class="bg-white/40 w-11/12 lg:w-2/5 flex justify-center items-center p-5 rounded-4xl backdrop-blur-md border-zinc-100 border shadow-lg">
                                            <div class="flex flex-col items-center w-full rounded-3xl p-2 md:p-5 bg-neutral-50 border border-neutral-100">
                                                <form method="POST" action="includes/markAttendance.php">
                                                    <?= $term ?>
                                                    <input type="hidden" name="student_id" :value="selectedStudentId">
                                                    <input hidden name="term_id" value="<?= $term ?>" />
                                                    <div class="flex w-full gap">
                                                        <button type="submit" name="status" value="present" class="p-3 font-semibold text-neutral-900 bg-green-500">Present</button>
                                                        <button type="submit" name="status" value="absent" class="p-3 font-semibold text-neutral-900 bg-red-500">Absent</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Mobile view -->
                            <div class="w-full border rounded-md px-4 py-2 flex lg:hidden flex-col gap-4">
                                <div class="flex gap-4 justify-between items-center">
                                    <div>
                                        <p class="text-base md:text-lg font-semibold leading-5" x-text="student.full_name"></p>
                                        <p class="italic text-zinc-300 font-semibold text-xs md:text-sm mt-1">Lorwem</p>
                                    </div>
                                    <p class="text-sm md:text-lg font-semibold" x-text="student.class_name + '(' + student.class_arm + ')'"></p>
                                </div>
                                <div class="w-full flex lg:hidden gap-2 lg:gap-0">
                                    <button class=" w-full p-2 text-xs bg-blue-400 font-semibold text-neutral-100 rounded-md">View Details</button>
                                    <button class="w-full p-2 text-xs bg-blue-400 font-semibold text-neutral-100 rounded-md">Assign Scores</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </template>
        <template x-if="students.length === 0 && selectedClass">
            <p class="text-gray-500 italic text-lg text-center mt-5">No students found for this class.</p>
        </template>

        <template x-if="!selectedClass">
            <p class="text-gray-400 italic text-lg text-center mt-5">Select a class to view students</p>
        </template>
    </section>
</main>