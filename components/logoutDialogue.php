<?php
function renderLogoutDialogue(
    $containerDivClass,
    $aText, 
    $aClass,
    $pText = '', 
    $pClass = '', 
    $spanText = ''
) {
    echo '
        <div 
            x-data="{ open: false }" 
            x-transition 
            class="'. htmlspecialchars($containerDivClass) .'"
        >
            <p class="'. htmlspecialchars($pClass) .'">'. htmlspecialchars($pText) .'
                <span>
                    <a 
                        x-on:click="open = ! open" 
                        class="'. htmlspecialchars($aClass) .'">'. htmlspecialchars($aText) .'
                    </a>
                        '. htmlspecialchars($spanText) .'
                </span>
            </p>

            <div x-show="open" x-transition.opacity.duration.300ms class="bg-zinc-100/20 fixed h-screen top-0 left-0 w-full flex justify-center items-center backdrop-blur-sm p-5">
                <div x-transition.opacity.scale.duration.350ms class="bg-white/40 w-11/12 lg:w-2/5 flex justify-center items-center p-5 rounded-4xl backdrop-blur-md border-zinc-100 border shadow-lg">
                    <div class="flex flex-col items-center w-full rounded-3xl p-2 md:p-5 bg-neutral-50 border border-neutral-100">
                        <img src="public/LogOut.png" class="w-32 h-32" />
                        <div class="flex flex-col justify-center items-center w-full md:w-10/12">
                            <p class="text-2xl font-semibold mt-3 text-neutral-800">Are You Sure?</p>
                            <div class="flex gap-4 mt-3 w-11/12">
                                <a href="includes/logout.php" class="w-1/2 text-center px-4 py-1 rounded-xl bg-blue-600 hover:bg-blue-400 transition-all duration-300 text-neutral-100 font-semibold">Yes</a>
                                <a x-on:click="open = false" href="#" class="font-semibold w-1/2 border-zinc-400 border-2 px-4 rounded-xl text-center text-neutral-800">No</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    ';
}