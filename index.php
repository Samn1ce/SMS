<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>SchooLY – Smart School Management System</title>
  <script src="assets/js/features.js"></script>
  <script src="assets/js/carousel.js"></script>
  <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/intersect@3.x.x/dist/cdn.min.js"></script>
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>   
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <!-- <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Sora:wght@400;600;700;800&display=swap" 
  rel="stylesheet"/> -->
  <link rel="stylesheet" href="assets/css/style.css" />
</head>
<body x-data>

<nav class="fixed top-0 left-0 right-0 z-50 border-b border-slate-100">
  <div class="max-w-6xl mx-auto px-6 flex items-center justify-between h-16">
    <div class="flex items-center gap-2">
      <div class="w-8 h-8 rounded-lg bg-blue-600 flex items-center justify-center">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
      </div>
      <span class="font-bold text-lg tracking-tight" style="font-family:'Sora',sans-serif;">Schoo<span class="text-blue-600">LY</span></span>
    </div>
    <div class="hidden md:flex items-center gap-7 text-sm font-medium text-slate-600">
      <a href="#" class="hover:text-blue-600 transition-colors">Home</a>
      <a href="#features" class="hover:text-blue-600 transition-colors">Features</a>
      <a href="#security" class="hover:text-blue-600 transition-colors">Security</a>
      <a href="#pricing" class="hover:text-blue-600 transition-colors">Pricing</a>
      <a href="#" class="hover:text-blue-600 transition-colors">Contact</a>
    </div>
    <div class="flex items-center gap-3">
      <a href="register-school-admin.php" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold px-4 py-2 rounded-lg transition-colors shadow-sm">Get Started</a>
    </div>
  </div>
</nav>

<section class="hero-bg pt-28 pb-24 px-6 border-b border-blue-100">
  <div class="hero-dots"></div>
  <div class="max-w-6xl mx-auto relative z-10">
    <div class="text-center mb-14">
      <div class="inline-flex items-center gap-2 bg-blue-50 text-blue-600 border border-blue-200 rounded-full px-4 py-1.5 text-xs font-semibold tracking-widest mb-6 uppercase">
        <span class="w-2 h-2 rounded-full bg-green-400 inline-block animate-pulse"></span>
        Now Live — The Smarter Way to Run Schools
      </div>
      <h1 class="text-4xl md:text-5xl lg:text-[3.6rem] font-bold text-slate-900 leading-tight mb-5 max-w-3xl mx-auto">
        Manage Your School Smarter<br/>and Faster, with <span class="text-blue-600">SchooLY</span>
      </h1>
      <p class="text-slate-500 text-base md:text-lg max-w-xl mx-auto mb-8">The all-in-one school management platform for administrators, teachers, students, and parents — all in one place.</p>
      <div class="flex items-center justify-center gap-3 flex-wrap">
        <input type="email" placeholder="Enter your school email"
          class="bg-white border border-slate-200 text-slate-800 placeholder-slate-400 rounded-xl px-5 py-3 text-sm w-64 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition"/>
        <button class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-6 py-3 rounded-xl text-sm shadow-md transition-colors flex items-center gap-2">
          Get Started Free
          <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </button>
      </div>
      <div class="flex items-center justify-center gap-3 mt-5 flex-wrap">
        <div class="flex -space-x-2">
          <div class="w-7 h-7 rounded-full bg-blue-400 border-2 border-white flex items-center justify-center text-white text-xs font-bold">A</div>
          <div class="w-7 h-7 rounded-full bg-indigo-500 border-2 border-white flex items-center justify-center text-white text-xs font-bold">K</div>
          <div class="w-7 h-7 rounded-full bg-sky-500 border-2 border-white flex items-center justify-center text-white text-xs font-bold">M</div>
          <div class="w-7 h-7 rounded-full bg-blue-600 border-2 border-white flex items-center justify-center text-white text-xs font-bold">+</div>
        </div>
        <p class="text-slate-400 text-xs">Trusted by <span class="text-blue-600 font-semibold">5,000+</span> schools worldwide</p>
        <span class="text-slate-200">|</span>
        <div class="flex items-center gap-1 text-amber-400 text-xs font-semibold">
          ★★★★★ <span class="text-slate-400 font-normal ml-1">4.9 / 5</span>
        </div>
      </div>
    </div>

    <div class="flex flex-col md:flex-row items-stretch justify-center gap-5 max-w-4xl mx-auto stagger-group">
      <div x-intersect.once="$el.classList.add('visible')" class="float-card flex-1 min-w-0 reveal">
        <div class="flex items-center gap-3 mb-3">
          <div class="w-9 h-9 rounded-full bg-blue-100 flex items-center justify-center">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#2563eb" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
          </div>
          <div>
            <div class="text-xs text-slate-400 font-medium">Total Students</div>
            <div class="text-xl font-bold text-slate-800" style="font-family:'Sora',sans-serif;">1,248</div>
          </div>
          <div class="ml-auto text-xs font-semibold text-green-600 bg-green-50 rounded-full px-2 py-0.5">+12%</div>
        </div>
        <div class="progress-bar"><div class="progress-fill" style="width:76%"></div></div>
        <div class="text-xs text-slate-400 mt-1.5">Enrolled this semester</div>
      </div>

      <div x-intersect.once="$el.classList.add('visible')" class="float-card flex-1 min-w-0 border-2 border-blue-200 relative reveal">
        <div class="absolute -top-3 left-1/2 -translate-x-1/2 bg-blue-600 text-white text-xs font-bold px-3 py-0.5 rounded-full whitespace-nowrap">LIVE</div>
        <div class="text-xs text-slate-400 font-medium mb-1">Today's Attendance</div>
        <div class="text-3xl font-bold text-blue-600 mb-1" style="font-family:'Sora',sans-serif;">94.3%</div>
        <div class="flex gap-3 mt-2 flex-wrap">
          <div class="flex items-center gap-1.5 text-xs text-slate-500"><span class="w-2 h-2 rounded-full bg-green-400 inline-block"></span>Present — 1,176</div>
          <div class="flex items-center gap-1.5 text-xs text-slate-500"><span class="w-2 h-2 rounded-full bg-red-400 inline-block"></span>Absent — 72</div>
        </div>
        <div class="progress-bar mt-3"><div class="progress-fill" style="width:94%"></div></div>
      </div>

      <div x-intersect.once="$el.classList.add('visible')" class="float-card flex-1 min-w-0 reveal">
        <div class="flex items-center gap-2 mb-3">
          <div class="w-8 h-8 rounded-full bg-blue-600 flex items-center justify-center text-white font-bold text-sm" style="font-family:'Sora',sans-serif;">SC</div>
          <div>
            <div class="text-sm font-semibold text-slate-700">Sarah Connor</div>
            <div class="text-xs text-slate-400">Grade 10 – Math</div>
          </div>
        </div>
        <div class="bg-blue-50 rounded-lg px-3 py-2 flex justify-between items-center">
          <div class="text-xs text-blue-600 font-medium">Latest Score</div>
          <div class="text-lg font-bold text-blue-700" style="font-family:'Sora',sans-serif;">87/100</div>
        </div>
        <div class="text-xs text-slate-400 mt-2 flex items-center gap-1">
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#3b82f6" stroke-width="2"><polyline points="22 7 13.5 15.5 8.5 10.5 2 17"/><polyline points="16 7 22 7 22 13"/></svg>
          Top of class this week
        </div>
      </div>
    </div>
  </div>
</section>

<section x-data="trustedBy" class="bg-white py-12 border-b border-slate-100">
  <div class="max-w-6xl mx-auto px-6 text-center">
    <p x-intersect.once="$el.classList.add('visible')" class="text-slate-400 text-sm font-medium mb-6 uppercase tracking-widest reveal">Trusted By More Than <span class="text-blue-600 font-bold">+5,000</span> Schools Worldwide</p>
    <div class="ticker-wrap">
      <div class="ticker-inner">
        <template x-for="school in ticker" :key="school.name + Math.random()">
          <span class="text-slate-400 font-bold text-base tracking-tight whitespace-nowrap"
                x-text="school.emoji + ' ' + school.name">
          </span>
        </template>
      </div>
    </div>
  </div>
</section>

<section 
  id="features" 
  class="bg-neutral-50 py-24 px-6" 
  x-data="featuresSection"
>
  <div class="max-w-6xl mx-auto">
    <div x-intersect.once="$el.classList.add('visible')" class="text-center mb-14 reveal">
      <div class="badge mb-4">
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
        SchooLY Easy to Use
      </div>
      <h2 class="text-3xl md:text-4xl font-bold text-slate-800 mb-3">Get The Most Powerful and<br/><span class="text-blue-600">Easy to Use</span> School Platform</h2>
      <p class="text-slate-500 max-w-lg mx-auto text-sm">Whether you're an admin, teacher, parent, or student — SchooLY has a tailored experience for everyone.</p>
    </div>

    <!-- Tab buttons — plain static buttons, Alpine binds active state -->
    <div x-intersect.once="$el.classList.add('visible')" class="flex justify-center gap-3 mb-10 flex-wrap reveal">
      <template x-for="btn in tabs" :key="btn.key">
        <button
          @click="tab = btn.key"
          :class="tab === btn.key
            ? 'bg-blue-600 text-white shadow-md'
            : 'bg-white border border-slate-200 text-slate-600 hover:border-blue-300'"
          class="px-5 py-2 rounded-full text-sm font-semibold transition-all duration-200"
          x-text="btn.label">
        </button>
      </template>
    </div>

    <div
      x-show="panelVisible"
      x-transition:enter="transition ease-out duration-300"
      x-transition:enter-start="opacity-0"
      x-transition:enter-end="opacity-100"
      x-transition:leave="transition ease-in duration-150"
      x-transition:leave-start="opacity-100"
      x-transition:leave-end="opacity-0"
      class="grid grid-cols-1 md:grid-cols-3 gap-5"
    >
      <template x-for="card in activeCards" :key="card.title">
        <div :class="card.accent
            ? 'feat-card p-7 flex flex-col gap-4 bg-blue-50 border-blue-200'
            : 'feat-card p-7 flex flex-col gap-4'">

          <div
            :class="card.accent
              ? 'w-11 h-11 rounded-xl bg-blue-600 flex items-center justify-center'
              : 'w-11 h-11 rounded-xl bg-blue-100 flex items-center justify-center'"
            x-html="card.svg">
          </div>

          <div>
            <h3
              :class="card.accent ? 'text-base font-bold text-blue-800 mb-1' : 'text-base font-bold text-slate-800 mb-1'"
              x-text="card.title">
            </h3>
            <p
              :class="card.accent ? 'text-sm text-blue-700/70 leading-relaxed' : 'text-sm text-slate-500 leading-relaxed'"
              x-text="card.body">
            </p>
          </div>

          <template x-if="card.tags.length > 0">
            <div class="flex gap-2 flex-wrap">
              <template x-for="tag in card.tags" :key="tag">
                <span
                  class="bg-white/70 border border-blue-200 text-blue-700 text-xs font-semibold px-3 py-1 rounded-full"
                  x-text="tag">
                </span>
              </template>
            </div>
          </template>
        </div>
      </template>
    </div>
  </div>
</section>

<!-- ═══════════════════════════ ACHIEVEMENTS ═══════════════════════════ -->
<section class="bg-white py-24 px-6">
  <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
    <div x-intersect.once="$el.classList.add('visible')" class="reveal from-left">
      <div class="badge mb-5">
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
        SchooLY Achievements
      </div>
      <h2 class="text-3xl md:text-4xl font-bold text-slate-800 mb-4">Rewards That Are<br/><span class="text-blue-600">Endlessly Motivating</span><br/>For Every Student</h2>
      <p class="text-slate-500 text-sm leading-relaxed mb-6 max-w-md">Gamify learning at your school. Award badges, track milestones, and celebrate achievements automatically — keeping students engaged all year long.</p>
      <div class="flex flex-col gap-3">
        <div class="flex items-start gap-3">
          <div class="w-6 h-6 rounded-full bg-blue-600 flex items-center justify-center shrink-0 mt-0.5"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg></div>
          <p class="text-sm text-slate-600">Auto badge awards for attendance, grades, and improvement</p>
        </div>
        <div class="flex items-start gap-3">
          <div class="w-6 h-6 rounded-full bg-blue-600 flex items-center justify-center shrink-0 mt-0.5"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg></div>
          <p class="text-sm text-slate-600">Class leaderboard keeps friendly competition healthy and fun</p>
        </div>
        <div class="flex items-start gap-3">
          <div class="w-6 h-6 rounded-full bg-blue-600 flex items-center justify-center shrink-0 mt-0.5"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg></div>
          <p class="text-sm text-slate-600">Parents notified instantly for every milestone their child earns</p>
        </div>
      </div>
    </div>

    <div x-intersect.once="$el.classList.add('visible')" class="relative reveal from-right">
      <div class="invoice-card p-6">
        <div class="flex items-center justify-between mb-5">
          <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-blue-600 text-white font-bold flex items-center justify-center" style="font-family:'Sora',sans-serif;">JA</div>
            <div>
              <div class="font-semibold text-slate-800 text-sm">James Adeyemi</div>
              <div class="text-xs text-slate-400">Grade 11 — Science Track</div>
            </div>
          </div>
          <div class="text-right">
            <div class="text-xs text-slate-400">GPA</div>
            <div class="text-2xl font-bold text-blue-600" style="font-family:'Sora',sans-serif;">3.94</div>
          </div>
        </div>
        <div class="flex flex-col gap-3 mb-5">
          <div>
            <div class="flex justify-between text-xs text-slate-500 mb-1"><span>Mathematics</span><span class="font-semibold text-slate-700">95%</span></div>
            <div class="progress-bar"><div class="progress-fill" style="width:95%"></div></div>
          </div>
          <div>
            <div class="flex justify-between text-xs text-slate-500 mb-1"><span>Biology</span><span class="font-semibold text-slate-700">88%</span></div>
            <div class="progress-bar"><div class="progress-fill" style="width:88%"></div></div>
          </div>
          <div>
            <div class="flex justify-between text-xs text-slate-500 mb-1"><span>Physics</span><span class="font-semibold text-slate-700">91%</span></div>
            <div class="progress-bar"><div class="progress-fill" style="width:91%"></div></div>
          </div>
        </div>
        <div class="border-t border-slate-100 pt-4">
          <div class="text-xs text-slate-400 font-medium mb-2">Earned Badges</div>
          <div class="flex gap-2 flex-wrap">
            <span class="bg-yellow-50 border border-yellow-200 text-yellow-700 text-xs font-semibold px-3 py-1 rounded-full">🏅 Top Scorer</span>
            <span class="bg-green-50 border border-green-200 text-green-700 text-xs font-semibold px-3 py-1 rounded-full">✅ Full Attendance</span>
            <span class="bg-blue-50 border border-blue-200 text-blue-700 text-xs font-semibold px-3 py-1 rounded-full">📈 Most Improved</span>
          </div>
        </div>
      </div>
      <div class="absolute -bottom-5 -left-5 bg-blue-600 text-white rounded-xl p-3 shadow-xl text-xs font-semibold">
        🎉 New badge: <span class="font-bold">Honor Roll!</span>
      </div>
    </div>
  </div>
</section>

<!-- ═══════════════════════════ SECURITY ═══════════════════════════ -->
<section id="security" class="bg-neutral-50 py-24 px-6">
  <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
    <div class="relative">
      <div class="invoice-card p-6 max-w-sm mx-auto md:mx-0">
        <div class="flex items-center gap-3 mb-4">
          <div class="w-9 h-9 rounded-full bg-blue-600 flex items-center justify-center text-white font-bold text-sm" style="font-family:'Sora',sans-serif;">JC</div>
          <div>
            <div class="font-semibold text-slate-700 text-sm">John Clayton</div>
            <div class="text-xs text-slate-400">Principal, Admin Access</div>
          </div>
          <div class="ml-auto flex items-center gap-1 bg-green-50 border border-green-200 text-green-700 text-xs font-semibold px-2 py-1 rounded-lg">
            <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
            Verified
          </div>
        </div>
        <div class="bg-slate-50 rounded-xl p-4 mb-4">
          <div class="text-xs text-slate-400 mb-1">Active Students</div>
          <div class="text-2xl font-bold text-slate-800 mb-1" style="font-family:'Sora',sans-serif;">1,248</div>
          <div class="flex gap-4 text-xs text-slate-500">
            <span>📥 Enrolled <span class="font-semibold text-slate-700">1,176</span></span>
            <span>📤 Alumni <span class="font-semibold text-slate-700">340</span></span>
          </div>
        </div>
        <div class="flex gap-2">
          <div class="flex-1 bg-blue-50 border border-blue-100 rounded-lg p-3">
            <div class="text-xs text-slate-400 mb-0.5">Staff</div>
            <div class="font-bold text-blue-700">98 Active</div>
          </div>
          <div class="flex-1 bg-green-50 border border-green-100 rounded-lg p-3">
            <div class="text-xs text-slate-400 mb-0.5">Classes</div>
            <div class="font-bold text-green-700">42 Rooms</div>
          </div>
        </div>
      </div>
      <div class="absolute -top-4 right-0 bg-white border border-slate-200 rounded-xl p-2.5 shadow-lg flex items-center gap-2 text-xs font-semibold text-slate-700">
        <span class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></span>256-bit Encryption ON
      </div>
      <div class="absolute -bottom-4 right-8 bg-white border border-slate-200 rounded-xl p-2.5 shadow-lg flex items-center gap-2 text-xs font-semibold text-slate-700">
        <span class="w-2 h-2 rounded-full bg-blue-500"></span>2-Factor Auth Active
      </div>
    </div>

    <div x-intersect.once="$el.classList.add('visible')" class="reveal from-right">
      <div class="badge mb-5">
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
        SchooLY Data Secure
      </div>
      <h2 class="text-3xl md:text-4xl font-bold text-slate-800 mb-4">Keep Your School Data<br/><span class="text-blue-600">Secure Always</span></h2>
      <p class="text-slate-500 text-sm leading-relaxed mb-8 max-w-md">Enterprise-grade security with role-based access control. The right people see the right information — nothing more, nothing less.</p>
      <div class="grid grid-cols-2 gap-4 stagger-group">
        <div x-intersect.once="$el.classList.add('visible')" class="bg-white border border-slate-200 rounded-xl p-4 reveal scale-in">
          <div class="text-lg mb-1">🔒</div>
          <div class="font-semibold text-slate-700 text-sm mb-1">End-to-End Encryption</div>
          <div class="text-xs text-slate-400">All data encrypted at rest and in transit</div>
        </div>
        <div x-intersect.once="$el.classList.add('visible')" class="bg-white border border-slate-200 rounded-xl p-4 reveal scale-in">
          <div class="text-lg mb-1">👁️</div>
          <div class="font-semibold text-slate-700 text-sm mb-1">Role-Based Access</div>
          <div class="text-xs text-slate-400">Fine-grained permissions per user role</div>
        </div>
        <div x-intersect.once="$el.classList.add('visible')" class="bg-white border border-slate-200 rounded-xl p-4 reveal scale-in">
          <div class="text-lg mb-1">📋</div>
          <div class="font-semibold text-slate-700 text-sm mb-1">Audit Logs</div>
          <div class="text-xs text-slate-400">Full activity history for compliance</div>
        </div>
        <div x-intersect.once="$el.classList.add('visible')" class="bg-white border border-slate-200 rounded-xl p-4 reveal scale-in">
          <div class="text-lg mb-1">☁️</div>
          <div class="font-semibold text-slate-700 text-sm mb-1">Automatic Backups</div>
          <div class="text-xs text-slate-400">Daily cloud backups, zero data loss</div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ═══════════════════════════ ONBOARDING ═══════════════════════════ -->
<section class="bg-white py-24 px-6">
  <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
    <div x-intersect.once="$el.classList.add('visible')" class="reveal from-left">
      <div class="badge mb-5">
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
        SchooLY Speed
      </div>
      <h2 class="text-3xl md:text-4xl font-bold text-slate-800 mb-4">Onboard Your Entire School<br/>Within <span class="text-blue-600">Minutes</span></h2>
      <p class="text-slate-500 text-sm leading-relaxed mb-8 max-w-md">Migrate from spreadsheets or your old system instantly. Bulk-import students, staff, and class data in seconds. No IT team needed.</p>
      <div class="flex flex-col gap-5 stagger-group">
        <div x-intersect.once="$el.classList.add('visible')" class="flex items-start gap-4 reveal">
          <div class="step-dot">1</div>
          <div><div class="font-semibold text-slate-700 text-sm mb-0.5">Create your school account</div><div class="text-xs text-slate-400">Sign up with your official school email in under 60 seconds</div></div>
        </div>
        <div x-intersect.once="$el.classList.add('visible')" class="flex items-start gap-4 reveal">
          <div class="step-dot">2</div>
          <div><div class="font-semibold text-slate-700 text-sm mb-0.5">Import students & staff</div><div class="text-xs text-slate-400">Upload a CSV or connect your existing student information system</div></div>
        </div>
        <div x-intersect.once="$el.classList.add('visible')" class="flex items-start gap-4 reveal">
          <div class="step-dot">3</div>
          <div><div class="font-semibold text-slate-700 text-sm mb-0.5">Go live on Day One</div><div class="text-xs text-slate-400">Attendance, grades, messaging — everything ready from day one</div></div>
        </div>
        <div x-intersect.once="$el.classList.add('visible')" class="flex items-start gap-4 reveal">
          <div class="step-dot">4</div>
          <div><div class="font-semibold text-slate-700 text-sm mb-0.5">Parents get instant access</div><div class="text-xs text-slate-400">Auto-generate parent login links and notify via SMS or email</div></div>
        </div>
      </div>
    </div>

    <div x-intersect.once="$el.classList.add('visible')" class="relative reveal from-right">
      <div class="invoice-card p-6 max-w-sm mx-auto md:mx-0">
        <div class="flex items-center gap-3 mb-5">
          <div class="w-10 h-10 rounded-xl bg-blue-100 flex items-center justify-center">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#2563eb" stroke-width="2"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
          </div>
          <div>
            <div class="text-xs text-slate-400">School Setup</div>
            <div class="font-bold text-slate-700">Greenfield Academy</div>
          </div>
        </div>
        <div class="flex flex-col gap-3 mb-5">
          <div class="bg-slate-50 rounded-lg p-3 flex items-center justify-between"><span class="text-sm text-slate-600">Students imported</span><span class="font-bold text-blue-600">1,248 ✓</span></div>
          <div class="bg-slate-50 rounded-lg p-3 flex items-center justify-between"><span class="text-sm text-slate-600">Staff accounts created</span><span class="font-bold text-blue-600">98 ✓</span></div>
          <div class="bg-slate-50 rounded-lg p-3 flex items-center justify-between"><span class="text-sm text-slate-600">Classes configured</span><span class="font-bold text-blue-600">42 ✓</span></div>
          <div class="bg-slate-50 rounded-lg p-3 flex items-center justify-between"><span class="text-sm text-slate-600">Parent invites sent</span><span class="font-bold text-green-600">1,102 sent ✓</span></div>
        </div>
        <button class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl py-3 text-sm transition-colors flex items-center justify-center gap-2">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
          School Setup Complete
        </button>
      </div>
      <div class="absolute -top-5 -right-2 bg-white border border-slate-200 rounded-xl p-3 shadow-lg max-w-xs">
        <div class="text-xs font-bold text-slate-700 mb-0.5">🚀 Ready in 4 minutes!</div>
        <div class="text-xs text-slate-400">Your portal is live and ready for students</div>
      </div>
    </div>
  </div>
</section>

<!-- ═══════════════════════════ CTA BANNER ═══════════════════════════ -->
<section class="bg-blue-600 py-24 px-6">
  <div x-intersect.once="$el.classList.add('visible')" class="max-w-2xl mx-auto text-center relative z-10 reveal">
    <h2 class="text-3xl md:text-4xl font-bold text-white mb-3">Start Managing Your School<br/>In Just 4 Minutes</h2>
    <p class="text-blue-200 text-sm mb-8">No contracts. No setup fees. Free for the first 30 days.</p>
    <div class="flex items-center justify-center gap-3 flex-wrap">
      <input type="email" placeholder="Enter your school email"
        class="bg-white/15 border border-white/30 text-white placeholder-blue-200 rounded-xl px-5 py-3 text-sm w-64 focus:outline-none focus:ring-2 focus:ring-white/40"/>
      <button class="bg-white text-blue-600 font-bold px-6 py-3 rounded-xl text-sm shadow-lg hover:bg-blue-50 transition-colors flex items-center gap-2">
        Get Started Free
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
      </button>
    </div>
    <p class="text-blue-200 text-xs mt-5 opacity-80">Trusted by 5,000+ schools worldwide • No credit card required</p>
  </div>
</section>

<!-- ═══════════════════════════ FOOTER ═══════════════════════════ -->
<footer class="bg-slate-900 text-slate-400 py-16 px-6">
  <div class="max-w-6xl mx-auto">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-10 mb-12">
      <div>
        <div class="flex items-center gap-2 mb-4">
          <div class="w-8 h-8 rounded-lg bg-blue-600 flex items-center justify-center">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
          </div>
          <span class="font-bold text-white text-lg" style="font-family:'Sora',sans-serif;">Schoo<span class="text-blue-400">LY</span></span>
        </div>
        <p class="text-sm leading-relaxed mb-4">SchooLY is a powerful school management platform for admins, teachers, students, and parents.</p>
        <div class="flex gap-3">
          <a href="#" class="w-8 h-8 rounded-full bg-slate-800 hover:bg-blue-600 flex items-center justify-center transition-colors">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor"><path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"/></svg>
          </a>
          <a href="#" class="w-8 h-8 rounded-full bg-slate-800 hover:bg-blue-600 flex items-center justify-center transition-colors">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/></svg>
          </a>
          <a href="#" class="w-8 h-8 rounded-full bg-slate-800 hover:bg-blue-600 flex items-center justify-center transition-colors">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
          </a>
        </div>
      </div>
      <div>
        <div class="font-semibold text-white text-sm mb-4">Product</div>
        <ul class="flex flex-col gap-2 text-sm">
          <li><a href="#" class="hover:text-blue-400 transition-colors">About</a></li>
          <li><a href="#" class="hover:text-blue-400 transition-colors">Features</a></li>
          <li><a href="#" class="hover:text-blue-400 transition-colors">Security</a></li>
          <li><a href="#" class="hover:text-blue-400 transition-colors">Pricing</a></li>
          <li><a href="#" class="hover:text-blue-400 transition-colors">Testimonials</a></li>
        </ul>
      </div>
      <div>
        <div class="font-semibold text-white text-sm mb-4">Company</div>
        <ul class="flex flex-col gap-2 text-sm">
          <li><a href="#" class="hover:text-blue-400 transition-colors">Careers</a></li>
          <li><a href="#" class="hover:text-blue-400 transition-colors">Blog</a></li>
          <li><a href="#" class="hover:text-blue-400 transition-colors">Support Center</a></li>
          <li><a href="#" class="hover:text-blue-400 transition-colors">Contact Us</a></li>
        </ul>
      </div>
      <div>
        <div class="font-semibold text-white text-sm mb-4">Legal</div>
        <ul class="flex flex-col gap-2 text-sm">
          <li><a href="#" class="hover:text-blue-400 transition-colors">Privacy Policy</a></li>
          <li><a href="#" class="hover:text-blue-400 transition-colors">Terms of Service</a></li>
          <li><a href="#" class="hover:text-blue-400 transition-colors">Cookie Policy</a></li>
          <li><a href="#" class="hover:text-blue-400 transition-colors">GDPR Compliance</a></li>
        </ul>
      </div>
    </div>
    <div class="border-t border-slate-800 pt-8 flex flex-col md:flex-row items-center justify-between gap-3">
      <div class="flex items-center gap-2">
        <div class="w-6 h-6 rounded bg-blue-600 flex items-center justify-center">
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
        </div>
        <span class="text-sm text-white font-semibold" style="font-family:'Sora',sans-serif;">SchooLY</span>
      </div>
      <p class="text-xs text-slate-500">© 2025 SchooLY. All Rights Reserved.</p>
      <p class="text-xs text-slate-500">SchooLY has a passion for educating students worldwide.</p>
    </div>
  </div>
</footer>
</body>
</html>