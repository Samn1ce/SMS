<?php
$school_id = $_SESSION['school_id'];

$sql = "SELECT id, surname, firstname, email, gender
         FROM users 
         WHERE school_id = ? AND roles = 'teacher' AND status = 'pending'
         ORDER BY created_at DESC";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, 'i', $school_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$teachers = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!-- Toast -->
<div
    x-data="{ show: false, message: '', type: '' }"
    x-on:teacher-actioned.window="
        message = $event.detail.message;
        type = $event.detail.action;
        show = true;
        setTimeout(() => show = false, 3500)
    "
    x-show="show"
    x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed top-6 right-6 z-50 px-5 py-3 rounded-xl shadow-lg text-sm font-semibold"
    :class="type === 'accept' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'"
    x-text="message"
></div>

<div>
    <h2 class="text-xl font-bold text-gray-800 mb-4">Teacher Requests</h2>
    <div class="px-2 space-y-3">

        <?php if (empty($teachers)): ?>
            <p class="text-sm text-neutral-400 font-semibold px-8 py-6">No pending requests.</p>

        <?php else: ?>
            <?php foreach ($teachers as $teacher): ?>
            <div
                x-data="teacherRow(<?= $teacher['id'] ?>)"
                x-on:teacher-actioned.window="if ($event.detail.id === <?= $teacher[
                  'id'
                ] ?>) $el.remove()"
                class="border border-zinc-200/60 bg-white min-h-20 rounded-xl flex justify-between items-center px-8"
            >
                <div>
                    <h3 class="text-xl font-semibold">
                        <?= htmlspecialchars(formatName($teacher['surname'])) ?>
                        <?= htmlspecialchars(formatName($teacher['firstname'])) ?>
                    </h3>
                    <p class="text-sm text-neutral-400 font-semibold">
                        <?= htmlspecialchars($teacher['email']) ?>
                    </p>
                </div>

                <div>
                    <p class="text-sm text-neutral-400 font-semibold">
                        <?= date('d M Y', strtotime($teacher['gender'])) ?>
                    </p>
                </div>

                <div class="flex gap-4">
                    <template x-if="confirming === null">
                        <div class="flex gap-4">
                            <button
                                x-on:click="handle('accept')"
                                class="text-center px-4 py-1 font-semibold text-sm text-neutral-900 bg-green-400 rounded-full cursor-pointer">
                                Accept
                            </button>
                            <button
                                x-on:click="handle('reject')"
                                class="text-center px-4 py-1 font-semibold text-sm text-neutral-900 bg-red-400 rounded-full cursor-pointer">
                                Reject
                            </button>
                        </div>
                    </template>
                </div>
            </div>
            <?php endforeach; ?>
        <?php endif; ?>

    </div>
</div>