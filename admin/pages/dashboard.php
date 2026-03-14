<div class="border-2 border-blue-500">
    <div class="z-10 relative">
        <div class="bg-[#EBE7FF] rounded-3xl p-8 relative border border-zinc-200/60 overflow-hidden flex flex-col justify-center h-[200px]">
        <h2 class="text-4xl font-serif text-[#1F1B3E] font-bold mb-3">Hi, <?= formatName(
          $firstname,
        ) ?></h2>
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