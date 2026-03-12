<?php
// $id = $_SESSION["id"];
// $surname = $_SESSION['surname'];
// $firstname = $_SESSION['firstname'];
// $arm_id = $_SESSION['arm_id'];
// $role = $_SESSION['role'];

// if (!isset($_SESSION["id"])) {
//     header("Location: login.php");
//     exit();
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pitch.io Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body>

    <div class="w-full h-screen border-2 border-red-500 flex">

        <div class="h-full min-w-60 max-w-80 flex flex-col py-8 px-6 z-10">
            <div class="flex items-center gap-3 mb-10 px-2">
                <div class="w-8 h-8 bg-[#493988] rounded-full flex items-center justify-center text-white font-bold text-lg">S</div>
                <span class="font-bold text-xl text-gray-900 tracking-tight">SchooLY</span>
            </div>

            <button class="flex items-center justify-between w-full bg-white border border-gray-100 shadow-sm rounded-full py-2 pl-4 pr-2 mb-8 hover:shadow-md transition-shadow">
                <span class="text-sm font-semibold text-gray-700">Create<br>New Pitch</span>
                <div class="w-10 h-10 bg-[#7B61FF] rounded-full flex items-center justify-center text-white shadow-md">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                </div>
            </button>

            <nav class="flex-1 space-y-2">
                <a href="#" class="flex items-center gap-4 px-4 py-3 rounded-xl bg-gray-50 text-gray-900 font-medium">
                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    Dashboard
                </a>
                <a href="#" class="flex items-center gap-4 px-4 py-3 text-gray-500 hover:text-gray-900 hover:bg-gray-50 rounded-xl transition-colors font-medium">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    Editor
                </a>
                <a href="#" class="flex items-center gap-4 px-4 py-3 text-gray-500 hover:text-gray-900 hover:bg-gray-50 rounded-xl transition-colors font-medium">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    Leads
                </a>
                <a href="#" class="flex items-center gap-4 px-4 py-3 text-gray-500 hover:text-gray-900 hover:bg-gray-50 rounded-xl transition-colors font-medium">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    Settings
                </a>
                <a href="#" class="flex items-center gap-4 px-4 py-3 text-gray-500 hover:text-gray-900 hover:bg-gray-50 rounded-xl transition-colors font-medium">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Preview
                </a>
            </nav>
        </div>

        <main class="w-full bg-[#FAFAFC]">
            
            <header class="flex justify-between items-center px-10 py-6 bg-white">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Dashboard</h1>
                    <p class="text-sm text-gray-400 mt-1">Monday, 02 March 2020</p>
                </div>
                <div class="flex items-center gap-6">
                    <button class="text-gray-400 hover:text-gray-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </button>
                    <button class="text-gray-400 hover:text-gray-600 relative">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                        <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full border border-white"></span>
                    </button>
                    <div class="flex items-center gap-3 ml-2 cursor-pointer">
                        <div class="w-8 h-8 bg-[#DED6FF] text-[#493988] rounded-md flex items-center justify-center font-bold text-sm">AJ</div>
                        <span class="text-sm font-semibold text-gray-700">Alyssa Jones</span>
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </div>
                </div>
            </header>

            <div class="px-10 pb-10 flex-1">
                <div class="bg-[#EBE7FF] rounded-3xl p-8 mt-6 relative overflow-hidden flex items-center h-[200px]">
                    <div class="z-10 relative">
                        <h2 class="text-4xl font-serif text-[#1F1B3E] font-bold mb-3">Hi, Alyssa</h2>
                        <p class="text-gray-600 text-sm">Ready to start your day with some pitch decks?</p>
                    </div>
                    <div class="absolute right-10 bottom-0 w-64 h-48 flex items-end justify-center">
                        <div class="w-48 h-12 bg-white rounded-lg shadow-sm mb-4 absolute z-0 skew-x-12 border border-purple-100"></div>
                        <div class="w-24 h-24 bg-[#FCD34D] rounded-t-full absolute z-10 -ml-12 border-4 border-[#EBE7FF]"></div>
                        <div class="w-16 h-16 bg-[#1F1B3E] rounded-full absolute top-8 ml-4 z-20"></div>
                        <div class="w-20 h-16 bg-[#493988] rounded-xl absolute z-30 ml-20 shadow-lg border-2 border-white -skew-x-6"></div>
                        <div class="w-2 h-2 bg-[#7B61FF] rounded-full absolute top-10 left-10"></div>
                        <div class="w-3 h-3 border-2 border-[#7B61FF] rounded-full absolute top-20 right-0"></div>
                        <div class="w-1 h-1 bg-gray-400 rounded-full absolute top-8 right-20"></div>
                    </div>
                </div>

                <div class="mt-8">
                    <h3 class="text-gray-400 text-sm font-medium mb-4">Overview</h3>
                    <div class="grid grid-cols-4 gap-4">
                        <div class="bg-[#F8CC5B] rounded-xl p-4 flex items-center gap-4 text-white shadow-sm">
                            <div class="bg-white/20 p-2.5 rounded-lg">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path></svg>
                            </div>
                            <div>
                                <div class="text-2xl font-bold">83%</div>
                                <div class="text-[10px] font-medium opacity-80 uppercase tracking-wide">Open Rate</div>
                            </div>
                        </div>
                        <div class="bg-[#4D4594] rounded-xl p-4 flex items-center gap-4 text-white shadow-sm">
                            <div class="bg-white/10 p-2.5 rounded-lg border border-white/20">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div>
                                <div class="text-2xl font-bold">77%</div>
                                <div class="text-[10px] font-medium opacity-80 uppercase tracking-wide">Complete</div>
                            </div>
                        </div>
                        <div class="bg-[#FA6288] rounded-xl p-4 flex items-center gap-4 text-white shadow-sm">
                            <div class="bg-white/20 p-2.5 rounded-lg">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                            </div>
                            <div>
                                <div class="text-2xl font-bold">91</div>
                                <div class="text-[10px] font-medium opacity-80 uppercase tracking-wide">Unique Views</div>
                            </div>
                        </div>
                        <div class="bg-[#C5BAE7] rounded-xl p-4 flex items-center gap-4 text-white shadow-sm">
                            <div class="bg-white/30 p-2.5 rounded-lg border border-white/40 text-[#493988]">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            </div>
                            <div>
                                <div class="text-2xl font-bold text-[#493988]">126</div>
                                <div class="text-[10px] font-medium text-[#493988] opacity-80 uppercase tracking-wide">Total Views</div>
                            </div>
                        </div>
                    </div>
                </div>               
            </div>

            <div class="px-10 pb-10 flex-1">
                <div class="bg-[#EBE7FF] rounded-3xl p-8 mt-6 relative overflow-hidden flex items-center h-[200px]">
                    <div class="z-10 relative">
                        <h2 class="text-4xl font-serif text-[#1F1B3E] font-bold mb-3">Hi, Alyssa</h2>
                        <p class="text-gray-600 text-sm">Ready to start your day with some pitch decks?</p>
                    </div>
                    <div class="absolute right-10 bottom-0 w-64 h-48 flex items-end justify-center">
                        <div class="w-48 h-12 bg-white rounded-lg shadow-sm mb-4 absolute z-0 skew-x-12 border border-purple-100"></div>
                        <div class="w-24 h-24 bg-[#FCD34D] rounded-t-full absolute z-10 -ml-12 border-4 border-[#EBE7FF]"></div>
                        <div class="w-16 h-16 bg-[#1F1B3E] rounded-full absolute top-8 ml-4 z-20"></div>
                        <div class="w-20 h-16 bg-[#493988] rounded-xl absolute z-30 ml-20 shadow-lg border-2 border-white -skew-x-6"></div>
                        <div class="w-2 h-2 bg-[#7B61FF] rounded-full absolute top-10 left-10"></div>
                        <div class="w-3 h-3 border-2 border-[#7B61FF] rounded-full absolute top-20 right-0"></div>
                        <div class="w-1 h-1 bg-gray-400 rounded-full absolute top-8 right-20"></div>
                    </div>
                </div>

                <div class="mt-8">
                    <h3 class="text-gray-400 text-sm font-medium mb-4">Overview</h3>
                    <div class="grid grid-cols-4 gap-4">
                        <div class="bg-[#F8CC5B] rounded-xl p-4 flex items-center gap-4 text-white shadow-sm">
                            <div class="bg-white/20 p-2.5 rounded-lg">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path></svg>
                            </div>
                            <div>
                                <div class="text-2xl font-bold">83%</div>
                                <div class="text-[10px] font-medium opacity-80 uppercase tracking-wide">Open Rate</div>
                            </div>
                        </div>
                        <div class="bg-[#4D4594] rounded-xl p-4 flex items-center gap-4 text-white shadow-sm">
                            <div class="bg-white/10 p-2.5 rounded-lg border border-white/20">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div>
                                <div class="text-2xl font-bold">77%</div>
                                <div class="text-[10px] font-medium opacity-80 uppercase tracking-wide">Complete</div>
                            </div>
                        </div>
                        <div class="bg-[#FA6288] rounded-xl p-4 flex items-center gap-4 text-white shadow-sm">
                            <div class="bg-white/20 p-2.5 rounded-lg">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                            </div>
                            <div>
                                <div class="text-2xl font-bold">91</div>
                                <div class="text-[10px] font-medium opacity-80 uppercase tracking-wide">Unique Views</div>
                            </div>
                        </div>
                        <div class="bg-[#C5BAE7] rounded-xl p-4 flex items-center gap-4 text-white shadow-sm">
                            <div class="bg-white/30 p-2.5 rounded-lg border border-white/40 text-[#493988]">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            </div>
                            <div>
                                <div class="text-2xl font-bold text-[#493988]">126</div>
                                <div class="text-[10px] font-medium text-[#493988] opacity-80 uppercase tracking-wide">Total Views</div>
                            </div>
                        </div>
                    </div>
                </div>               
            </div>
        </main>
    </div>
</body>
</html>