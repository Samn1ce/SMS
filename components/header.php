<?php
    function renderHeader($id) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $surname = $_SESSION['surname'] ?? 'Unknown';
        $firstname = $_SESSION['firstname'] ?? 'Unknown';
        $role = $_SESSION['role'] ?? 'Guest';

        echo '
            <header class="w-full border-b">
                <div class="w-full mx-auto max-w-7xl">
                    <div class="mx-auto w-11/12 lg:w-10/12 flex justify-between p-2">
                        <div class="flex justify-center items-center">
                            <img src="public\png-aura.com.png" class="w-10 h-10" />
                            <h1 class="font-bold text-3xl">SCHOOL NAME</h1>
                        </div>
                        <a href="profile.php?id='. urlencode($id) .'" class="hidden md:flex flex-col justify-end items-end cursor-pointer p-2 hover:bg-zinc-300 duration-300 transition-all">
                            <h2 class="font-semibold text-xl">' . htmlspecialchars($surname) . '&nbsp;'. htmlspecialchars($firstname) .'</h2>
                            <p class="text-zinc-400 text-sm -mt-1">' . htmlspecialchars($role) . '</p>
                        </a>
                    </div>
                </div>
            </header>
        ';
    }