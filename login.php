<?php 
    include 'components/icons.php';
    session_start();

    if (isset($_SESSION['id'])) {
        header("Location: ./dashboard.php");
        exit();
    }
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
    <form 
        action="includes/loginFormhandler.inc.php" 
        method="post"
        x-data="{ loading: false }" 
        @submit="loading = true"
    >
        <div class="w-full h-screen border bg-black p-1 lg:p-3 flex items-end justify-end">
            <div class="w-full lg:w-1/2 p-3 bg-zinc-50 h-full rounded-md flex justify-center items-center">
                <div class="w-11/12 lg:w-3/4 flex flex-col gap-8">
                    <div>
                        <h1 class=" text-4xl font-bold">Welcome!</h1>
                        <p class=" text-sm">Lorem ipsum dolor, sit amet consectetur adipisicing elit.</p>
                    </div>
                    <div class="w-full flex flex-col gap-4">
                        <div class="flex items-center h-10 bg-[#441717] pr-5 gap-2 mx-auto rounded-r <?= (isset($_GET['error']) && $_GET['error'] === 'invalidcredentials') ? 'block' : 'hidden' ?>">
                            <div class="w-1 h-full bg-red-600"></div>
                            <?php renderIcon('exclamation', 'text-red-500') ?>
                            <p class="text-red-500 font-semibold text-xs ">Invalid Credentials. Check your crendentials and try again</p>
                        </div>
                        <div class="flex flex-col">
                            <div class="w-full flex gap-2 items-center border-b-2 border-zinc-400 p-3">
                                <?php renderIcon('email', 'w-6 h-6') ?>
                                <input 
                                    type="text" name="email" 
                                    placeholder="Email"
                                    required
                                    class="w-full font-semibold outline-none <?= 
                                        (isset($_GET['error']) && ($_GET['error'] === 'invalidcredentials' || $_GET['error'] === 'emptyfields')) ? 'border-red-500' : 'border-black' 
                                    ?>" 
                                />
                            </div>
                            <?php 
                                if (isset($_GET['error']) && ($_GET['error'] === 'emptyfields')) { echo '
                                    <p class="text-red-500 text-xs self-end">
                                        This field is empty
                                    </p>'; 
                                }
                            ?> 
                        </div>
                            <div class="flex flex-col">
                                <div class="w-full flex gap-2 items-center border-b-2 border-zinc-400 p-3">
                                <select name="role" class="w-full outline-none" required>
                                    <option value="">What's your role?</option>
                                    <option value="student">Student</option>
                                    <option value="teacher">Teacher</option>
                                </select>
                            </div>
                        </div>
                        <div class="flex flex-col">
                            <div class="w-full flex gap-2 items-center border-b-2 border-zinc-400 p-3">
                                <?php renderIcon('password', 'w-6 h-6') ?>
                                <input 
                                    type="password" 
                                    name="pwd" 
                                    placeholder="Password" 
                                    required
                                    class="w-full font-semibold outline-none <?= (isset($_GET['error']) && ($_GET['error'] === 'invalidcredentials' || $_GET['error'] === 'emptyfields')) ? 'border-red-500' : 'border-black' ?>" 
                                />
                            </div>
                            <?php 
                                if (isset($_GET['error']) && ($_GET['error'] === 'emptyfields')) { echo '
                                    <p class="text-red-500 text-xs self-end">
                                        This field is empty
                                    </p>'; 
                                }
                            ?> 
                        </div>
                    </div>
                    <div class="flex flex-col gap-2 justify-end items-end mt-2">
                        <button 
                                :disable="loading"
                                class="bg-black/90 hover:bg-black transition-all duration-300 cursor-pointer w-full text-zinc-50 p-3 font-semibold rounded-full flex justify-center items-center disabled:opacity-60 disabled:cursor-not-allowed"
                            >
                                <span x-show="loading">
                                    <svg class="animate-spin -ml-1 mr-2 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                </span>
                                <span x-show="!loading">
                                    Login
                                </span>
                            </button>
                        <a href="register.php" class="hover:text-red-500 text-blue-400 text-xs border-b border-dotted border-blue-400">I don't have an account</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</body>
</html>