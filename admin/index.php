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
            <button class="hidden lg:flex items-center justify-between w-full bg-white border border-gray-100 shadow-sm rounded-full py-2 pl-4 pr-2 mb-8 hover:shadow-md transition-shadow">
                <span class="text-sm font-semibold text-gray-700">Create<br>New Pitch</span>
                <div class="w-10 h-10 bg-[#7B61FF] rounded-full flex items-center justify-center text-white shadow-md">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                </div>
            </button>
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
                    <div class="flex items-center gap-3 md:gap-4 lg:gap-6">
                        <button class="text-gray-400 hover:text-gray-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </button>
                        <button class="text-gray-400 hover:text-gray-600 relative">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
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