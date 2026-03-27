<?php
$school_name = $_SESSION['school_name'];
$school_slug = $_SESSION['school_slug'];
$school_address = $_SESSION['school_address'];
$school_phone = $_SESSION['school_phone'];
$school_email = $_SESSION['school_email'];
$school_initials = strtoupper(substr($school_name, 0, 2));
?>

<div class="space-y-10">
  <section class="flex flex-col md:flex-row gap-4">
    <div class="bg-white border border-zinc-200/60 rounded-2xl p-6 flex-1">
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
            ) ?> · Est . <?= $school_name ?></p> <!-- year founded -->
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

    <div class="bg-white border border-zinc-200/60 rounded-2xl p-6 shadow-sm md:w-80">
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

  <div class="col-span-12 lg:col-span-8 space-y-6">
    <div class="relative overflow-hidden bg-white border border-zinc-200/60 rounded-2xl p-8 shadow-sm group">
      <div class="flex items-center gap-2 mb-5">
        <?php renderIcon('sparkles', 'w-6 h-6 text-blue-700'); ?>
        <h3 class="text-base font-bold text-gray-900">Institutional Mission</h3>
      </div>
      <p class="text-xl font-semibold text-gray-800 leading-snug italic mb-8" style="font-family:'Work Sans',sans-serif;"> "To cultivate intellectual curiosity and architectural precision in everystudent, preparing them for the complexities of a dynamic global landscapethrough interdisciplinary mastery."</p>
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

 <div x-data="{
  open: null,
  session: '2024/2025',
  term: 'First Term',
  schedule: 'Mid-Term Break',
  sessions: ['2023/2024', '2024/2025', '2025/2026'],
  terms: ['First Term', 'Second Term', 'Third Term'],
  schedules: ['In Session', 'Holiday', 'Mid-Term Break'],
  toggle(name) { this.open = this.open === name ? null : name }
}" class="relative">

  <div class="flex items-end justify-between mb-4 px-1">
    <h3 class="text-lg font-bold text-gray-900">Operational Parameters</h3>
    <a href="#" class="text-blue-700 font-semibold text-sm hover:underline">Manage All</a>
  </div>

  <div class="grid grid-cols-2 md:grid-cols-4 gap-3">

    <!-- Academic Term & Session -->
    <div class="bg-white border border-zinc-200/70 rounded-xl p-5 hover:shadow-sm transition-shadow flex flex-col relative">
      <div class="w-9 h-9 rounded-lg bg-blue-50 flex items-center justify-center text-blue-700 mb-4">
        <?php renderIcon('graduateCap', 'w-4 h-4'); ?>
      </div>
      <h4 class="text-sm font-bold text-gray-900 uppercase tracking-wide mb-2">Academic Term &amp; Session</h4>
      <p class="text-xs text-gray-400 leading-relaxed mb-2">Management of semester schedules, grading periods, and enrollment cycles.</p>
      <div class="mb-3">
        <p class="text-gray-400 font-semibold text-xs">Session: <span class="text-blue-700 font-semibold" x-text="session"></span></p>
        <p class="text-gray-400 font-semibold text-xs">Term: <span class="text-blue-700 font-semibold" x-text="term"></span></p>
      </div>
      <button
        @click="toggle('term')"
        class="w-full mt-auto py-2 border border-zinc-200 hover:border-zinc-300 hover:shadow-sm transition-all duration-300 text-blue-700 font-semibold rounded-xl flex justify-center items-center text-sm"
      >
        Change session&nbsp;
        <span><?php renderIcon('sync', 'w-3.5 h-3.5 text-blue-700'); ?></span>
      </button>

      <!-- Term & Session Popover -->
      <div
        x-show="open === 'term'"
        x-transition:enter="transition ease-out duration-150"
        x-transition:enter-start="opacity-0 scale-95 -translate-y-1"
        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
        x-transition:leave="transition ease-in duration-100"
        x-transition:leave-start="opacity-100 scale-100 translate-y-0"
        x-transition:leave-end="opacity-0 scale-95 -translate-y-1"
        @click.outside="open = null"
        class="absolute bottom-[calc(100%+8px)] left-0 right-0 z-50 bg-white border border-zinc-200 rounded-2xl shadow-xl p-4 space-y-3"
        style="display:none"
      >
        <div class="flex items-center justify-between mb-1">
          <p class="text-xs font-bold text-gray-700 uppercase tracking-wide">Set Term &amp; Session</p>
          <button @click="open = null" class="text-gray-400 hover:text-gray-600">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
          </button>
        </div>

        <div>
          <label class="text-[10px] text-gray-400 uppercase tracking-widest font-semibold mb-1 block">Academic Session</label>
          <div class="relative">
            <select x-model="session" class="w-full appearance-none border border-zinc-200 rounded-xl px-3 py-2 text-sm font-semibold text-gray-800 bg-zinc-50 focus:outline-none focus:ring-2 focus:ring-blue-100 focus:border-blue-400 pr-8 cursor-pointer">
              <template x-for="s in sessions" :key="s">
                <option :value="s" x-text="s"></option>
              </template>
            </select>
            <svg class="w-4 h-4 text-gray-400 absolute right-2.5 top-1/2 -translate-y-1/2 pointer-events-none" fill="none" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" fill="currentColor"/></svg>
          </div>
        </div>

        <div>
          <label class="text-[10px] text-gray-400 uppercase tracking-widest font-semibold mb-1 block">Current Term</label>
          <div class="relative">
            <select x-model="term" class="w-full appearance-none border border-zinc-200 rounded-xl px-3 py-2 text-sm font-semibold text-gray-800 bg-zinc-50 focus:outline-none focus:ring-2 focus:ring-blue-100 focus:border-blue-400 pr-8 cursor-pointer">
              <template x-for="t in terms" :key="t">
                <option :value="t" x-text="t"></option>
              </template>
            </select>
            <svg class="w-4 h-4 text-gray-400 absolute right-2.5 top-1/2 -translate-y-1/2 pointer-events-none" fill="none" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" fill="currentColor"/></svg>
          </div>
        </div>

        <button @click="open = null" class="w-full py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm rounded-xl transition-colors">
          Save Changes
        </button>
      </div>
    </div>

    <!-- Holiday Schedule -->
    <div class="bg-white border border-zinc-200/70 rounded-xl p-5 hover:shadow-sm transition-shadow flex flex-col relative">
      <div class="w-9 h-9 rounded-lg bg-blue-50 flex items-center justify-center text-blue-700 mb-4">
        <?php renderIcon('umbrella', 'w-4 h-4'); ?>
      </div>
      <h4 class="text-sm font-bold text-gray-900 uppercase tracking-wide mb-2">Holiday Schedule</h4>
      <p class="text-xs text-gray-400 leading-relaxed">Observance of regional breaks, institutional holidays, and faculty recesses.</p>
      <div class="mb-3 mt-2">
        <p class="text-gray-400 font-semibold text-xs">Schedule: <span class="text-blue-700 font-semibold" x-text="schedule"></span></p>
      </div>
      <button
        @click="toggle('schedule')"
        class="w-full mt-auto py-2 border border-zinc-200 hover:border-zinc-300 hover:shadow-sm transition-all duration-300 text-blue-700 font-semibold rounded-xl flex justify-center items-center text-sm"
      >
        Change Term Schedule&nbsp;
        <span><?php renderIcon('sync', 'w-3.5 h-3.5 text-blue-700'); ?></span>
      </button>

      <!-- Schedule Popover -->
      <div
        x-show="open === 'schedule'"
        x-transition:enter="transition ease-out duration-150"
        x-transition:enter-start="opacity-0 scale-95 -translate-y-1"
        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
        x-transition:leave="transition ease-in duration-100"
        x-transition:leave-start="opacity-100 scale-100 translate-y-0"
        x-transition:leave-end="opacity-0 scale-95 -translate-y-1"
        @click.outside="open = null"
        class="absolute bottom-[calc(100%+8px)] left-0 right-0 z-50 bg-white border border-zinc-200 rounded-2xl shadow-xl p-4 space-y-3"
        style="display:none"
      >
        <div class="flex items-center justify-between mb-1">
          <p class="text-xs font-bold text-gray-700 uppercase tracking-wide">Set Schedule Status</p>
          <button @click="open = null" class="text-gray-400 hover:text-gray-600">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
          </button>
        </div>

        <div class="space-y-1.5">
          <template x-for="s in schedules" :key="s">
            <button
              @click="schedule = s; open = null"
              :class="schedule === s ? 'border-blue-400 bg-blue-50 text-blue-700' : 'border-zinc-200 bg-zinc-50 text-gray-700 hover:border-zinc-300'"
              class="w-full flex items-center justify-between px-3 py-2.5 border rounded-xl text-sm font-semibold transition-all"
            >
              <span x-text="s"></span>
              <svg x-show="schedule === s" class="w-4 h-4 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
            </button>
          </template>
        </div>
      </div>
    </div>

    <!-- Global Events & Policies -->
    <div class="bg-white border border-zinc-200/70 rounded-xl p-5 hover:shadow-sm transition-shadow cursor-pointer">
      <div class="w-9 h-9 rounded-lg bg-blue-50 flex items-center justify-center text-blue-700 mb-4">
        <?php renderIcon('settings', 'w-4 h-4'); ?>
      </div>
      <h4 class="text-sm font-bold text-gray-900 uppercase tracking-wide mb-2">Global Events &amp; Policies</h4>
      <p class="text-xs text-gray-400 leading-relaxed">Compliance guidelines and event management for international exchanges.</p>
    </div>

    <!-- Administrative Support -->
    <div class="bg-white border border-zinc-200/70 rounded-xl p-5 hover:shadow-sm transition-shadow cursor-pointer">
      <div class="w-9 h-9 rounded-lg bg-blue-50 flex items-center justify-center text-blue-700 mb-4">
        <?php renderIcon('headphone', 'w-4 h-4'); ?>
      </div>
      <h4 class="text-sm font-bold text-gray-900 uppercase tracking-wide mb-2">Administrative Support</h4>
      <p class="text-xs text-gray-400 leading-relaxed">Direct channels for faculty assistance, IT resources, and infrastructure aid.</p>
    </div>

  </div>
</div>
</div>