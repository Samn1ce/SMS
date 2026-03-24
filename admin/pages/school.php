<?php
$school_name = $_SESSION['school_name'];
$school_slug = $_SESSION['school_slug'];
$school_address = $_SESSION['school_address'];
$school_phone = $_SESSION['school_phone'];
$school_email = $_SESSION['school_email'];
$school_initials = strtoupper(substr($school_name, 0, 2));
?>

<div class="space-y-10">

<section class="flex flex-col md:flex-row gap-4 items-start border">
    <div class="bg-white border border-zinc-200/60 rounded-2xl p-6 mb-6 flex-1 grow">
        <div class="flex items-start justify-between">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-xl bg-blue-50 flex items-center justify-center font-semibold text-blue-700 text-xl">
                    <?= strtoupper(substr($school_name, 0, 2)) ?>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900"><?= htmlspecialchars(
                      $school_name,
                    ) ?></h3>
                    <p class="text-sm text-neutral-400"><?= htmlspecialchars(
                      $school_address,
                    ) ?> · Est . <?= $school_name ?></p> 
                    <!-- year founded -->
                </div>
            </div>
            <div class="mt-1 inline-flex items-center gap-1 text-[10px] font-bold px-2 py-0.5 rounded-full bg-green-100 text-green-700 uppercase tracking-wide"><span class="w-1.5 h-1.5 rounded-full bg-green-500 inline-block"></span> Active</div>
        </div>
        <hr class="my-4 border-zinc-100">

        <div class="flex gap-8 flex-wrap text-sm">
            <div><p class="text-xs text-neutral-400 uppercase tracking-wide mb-1">Code</p><span class="font-medium"><?= $school_slug ?></span></div>
            <div><p class="text-xs text-neutral-400 uppercase tracking-wide mb-1">Email</p><span class="font-medium"><?= $school_email ?></span></div>
            <div><p class="text-xs text-neutral-400 uppercase tracking-wide mb-1">Phone</p><span class="font-medium"><?= $school_phone ?></span></div>
        </div>
    </div>

    <div class="bg-white border border-zinc-200/70 rounded-2xl p-6 shadow-sm md:w-80">
        <h4 class="text-base font-bold text-gray-900 mb-5 flex items-center gap-2">
          <?php renderIcon('headphone', 'w-5 h-5 text-blue-700'); ?>
          Registry Details
        </h4>

        <div class="space-y-5">
          <div class="flex gap-3 items-start">
            <?php renderIcon('map', 'w-5 h-5 text-gray-400'); ?>
            <div>
              <p class="text-[10px] text-gray-400 uppercase tracking-widest font-semibold mb-0.5">Campus Address</p>
              <p class="text-sm font-semibold text-gray-800"><?= htmlspecialchars(
                $school_address,
              ) ?></p>
            </div>
          </div>
          <div class="flex gap-3 items-start">
             <?php renderIcon('phone', 'w-5 h-5 text-gray-400'); ?>
            <div>
              <p class="text-[10px] text-gray-400 uppercase tracking-widest font-semibold mb-0.5">Main Registry</p>
              <p class="text-sm font-semibold text-gray-800"><?= htmlspecialchars(
                $school_phone,
              ) ?></p>
            </div>
          </div>
          <div class="flex gap-3 items-start">
            <?php renderIcon('email', 'w-5 h-5 text-gray-400'); ?>
            <div>
              <p class="text-[10px] text-gray-400 uppercase tracking-widest font-semibold mb-0.5">Official Email</p>
              <p class="text-sm font-semibold text-gray-800 break-all"><?= htmlspecialchars(
                $school_email,
              ) ?></p>
            </div>
          </div>
        </div>
  </section>

  <!-- ── Main Bento Grid ────────────────────────────────────────────── -->
  <div class="grid grid-cols-12 gap-6">

    <!-- Left column (8/12) -->
    <div class="col-span-12 lg:col-span-8 space-y-6">

      <!-- Mission card -->
      <div class="relative overflow-hidden bg-white border border-zinc-200/70
                  rounded-2xl p-8 shadow-sm group">
        <!-- decorative blob -->
        <div class="absolute top-0 right-0 w-56 h-56 bg-blue-50 rounded-full
                    -translate-y-1/2 translate-x-1/2 blur-3xl
                    group-hover:bg-blue-100 transition-colors pointer-events-none"></div>

        <div class="relative z-10">
          <div class="flex items-center gap-2 mb-5">
            <!-- sparkles -->
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-700" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
              <path d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813
                       a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12
                       l-2.846.813a4.5 4.5 0 00-3.09 3.09z"/>
              <path d="M18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6
                       l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0
                       012.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 00-2.456 2.456z"/>
            </svg>
            <h3 class="text-base font-bold text-gray-900">Institutional Mission</h3>
          </div>

          <p class="text-xl font-semibold text-gray-800 leading-snug italic mb-8"
             style="font-family:'Work Sans',sans-serif;">
            "To cultivate intellectual curiosity and architectural precision in every
            student, preparing them for the complexities of a dynamic global landscape
            through interdisciplinary mastery."
          </p>

          <div class="grid grid-cols-3 gap-4 pt-6 border-t border-zinc-100">
            <div>
              <p class="text-[10px] text-gray-400 uppercase tracking-widest mb-1">Inquiry Rate</p>
              <p class="text-xl font-bold text-blue-700">94%</p>
            </div>
            <div>
              <p class="text-[10px] text-gray-400 uppercase tracking-widest mb-1">Global Partners</p>
              <p class="text-xl font-bold text-blue-700">12 Countries</p>
            </div>
            <div>
              <p class="text-[10px] text-gray-400 uppercase tracking-widest mb-1">Faculty Tenure</p>
              <p class="text-xl font-bold text-blue-700">8.4 Yrs</p>
            </div>
          </div>
        </div>
      </div>

      <!-- ── Operational Parameters (Accordions) ──────────────────── -->
      <div>
        <div class="flex items-end justify-between mb-4 px-1">
          <h3 class="text-lg font-bold text-gray-900">Operational Parameters</h3>
          <a href="#" class="text-blue-700 font-semibold text-sm hover:underline">Manage All</a>
        </div>

        <div x-data="{ open: null }" class="space-y-2">

          <!-- Term & Session -->
          <div class="border border-zinc-200/70 bg-white rounded-xl overflow-hidden">
            <button x-on:click="open = open === 'term' ? null : 'term'"
                    class="w-full flex justify-between items-center px-5 py-4
                           text-sm font-semibold text-gray-800 hover:bg-zinc-50 transition-colors">
              <span class="flex items-center gap-3">
                <span class="w-9 h-9 rounded-lg bg-blue-50 flex items-center justify-center text-blue-700 shrink-0">
                  <!-- academic cap -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-[18px] h-[18px]" viewBox="0 0 24 24" fill="none"
                       stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4.26 10.147a60.44 60.44 0 00-.491 6.347A48.627 48.627 0 0112 20.904
                             a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347
                             m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493
                             a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814
                             m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342"/>
                    <path d="M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675
                             A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0
                             006.75 15.75v-1.5"/>
                  </svg>
                </span>
                Academic Term &amp; Session
              </span>
              <svg :class="open === 'term' ? 'rotate-180' : ''"
                   class="w-4 h-4 text-gray-400 transition-transform" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414
                         1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                      clip-rule="evenodd"/>
              </svg>
            </button>
            <div x-show="open === 'term'" x-collapse
                 class="px-5 pb-5 border-t border-zinc-100">
              <div class="pt-4 grid grid-cols-2 gap-4">
                <div class="bg-zinc-50 rounded-xl p-4">
                  <p class="text-[10px] text-gray-400 uppercase tracking-widest mb-1">Current Term</p>
                  <p class="text-base font-bold text-gray-900">Fall Semester 2024</p>
                  <div class="mt-2 flex items-center gap-2">
                    <span class="px-2 py-0.5 bg-blue-100 text-blue-700 rounded-full text-[10px] font-bold">ACTIVE</span>
                    <span class="text-xs text-gray-400 italic">Ends Dec 18, 2024</span>
                  </div>
                </div>
                <div class="bg-zinc-50 rounded-xl p-4">
                  <p class="text-[10px] text-gray-400 uppercase tracking-widest mb-1">Academic Session</p>
                  <p class="text-base font-bold text-gray-900">2024 – 2025</p>
                  <button class="mt-2 text-xs font-semibold text-blue-700 flex items-center gap-1 hover:underline">
                    Change Session
                    <!-- sync / refresh -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-[14px] h-[14px]" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                      <polyline points="23 4 23 10 17 10"/>
                      <polyline points="1 20 1 14 7 14"/>
                      <path d="M3.51 9a9 9 0 0114.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0020.49 15"/>
                    </svg>
                  </button>
                </div>
              </div>
            </div>
          </div>

          <!-- Holiday Schedule -->
          <div class="border border-zinc-200/70 bg-white rounded-xl overflow-hidden">
            <button x-on:click="open = open === 'holidays' ? null : 'holidays'"
                    class="w-full flex justify-between items-center px-5 py-4
                           text-sm font-semibold text-gray-800 hover:bg-zinc-50 transition-colors">
              <span class="flex items-center gap-3">
                <span class="w-9 h-9 rounded-lg bg-orange-50 flex items-center justify-center text-orange-500 shrink-0">
                  <!-- umbrella / holiday -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-[18px] h-[18px]" viewBox="0 0 24 24" fill="none"
                       stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M23 12a11.05 11.05 0 00-22 0zm-5 7a3 3 0 01-6 0v-7"/>
                  </svg>
                </span>
                Holiday Schedule
              </span>
              <svg :class="open === 'holidays' ? 'rotate-180' : ''"
                   class="w-4 h-4 text-gray-400 transition-transform" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414
                         1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                      clip-rule="evenodd"/>
              </svg>
            </button>
            <div x-show="open === 'holidays'" x-collapse
                 class="px-5 pb-5 border-t border-zinc-100">
              <div class="pt-4 space-y-3">
                <div class="flex items-center justify-between bg-zinc-50 rounded-xl px-4 py-3">
                  <div>
                    <p class="text-sm font-semibold text-gray-900">Autumn Break</p>
                    <p class="text-xs text-gray-400">Oct 14 – Oct 18, 2024</p>
                  </div>
                  <span class="px-2 py-0.5 bg-orange-100 text-orange-600 text-[10px] font-bold rounded-full uppercase">Upcoming</span>
                </div>
                <!-- Add more holiday rows as needed -->
              </div>
            </div>
          </div>

          <!-- Global Events / Policies -->
          <div class="border border-zinc-200/70 bg-white rounded-xl overflow-hidden">
            <button x-on:click="open = open === 'events' ? null : 'events'"
                    class="w-full flex justify-between items-center px-5 py-4
                           text-sm font-semibold text-gray-800 hover:bg-zinc-50 transition-colors">
              <span class="flex items-center gap-3">
                <span class="w-9 h-9 rounded-lg bg-violet-50 flex items-center justify-center text-violet-600 shrink-0">
                  <!-- settings / cog -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-[18px] h-[18px]" viewBox="0 0 24 24" fill="none"
                       stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="3"/>
                    <path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 010 2.83 2 2 0 01-2.83
                             0l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0
                             01-4 0v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2
                             0 01-2.83-2.83l.06-.06A1.65 1.65 0 004.68 15a1.65 1.65 0 00-1.51-1H3
                             a2 2 0 010-4h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06
                             a2 2 0 012.83-2.83l.06.06A1.65 1.65 0 009 4.68a1.65 1.65 0 001-1.51V3
                             a2 2 0 014 0v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06
                             a2 2 0 012.83 2.83l-.06.06A1.65 1.65 0 0019.4 9a1.65 1.65 0 001.51 1
                             H21a2 2 0 010 4h-.09a1.65 1.65 0 00-1.51 1z"/>
                  </svg>
                </span>
                Global Events &amp; Policies
              </span>
              <svg :class="open === 'events' ? 'rotate-180' : ''"
                   class="w-4 h-4 text-gray-400 transition-transform" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd"
                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414
                         1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                      clip-rule="evenodd"/>
              </svg>
            </button>
            <div x-show="open === 'events'" x-collapse
                 class="px-5 pb-5 border-t border-zinc-100">
              <div class="pt-4 flex items-center justify-between bg-zinc-50 rounded-xl px-4 py-3">
                <div>
                  <p class="text-sm font-semibold text-gray-900">12 Active Policies</p>
                  <p class="text-xs text-gray-400">Synced with Parents App</p>
                </div>
                <button class="text-xs font-semibold text-blue-700 flex items-center gap-1 hover:underline">
                  <!-- sliders / tune -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-[14px] h-[14px]" viewBox="0 0 24 24" fill="none"
                       stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="4" y1="21" x2="4" y2="14"/><line x1="4" y1="10" x2="4" y2="3"/>
                    <line x1="12" y1="21" x2="12" y2="12"/><line x1="12" y1="8" x2="12" y2="3"/>
                    <line x1="20" y1="21" x2="20" y2="16"/><line x1="20" y1="12" x2="20" y2="3"/>
                    <line x1="1" y1="14" x2="7" y2="14"/><line x1="9" y1="8" x2="15" y2="8"/>
                    <line x1="17" y1="16" x2="23" y2="16"/>
                  </svg> Manage
                </button>
              </div>
            </div>
          </div>

        </div><!-- /x-data -->
      </div>
    </div>
  </div><!-- /grid -->

</div><!-- /outer wrapper -->