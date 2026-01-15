<?php
include APP_ROOT . '/includes/dbh.inc.php';
include APP_ROOT . '/includes/nameFormat.php';


$id = $_SESSION['id'];
$firstname = $_SESSION['firstname'];
?>

<main class="w-11/12 mx-auto">
    <h2 class="font-semibold text-4xl text-neutral-900"><?= formatName($firstname) ?>'s Attendance Log</h2>
    <div class="mt-8">
        <div class="px-10 bg-neutral-300/80 rounded-xl flex justify-between items-center p-2 mt-4 font-semibold text-neutral-900">
            <p>Date</p>
            <div class="">Day(week)</div>
            <div class="">Status</div>
        </div>
        <div class="flex justify-between items-center p-2 text-sm">
            <div class="flex items-center gap-4">
                <div class="w-2 h-2 bg-neutral-300/90 rounded-full"></div>
                <div class="text-neutral-900 font-semibold">2025-12-09</div>
            </div>
            <div class="text-zinc-400 font-semibold">Week 2</div>
            <div class="text-center px-4 py-1 font-semibold text-sm text-neutral-900 bg-green-400 rounded-full">Present</div>
        </div>
        <hr class="text-zinc-200 mx-5" />
        <div class="flex justify-between items-center p-2 text-sm">
            <div class="flex items-center gap-4">
                <div class="w-2 h-2 bg-neutral-300/90 rounded-full"></div>
                <div class="text-neutral-900 font-semibold">2025-12-09</div>
            </div>
            <div class="text-zinc-400 font-semibold">Week 2</div>
            <div class="text-center px-4 py-1 font-semibold text-sm text-neutral-900 bg-red-400 rounded-full">Absent</div>
        </div>
        <hr class="text-zinc-200 mx-5" />
    </div>
</main>