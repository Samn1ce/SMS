<?php
$school_id = (int) $_SESSION['school_id'];
$admin_id = (int) $_SESSION['id'];
$school_name = $_SESSION['school_name'];
$school_slug = $_SESSION['school_slug'];
$school_address = $_SESSION['school_address'];
$school_phone = $_SESSION['school_phone'];
$school_email = $_SESSION['school_email'];
$school_initials = strtoupper(substr($school_name, 0, 2));

// all terms — static lookup, same for every school
$result = mysqli_query($conn, 'SELECT * FROM terms ORDER BY id ASC');
$all_terms = mysqli_fetch_all($result, MYSQLI_ASSOC);

// sessions for this school
$stmt = mysqli_prepare($conn, 'SELECT * FROM sessions WHERE school_id = ? ORDER BY id DESC');
mysqli_stmt_bind_param($stmt, 'i', $school_id);
mysqli_stmt_execute($stmt);
$all_sessions = mysqli_fetch_all(mysqli_stmt_get_result($stmt), MYSQLI_ASSOC);

// current active setting for this school
$stmt = mysqli_prepare(
  $conn,
  "
    SELECT sts.*, t.term_name, s.session_name
    FROM school_term_settings sts
    JOIN terms t ON t.id = sts.term_id
    JOIN sessions s ON s.id = sts.session_id
    WHERE sts.school_id = ?
",
);
mysqli_stmt_bind_param($stmt, 'i', $school_id);
mysqli_stmt_execute($stmt);
$active_setting = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

$display_term = $active_setting['term_name'] ?? 'Not set';
$display_session = $active_setting['session_name'] ?? 'Not set';
$current_term_id = (int) ($active_setting['term_id'] ?? 0);
$current_session_id = (int) ($active_setting['session_id'] ?? 0);
?>

<div class="space-y-10">

  <!-- ── School Info + Registry ── -->
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
            <p class="text-sm text-neutral-400"><?= htmlspecialchars($school_address) ?></p>
          </div>
        </div>
        <div class="mt-1 inline-flex items-center gap-1 text-[10px] font-bold px-2 py-0.5 rounded-full bg-green-100 text-green-700 uppercase tracking-wide">
          <span class="w-1.5 h-1.5 rounded-full bg-green-500 inline-block"></span> Active
        </div>
      </div>
      <hr class="my-4 border-zinc-100">
      <div class="flex gap-8 flex-wrap text-sm">
        <div>
          <p class="text-xs text-neutral-400 uppercase tracking-wide mb-1">Code</p>
          <span class="font-medium"><?= htmlspecialchars($school_slug) ?></span>
        </div>
        <div>
          <p class="text-xs text-neutral-400 uppercase tracking-wide mb-1">Email</p>
          <span class="font-medium"><?= htmlspecialchars($school_email) ?></span>
        </div>
        <div>
          <p class="text-xs text-neutral-400 uppercase tracking-wide mb-1">Phone</p>
          <span class="font-medium"><?= htmlspecialchars($school_phone) ?></span>
        </div>
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
    </div>
  </section>

  <!-- ── Institutional Mission ── -->
  <div class="relative overflow-hidden bg-white border border-zinc-200/60 rounded-2xl p-8 shadow-sm">
    <div class="flex items-center gap-2 mb-5">
      <?php renderIcon('sparkles', 'w-6 h-6 text-blue-700'); ?>
      <h3 class="text-base font-bold text-gray-900">Institutional Mission</h3>
    </div>
    <p class="text-xl font-semibold text-gray-800 leading-snug italic mb-8" style="font-family:'Work Sans',sans-serif;">
      "To cultivate intellectual curiosity and architectural precision in every student, preparing them for the complexities of a dynamic global landscape through interdisciplinary mastery."
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

  <!-- ── Operational Parameters ── -->
  <div>
    <div class="flex items-end justify-between mb-4 px-1">
      <h3 class="text-lg font-bold text-gray-900">Operational Parameters</h3>
      <a href="#" class="text-blue-700 font-semibold text-sm hover:underline">Manage All</a>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-3">

      <!-- ── Academic Term & Session ── -->
      <div 
        x-data='schoolSetting({
          sessions: <?= json_encode(array_values($all_sessions), JSON_HEX_APOS | JSON_HEX_QUOT) ?>,
          terms: <?= json_encode(array_values($all_terms), JSON_HEX_APOS | JSON_HEX_QUOT) ?>,
          selectedSessionId: <?= (int) $current_session_id ?>,
          selectedTermId: <?= (int) $current_term_id ?>,
          displaySession: <?= json_encode($display_session, JSON_HEX_APOS | JSON_HEX_QUOT) ?>,
          displayTerm: <?= json_encode($display_term, JSON_HEX_APOS | JSON_HEX_QUOT) ?>
        })'
        class="bg-white border border-zinc-200/70 rounded-xl p-5 hover:shadow-sm transition-shadow flex flex-col relative"
      >
        <div class="w-9 h-9 rounded-lg bg-blue-50 flex items-center justify-center text-blue-700 mb-4">
          <?php renderIcon('graduateCap', 'w-4 h-4'); ?>
        </div>
        <h4 class="text-sm font-bold text-gray-900 uppercase tracking-wide mb-2">Academic Term &amp; Session</h4>
        <p class="text-xs text-gray-400 leading-relaxed mb-2">Management of semester schedules, grading periods, and enrollment cycles.</p>

        <div class="mb-3">
          <p class="text-gray-400 font-semibold text-xs">Session: <span class="text-blue-700 font-semibold" x-text="displaySession"></span></p>
          <p class="text-gray-400 font-semibold text-xs">Term: <span class="text-blue-700 font-semibold" x-text="displayTerm"></span></p>
        </div>

        <button @click="termOpen = true"
          class="w-full mt-auto py-2 border border-zinc-200 hover:border-zinc-300 hover:shadow-sm transition-all text-blue-700 font-semibold rounded-xl flex justify-center items-center gap-1 text-sm">
          Change <?php renderIcon('sync', 'w-3.5 h-3.5 text-blue-700'); ?>
        </button>

        <!-- popover -->
        <div x-show="termOpen" x-transition @click.outside="termOpen = false; confirmOpen = false"
          class="absolute bottom-[calc(100%+8px)] left-0 right-0 z-50 bg-white border border-zinc-200 rounded-2xl shadow-xl p-4 space-y-3"
          style="display:none">

          <div class="flex items-center justify-between">
            <p class="text-xs font-bold text-gray-700 uppercase tracking-wide">Set Term &amp; Session</p>
            <button @click="termOpen = false; confirmOpen = false" class="text-gray-400 hover:text-gray-600">
              <?php renderIcon('cancel', 'w-4 h-4'); ?>
            </button>
          </div>

          <!-- session select -->
          <div>
            <label class="text-[10px] text-gray-400 uppercase tracking-widest font-semibold mb-1 block">Academic Session</label>
            <div class="relative">
              <select x-model="selectedSessionId"
                class="w-full appearance-none border border-zinc-200 rounded-xl px-3 py-2 text-sm font-semibold text-gray-800 bg-zinc-50 focus:outline-none focus:ring-2 focus:ring-blue-100 focus:border-blue-400 pr-8 cursor-pointer">
                <option value="0" disabled>Select session</option>
                <template x-for="s in sessions" :key="s.id">
                  <option :value="s.id" x-text="s.session_name"></option>
                </template>
              </select>
              <svg class="w-4 h-4 text-gray-400 absolute right-2.5 top-1/2 -translate-y-1/2 pointer-events-none" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
              </svg>
            </div>
          </div>

          <!-- add new session -->
          <div>
            <label class="text-[10px] text-gray-400 uppercase tracking-widest font-semibold mb-1 block">Add New Session</label>
            <div class="flex gap-2">
              <input
                x-model="newSessionName"
                @input="newSessionName = newSessionName.replace(/[^\d\/]/g, '').slice(0, 9)"
                @keydown.enter="createSession()"
                placeholder="e.g. 2026/2027"
                maxlength="9"
                class="flex-1 border border-zinc-200 rounded-xl px-3 py-2 text-sm font-semibold text-gray-800 bg-zinc-50 focus:outline-none focus:ring-2 focus:ring-blue-100 focus:border-blue-400"
              />
              <button @click="createSession()" :disabled="newSessionLoading"
                class="px-3 py-2 bg-zinc-100 hover:bg-zinc-200 text-gray-700 font-semibold text-sm rounded-xl transition-colors disabled:opacity-50">
                <span x-show="!newSessionLoading">Add</span>
                <span x-show="newSessionLoading" style="display:none">…</span>
              </button>
            </div>
            <p x-show="newSessionError" x-text="newSessionError" class="text-xs text-red-500 mt-1" style="display:none"></p>
          </div>

          <!-- term select -->
          <div>
            <label class="text-[10px] text-gray-400 uppercase tracking-widest font-semibold mb-1 block">Current Term</label>
            <div class="relative">
              <select x-model="selectedTermId"
                class="w-full appearance-none border border-zinc-200 rounded-xl px-3 py-2 text-sm font-semibold text-gray-800 bg-zinc-50 focus:outline-none focus:ring-2 focus:ring-blue-100 focus:border-blue-400 pr-8 cursor-pointer">
                <option value="0" disabled>Select term</option>
                <template x-for="t in terms" :key="t.id">
                  <option :value="t.id" x-text="t.term_name"></option>
                </template>
              </select>
              <svg class="w-4 h-4 text-gray-400 absolute right-2.5 top-1/2 -translate-y-1/2 pointer-events-none" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
              </svg>
            </div>
          </div>

          <p x-show="saveError" x-text="saveError" class="text-xs text-red-500" style="display:none"></p>

          <!-- save button -->
          <div x-show="!confirmOpen">
            <button @click="openConfirm()"
              class="w-full py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm rounded-xl transition-colors">
              Save Changes
            </button>
          </div>

          <!-- confirm step -->
          <div x-show="confirmOpen" class="space-y-2" style="display:none">
            <p class="text-xs text-gray-500 text-center">This updates the active term and session for your school. Continue?</p>
            <div class="flex gap-2">
              <button @click="confirmOpen = false"
                class="flex-1 py-2 border border-zinc-200 text-gray-600 font-semibold text-sm rounded-xl hover:bg-zinc-50 transition-colors">
                Cancel
              </button>
              <button @click="saveSettings()" :disabled="saving"
                class="flex-1 py-2 bg-blue-600 hover:bg-blue-700 disabled:opacity-60 text-white font-semibold text-sm rounded-xl transition-colors">
                <span x-show="!saving">Confirm</span>
                <span x-show="saving" style="display:none">Saving…</span>
              </button>
            </div>
          </div>

        </div>
      </div>

      <!-- Holiday Schedule -->
      <div class="bg-white border border-zinc-200/70 rounded-xl p-5 hover:shadow-sm transition-shadow flex flex-col">
        <div class="w-9 h-9 rounded-lg bg-blue-50 flex items-center justify-center text-blue-700 mb-4">
          <?php renderIcon('umbrella', 'w-4 h-4'); ?>
        </div>
        <h4 class="text-sm font-bold text-gray-900 uppercase tracking-wide mb-2">Holiday Schedule</h4>
        <p class="text-xs text-gray-400 leading-relaxed">Observance of regional breaks, institutional holidays, and faculty recesses.</p>
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