<?php 
    session_start();
    include 'includes/dbh.inc.php';
    include 'components/header.php';

    $id = $_SESSION['user_id'];

    $classQuery = "SELECT * FROM classes";
    $classResult = mysqli_query($conn, $classQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script> 
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>View Students</title>
</head>
<body class="bg-neutral-50">
    <?php renderHeader($id) ?>
    <main class="w-full max-w-7xl mx-auto">
            <section 
                x-data="studentManager()"
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
                <template
                    x-if="students.length > 0"
                    class="w-full mt-5"
                >
                    <template x-for="student in students" :key="student.id">
                        <div>
                            <div class="w-full border rounded-md px-4 py-2 hidden lg:flex justify-between items-center flex-wrap">
                                <div class="flex gap-4 justify-center items-center">
                                    <div class="w-20 h-20 rounded-full border-red-500 border hidden lg:block"></div>
                                    <div>
                                        <p class="text-base md:text-lg font-semibold leading-4" x-text="student.full_name"></p>
                                        <p class="italic text-zinc-300 font-semibold text-xs md:text-sm">Lorwem</p>
                                    </div>
                                </div>
                                <p class="text-lg font-semibold" x-text="student.class_name + '(' + student.class_arm + ')'"></p>
                                <div class="hidden lg:flex flex-col lg:flex-row gap-4">
                                    <button class="px-3 py-2 text-xs bg-blue-400 font-semibold text-neutral-100 rounded-md">View Details</button>
                                    <button class="px-3 py-2 text-xs bg-blue-400 font-semibold text-neutral-100 rounded-md">Assign Scores</button>
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
                    </template>
                </template>
                <template x-if="students.length === 0 && selectedClass">
                    <p class="text-gray-500 italic text-lg text-center mt-5">No students found for this class.</p>
                </template>

                <template x-if="!selectedClass">
                    <p class="text-gray-400 italic text-lg text-center mt-5">Select a class to view students</p>
                </template>
        </section>
    </main>
    <script>
        function studentManager() {
            return {
                selectedClass: "",
                search: "",
                students: [],

                async fetchStudents() {
                    if (!this.selectedClass) {
                        this.students = [];
                        return;
                    }

                    const res = await fetch(`includes/getStudents.php?class_id=${this.selectedClass}&search=${encodeURIComponent(this.search)}`);
                    this.students = await res.json();
                },
            }
        }
    </script>
</body>
</html>