<?php
    // session_start();
    define('APP_ROOT', __DIR__);
    include 'includes/dbh.inc.php';
    include 'components/icons.php';
    include 'components/logoutDialogue.php';

    $BASE_PATH = '/schoolManagementSystem';
    $id = $_SESSION['user_id'];
    $firstname = $_SESSION['firstname'];
    $surname = $_SESSION['surname'];
    $role = $_SESSION['role'];

    $navItems = [
        [
            'id' => 'dashboard',
            'label' => 'Dashboard',
            'icon' => 'dashboard'
        ],
        [
            'id' => 'assignment',
            'label' => 'Assignment',
            'icon' => 'assignment'
        ],
        [
            'id' => 'result',
            'label' => 'Result Profile',
            'icon' => 'result'
        ],
        [
            'id' => 'profile',
            'label' => 'Student Profile',
            'icon' => 'person'
        ]
    ];

    $currentView = htmlspecialchars($_GET['view'] ?? 'dashboard', ENT_QUOTES);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="/assets/js/results.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- <?php if ($currentView === 'result') : ?>
        <script defer src="../assets/js/results.js"></script>
    <?php endif; ?> -->
    <link rel="stylesheet" href="assets/css/style.css"/>
    <title>SchoolY - <?= $surname ?>&nbsp;<?= $firstname ?></title>
</head>
<body>
    <div 
        class="w-full h-screen flex" 
        x-data="{
            basePath: '<?= $BASE_PATH ?>',
            currentView: '<?= $currentView ?>',
            isLoading: false,
            content: '',
            
            // Function to change views
            navigate(view) {
                if (this.currentView === view) return;

                this.currentView = view;
                this.isLoading = true;

                history.pushState({}, '', this.basePath + '/' + view);
                this.loadContent(view);
            },
         
            // Function to load content via AJAX
            async loadContent(view) {
                try {
                    const response = await fetch(this.basePath + '/app/view-router.php?view=' + view);
                    this.content = await response.text();
                } catch (error) {
                    this.content = '<div>Error loading content</div>';
                }
                this.isLoading = false;
            },
         
         // Initialize
        init() {
            // Load initial content
            this.loadContent('<?= $currentView ?>');
             
            // Handle browser back/forward buttons
            window.addEventListener('popstate', () => {
                const path = window.location.pathname
                            .replace(this.basePath, '')
                            .replace('/', '') || 'dashboard';
                this.currentView = path;
                this.loadContent(path);
            });
        }
    }"
    x-init="init()"
    >
        <!-- Sidebar -->
        <div class="w-full lg:w-1/5 absolute lg:relative z-10 bottom-3 lg:bottom-0 rounded-full lg:rounded-none lg:rounded-r-md lg:h-full px-6 py-2 lg:p-4 flex flex-col justify-between border border-purple-300 lg:border-neutral-200/70 bg-purple-500 lg:bg-white">
            <div>
                <h1 class="hidden lg:block font-semibold text-2xl text-center">SchoolY</h1>
                <nav class="flex flex-row justify-between lg:justify-normal lg:flex-col lg:mt-7">
                    <?php foreach($navItems as $item): ?>
                    <div 
                        @click="navigate('<?= $item['id'] ?>')"
                        :class="currentView === '<?= $item['id'] ?>' ? 
                               'bg-neutral-200 lg:bg-purple-500 text-white border-neutral-200/65 lg:border-purple-500' : 
                               'text-neutral-400 hover:bg-gray-100 border-transparent'"
                        class="w-12 h-12 lg:w-full lg:p-3 flex gap-4 items-center justify-center lg:justify-normal rounded-full lg:rounded-lg font-semibold transition-all border cursor-pointer"
                    >
                        <div :class="currentView === '<?= $item['id'] ?>' ? 'text-neutral-800 lg:text-neutral-100' : 'text-neutral-800 lg:text-neutral-400'">
                            <?php renderIcon($item['icon'], 'w-5 h-5') ?>
                        </div>
                        <p class="lg:block hidden" :class="currentView === '<?= $item['id'] ?>' ? 'text-neutral-100' : 'text-neutral-400'">
                            <?= htmlspecialchars($item['label']) ?>
                        </p>
                    </div>
                    <?php endforeach; ?>
                </nav>
            </div>
            <div class="w-full border border-zinc-200 hidden lg:flex gap-1 items-center justify-center rounded-lg font-semibold neon-hover cursor-pointer">
                <?php renderIcon('logout', 'w-6 h-6 text-neutral-800') ?>
                <?php renderLogoutDialogue("w-full", "Log Out", "font-semibold text-lg py-4 w-full border", '', 'w-full h-fit flex text-neutral-800 py-3') ?>
            </div>
        </div>
        <div class="bg-neutral-100 w-full lg:w-4/5 rounded-r-md h-full overflow-auto">
            <div x-show="isLoading" class="h-full flex items-center justify-center">
                <div class="text-center">
                    <div class="inline-block animate-spin rounded-full h-8 w-8 border-t-2 border-b-2 border-purple-500"></div>
                    <p class="mt-2 text-gray-600">Loading...</p>
                </div>
            </div>
            
            <!-- Content -->
            <div x-show="!isLoading" x-html="content" class="w-full px-1 pb-18 lg:p-4"></div>
        </div>
    </div>

    <script>
        
    </script>
</body>
</html>