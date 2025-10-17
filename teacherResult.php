<?php
    include "includes/dbh.inc.php";
    session_start();

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
    <title>Document</title>
</head>
<body>
    <div x-data="studentManager()">
        <select 
            name="class_id" 
            id="class" 
            required 
            class="border p-2 rounded w-60 h-10"
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
        <br/>
        <input 
            type="text" 
            placeholder="Search students..." 
            name="searchQuery" 
            class="w-60 h-10 border" 
            x-model="search"
            :disabled="!selectedClass"
            @input.debounce.500ms="fetchStudents"
        />
        <div>
            <h3 class="font-bold text-lg">Students</h3>
            <template x-if="students.length > 0">
                <ul class="list-disc pl-6 space-y-1">
                    <template x-for="student in students" :key="student.id">
                        <div class="flex items-center justify-between w-80">
                            <li x-text="student.name + ' (' + student.class_name + ')'"></li>
                            <a href="studentProfile.php" class="border border-black px-2 py-1 rounded cursor-pointer hover:bg-gray-100">View Student</a>
                        </div>
                    </template>
                </ul>
            </template>

            <template x-if="students.length === 0 && selectedClass">
                <p class="text-gray-500">No students found for this class.</p>
            </template>

            <template x-if="!selectedClass">
                <p class="text-gray-400 italic">Select a class to view students</p>
            </template>
        </div>
        <form action="" method="POST">

        </form>
    </div>

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

                // get filteredStudents() {
                //     const query = this.search.toLowerCase();
                //     return this.students.filter(s => 
                //         s.studentName.toLowerCase().includes(query)
                //     );
                // }
            }
        }
    </script>
</body>
</html>