<?php
include '../components/icons.php';
include '../components/logoutDialogue.php';
include '../includes/nameFormat.php';

$id = $_SESSION['id'];
$surname = $_SESSION['surname'];
$firstname = $_SESSION['firstname'];
$arm_id = $_SESSION['arm_id'];
$role = $_SESSION['role'];
$school_name = $_SESSION['school_name'];
$slug = $_SESSION['school_slug'];
$BASE_PATH = '/schoolManagementSystem';

if (!isset($_SESSION['id'])) {
  header('Location: login.php');
  exit();
}

$page = $_GET['page'] ?? 'dashboard';
$allowed = ['dashboard', 'students', 'teachers', 'school', 'profile'];
if (!in_array($page, $allowed)) {
  $page = '404';
}

$navItems = [
  [
    'page' => 'dashboard',
    'label' => 'Dashboard',
    'icon' =>
      '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>',
  ],
  [
    'page' => 'teachers',
    'label' => 'Teacher Request',
    'icon' =>
      '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>',
  ],
  [
    'page' => 'students',
    'label' => 'View Student',
    'icon' =>
      '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>',
  ],
  [
    'page' => 'school',
    'label' => 'School Information',
    'icon' =>
      '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>',
  ],
  [
    'page' => 'profile',
    'label' => 'Profile',
    'icon' =>
      '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>',
  ],
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schooly | Admin</title>
    <script defer src="<?= $BASE_PATH ?>/assets/js/teachersRequest.js"></script>
    <script defer src="<?= $BASE_PATH ?>/assets/js/schoolSettings.js"></script>
    <script defer src="<?= $BASE_PATH ?>/assets/js/noticeBoard.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body>
    <div class="w-full h-screen flex">
        <div class="hidden md:flex h-full w-16 lg:min-w-60 lg:max-w-80 flex-col py-8 px-2 lg:px-6 z-10 items-center lg:items-stretch">
            <div class="flex items-center justify-center lg:justify-start gap-3 mb-10 lg:px-2">
                <div class="w-8 h-8 bg-[#493988] rounded-full flex items-center justify-center text-white font-bold text-lg shrink-0">S</div>
                <span class="hidden lg:inline font-bold text-xl text-gray-900 tracking-tight">SchooLY</span>
            </div>
            <div x-data="noticeBoard()" class="hidden lg:flex items-center justify-between w-full bg-white border border-gray-100 shadow-sm rounded-full py-2 pl-4 pr-2 mb-8 hover:shadow-md transition-shadow">
                <span class="text-sm font-semibold text-gray-700">Create<br>New "Notice"</span>
                <button @click="open = true" class="cursor-pointer w-10 h-10 bg-[#7B61FF] rounded-full flex items-center justify-center text-white shadow-md">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                </button>
            </div>
            <button class="flex lg:hidden w-10 h-10 bg-[#7B61FF] rounded-full items-center justify-center text-white shadow-md mb-8">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            </button>

            <nav class="flex-1 flex flex-col gap-1 lg:space-y-2 w-full">
                <?php foreach ($navItems as $item):

                  $isActive = $page === $item['page'];
                  $classes = $isActive
                    ? 'bg-gray-50 text-gray-900 border-2 border-blue-400/60'
                    : 'text-gray-500 hover:text-gray-900 hover:bg-gray-50';
                  ?>
                <a href="/schoolManagementSystem/s/<?= $slug ?>/admin/<?= $item['page'] ?>"
                   class="flex items-center justify-center lg:justify-start gap-4 px-0 lg:px-4 py-3 rounded-xl font-medium transition-colors <?= $classes ?>">
                    <svg class="w-5 h-5 shrink-0 <?= $isActive ? 'text-gray-500' : '' ?>"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <?= $item['icon'] ?>
                    </svg>
                    <span class="hidden lg:inline"><?= $item['label'] ?></span>
                </a>
                <?php
                endforeach; ?>
            </nav>
        </div>

        <main class="w-full h-full overflow-auto bg-[#FAFAFC] pb-16 md:pb-0">
            <header class="px-4 md:px-6 lg:px-10 py-4 md:py-5 lg:py-6 bg-white">
                <div class="mx-auto max-w-7xl flex justify-between items-center">
                    <div>
                        <h1 class="text-xs md:text-base lg:text-2xl font-bold text-gray-900"><?= htmlspecialchars(
                          $school_name,
                        ) ?></h1>
                        <p
                            class="hidden lg:block text-sm text-gray-400 mt-1"
                            x-data
                            x-text="new Date().toLocaleDateString('en-GB', { weekday: 'long', day: '2-digit', month: 'long', year: 'numeric' })"
                        ></p>
                    </div>
                    <!-- Add Notice Modal -->
                    <div class="flex items-center gap-3 md:gap-4 lg:gap-6">
                        <div x-data="noticeBoard()" class="relative">
                            <button
                                @click="open = true"
                                class="text-gray-400 hover:text-gray-600 transition-colors duration-200">
                                <?= renderIcon('message', 'w-5 h-5') ?>
                            </button>
                            <div
                                x-show="open"
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0"
                                x-transition:enter-end="opacity-100"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100"
                                x-transition:leave-end="opacity-0"
                                @click="closeModal()"
                                class="fixed inset-0 z-40 bg-black/30 backdrop-blur-sm"
                                style="display:none;"
                            >
                            </div>
                            <div
                                x-show="open"
                                x-transition:enter="transition ease-out duration-250"
                                x-transition:enter-start="opacity-0 translate-y-4 scale-95"
                                x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                                x-transition:leave-end="opacity-0 translate-y-4 scale-95"
                                class="fixed inset-0 z-50 flex items-center justify-center p-4"
                                @keydown.escape.window="closeModal()"
                                style="display:none;"
                            >
                                <div
                                    @click.stop
                                    class="bg-white w-full max-w-lg rounded-2xl shadow-xl border border-gray-100 overflow-hidden"
                                >
                                    <div class="px-6 pt-6 pb-4 border-b border-gray-100 flex items-center justify-between">
                                        <div class="flex items-center gap-3">
                                            <div class="w-9 h-9 bg-[#EDE9FF] rounded-xl flex items-center justify-center">
                                                <?php renderIcon(
                                                  'journal',
                                                  'w-5 h-5 text-[#493988]',
                                                ); ?>
                                            </div>
                                            <div>
                                                <h2 class="text-base font-bold text-gray-900 leading-tight">Post to Notice Board</h2>
                                                <p class="text-xs text-gray-400 mt-0.5">Visible to all students & teachers</p>
                                            </div>
                                        </div>
                                        <button
                                            @click="closeModal()"
                                            class="w-8 h-8 rounded-full flex items-center justify-center text-gray-400 hover:text-gray-600 hover:bg-gray-100 transition-colors duration-200">
                                            <?php renderIcon('close', 'w-4 h-4'); ?>
                                        </button>
                                    </div>

                                    <div class="px-6 py-5 space-y-4">
                                        <div class="flex items-center gap-2">
                                            <span class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Priority</span>
                                            <div class="flex gap-2">
                                                <template x-for="level in priorities" :key="level.value">
                                                    <button
                                                        @click="form.priority = level.value"
                                                        :class="form.priority === level.value
                                                            ? level.activeClass
                                                            : 'bg-gray-100 text-gray-500 hover:bg-gray-200'"
                                                        class="px-3 py-1 rounded-full text-xs font-semibold transition-colors duration-150">
                                                        <span x-text="level.label"></span>
                                                    </button>
                                                </template>
                                            </div>
                                        </div>
                                        <div>
                                            <label class="block text-xs font-semibold text-gray-600 mb-1.5">Subject</label>
                                            <input
                                                type="text"
                                                x-model="form.subject"
                                                @input="errors.subject = ''"
                                                placeholder="e.g. School Closure - Public Holiday"
                                                :class="errors.subject ? 'border-red-300 focus:ring-red-200' : 'border-gray-200 focus:ring-[#493988]/20'"
                                                class="w-full px-4 py-2.5 rounded-xl border text-sm text-gray-800 placeholder-gray-400
                                                    focus:outline-none focus:ring-2 transition-all duration-150 bg-gray-50">
                                            <p x-show="errors.subject" x-text="errors.subject" class="text-red-500 text-xs mt-1"></p>
                                        </div>
                                        <div>
                                            <label class="block text-xs font-semibold text-gray-600 mb-1.5">Send To</label>
                                            <div class="flex gap-2">
                                                <template x-for="group in audiences" :key="group.value">
                                                    <button
                                                        @click="toggleAudience(group.value)"
                                                        :class="form.audience.includes(group.value)
                                                            ? 'bg-[#493988] text-white border-[#493988]'
                                                            : 'bg-white text-gray-500 border-gray-200 hover:border-[#493988]/40'"
                                                        class="flex items-center gap-1.5 px-3 py-1.5 rounded-xl border text-xs font-medium transition-all duration-150">
                                                        <span x-text="group.icon"></span>
                                                        <span x-text="group.label"></span>
                                                    </button>
                                                </template>
                                            </div>
                                            <p x-show="errors.audience" x-text="errors.audience" class="text-red-500 text-xs mt-1"></p>
                                        </div>
                                        <div>
                                            <label class="block text-xs font-semibold text-gray-600 mb-1.5">Message</label>
                                            <textarea
                                                x-model="form.message"
                                                @input="errors.message = ''"
                                                rows="4"
                                                placeholder="Write your notice here…"
                                                :class="errors.message ? 'border-red-300 focus:ring-red-200' : 'border-gray-200 focus:ring-[#493988]/20'"
                                                class="w-full px-4 py-2.5 rounded-xl border text-sm text-gray-800 placeholder-gray-400
                                                    focus:outline-none focus:ring-2 transition-all duration-150 bg-gray-50 resize-none"></textarea>
                                            <div class="flex justify-between items-center mt-1">
                                                <p x-show="errors.message" x-text="errors.message" class="text-red-500 text-xs"></p>
                                                <span class="text-xs text-gray-300 ml-auto" x-text="`${form.message.length} / 500`"></span>
                                            </div>
                                        </div>
                                        <div>
                                            <div>
                                                <label class="block text-xs font-semibold text-gray-600 mb-1.5">
                                                    Expires After
                                                    <span class="font-normal text-gray-400 ml-1">— notice hides from the board after this date</span>
                                                </label>

                                                <!-- Quick-pick buttons -->
                                                <div class="flex flex-wrap gap-2 mb-2">
                                                    <template x-for="preset in expiryPresets" :key="preset.label">
                                                        <button
                                                            @click="applyPreset(preset.days)"
                                                            :class="form.expiryPreset === preset.days
                                                                ? 'bg-[#493988] text-white border-[#493988]'
                                                                : 'bg-white text-gray-500 border-gray-200 hover:border-[#493988]/40'"
                                                            class="px-3 py-1.5 rounded-xl border text-xs font-medium transition-all duration-150"
                                                            x-text="preset.label">
                                                        </button>
                                                    </template>
                                                    <!-- Custom toggle -->
                                                    <button
                                                        @click="form.expiryPreset = 'custom'"
                                                        :class="form.expiryPreset === 'custom'
                                                            ? 'bg-[#493988] text-white border-[#493988]'
                                                            : 'bg-white text-gray-500 border-gray-200 hover:border-[#493988]/40'"
                                                        class="px-3 py-1.5 rounded-xl border text-xs font-medium transition-all duration-150">
                                                        📅 Custom
                                                    </button>
                                                </div>

                                                <!-- Custom date input — only shows when Custom is selected -->
                                                <div x-show="form.expiryPreset === 'custom'"
                                                    x-transition:enter="transition ease-out duration-150"
                                                    x-transition:enter-start="opacity-0 -translate-y-1"
                                                    x-transition:enter-end="opacity-100 translate-y-0">
                                                    <input
                                                        type="date"
                                                        x-model="form.expires_at"
                                                        :min="minDate()"
                                                        @change="errors.expires_at = ''"
                                                        :class="errors.expires_at ? 'border-red-300 focus:ring-red-200' : 'border-gray-200 focus:ring-[#493988]/20'"
                                                        class="w-full px-4 py-2.5 rounded-xl border text-sm text-gray-700
                                                            focus:outline-none focus:ring-2 transition-all duration-150 bg-gray-50">
                                                </div>

                                                <!-- Live preview of the chosen date -->
                                                <p x-show="form.expires_at"
                                                class="text-xs text-[#493988] font-medium mt-1.5 flex items-center gap-1">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                    </svg>
                                                    <span x-text="'Expires ' + formatExpiry(form.expires_at)"></span>
                                                </p>

                                                <p x-show="errors.expires_at" x-text="errors.expires_at" class="text-red-500 text-xs mt-1"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="px-6 pb-6 flex items-center justify-between gap-3">
                                        <button
                                            @click="closeModal()"
                                            class="px-4 py-2.5 rounded-xl text-sm font-medium text-gray-500 hover:text-gray-700 hover:bg-gray-100 transition-colors duration-150">
                                            Cancel
                                        </button>
                                        <button
                                            @click="submitNotice()"
                                            :disabled="submitting"
                                            class="flex items-center gap-2 px-5 py-2.5 rounded-xl bg-[#493988] hover:bg-[#3a2d6e]
                                                text-white text-sm font-semibold transition-all duration-150 disabled:opacity-60 disabled:cursor-not-allowed shadow-sm shadow-[#493988]/30">
                                            <svg x-show="submitting" class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24">
                                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"/>
                                            </svg>
                                            <span x-text="submitting ? 'Posting…' : 'Post Notice'"></span>
                                        </button>
                                    </div>
                                    <div
                                        x-show="success"
                                        x-transition:enter="transition ease-out duration-300"
                                        x-transition:enter-start="opacity-0 -translate-y-2"
                                        x-transition:enter-end="opacity-100 translate-y-0"
                                        class="absolute inset-x-0 bottom-0 mx-4 mb-4 bg-emerald-50 border border-emerald-200
                                            text-emerald-700 text-sm font-medium px-4 py-3 rounded-xl flex items-center gap-2"
                                        style="display:none;">
                                        <svg class="w-4 h-4 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                        Notice posted to the board successfully!
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button class="text-gray-400 hover:text-gray-600 relative">
                            <?= renderIcon('bell', 'w-5 h-5') ?>
                            <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full border border-white"></span>
                        </button>
                        <div x-data="{ open: false }" class="relative flex items-center gap-1 md:gap-2 lg:gap-3 ml-2 cursor-pointer">
                            <div
                                x-data="{ surname: '<?= $surname ?>', firstname: '<?= $firstname ?>' }"
                                x-text="(surname[0]) + firstname[0].toUpperCase()"
                                class="w-8 h-8 bg-[#DED6FF] text-[#493988] rounded-md flex items-center justify-center font-bold text-sm">
                            </div>
                            <span class="hidden lg:inline text-sm font-semibold text-gray-700"><?= formatName(
                              $surname,
                            ) ?> <?= formatName($firstname) ?></span>
                            <button class="hover:bg-slate-200 duration-300 rounded-full cursor-pointer p-2" x-on:click="open = !open">
                                <svg class="w-4 h-4 text-gray-400 transition-all duration-300" :class="open ? 'rotate-0' : 'rotate-180'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>

                            <div x-show="open" class="cursor-pointer bg-neutral-100 w-40 right-0 lg:right-auto lg:w-full h-10 rounded-xl absolute top-10 px-4 flex justify-center items-center hover:bg-slate-200 transition-all duration-300 border border-zinc-200/50">
                                <?php renderIcon('logout', 'w-6 h-6 text-neutral-800'); ?>
                                <?php renderLogoutDialogue(
                                  'w-full',
                                  'Logout',
                                  'w-full pl-2 text-left',
                                  '',
                                ); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <div class="px-4 md:px-6 lg:px-10 py-5 md:py-6 lg:py-8 max-w-7xl mx-auto">
                <?php include __DIR__ . "/pages/{$page}.php"; ?>
            </div>
        </main>
    </div>

    <nav class="fixed bottom-0 left-0 right-0 z-50 flex md:hidden bg-white border-t border-gray-100">
        <?php foreach ($navItems as $item):

          $isActive = $page === $item['page'];
          $activeClasses = $isActive ? 'text-[#493988]' : 'text-gray-400';
          ?>
        <a href="/schoolManagementSystem/s/<?= $slug ?>/admin/<?= $item['page'] ?>"
           class="flex-1 flex flex-col items-center justify-center py-2 gap-0.5 <?= $activeClasses ?>">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <?= $item['icon'] ?>
            </svg>
            <span class="text-[9px] font-medium leading-tight text-center"><?= $item[
              'label'
            ] ?></span>
            <?php if ($isActive): ?>
                <span class="w-1 h-1 rounded-full bg-[#493988]"></span>
            <?php endif; ?>
        </a>
        <?php
        endforeach; ?>
    </nav>
</body>
</html>