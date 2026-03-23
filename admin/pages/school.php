<?php
$school_name = $_SESSION['school_name'];
$school_slug = $_SESSION['school_slug'];
$school_address = $_SESSION['school_address'];
$school_phone = $_SESSION['school_phone'];
$school_email = $_SESSION['school_email'];
?>

<div>
  <h2 class="text-xl font-bold text-gray-800 mb-4">School Information</h2>

  <!-- School identity card -->
  <div class="bg-white border border-zinc-200/60 rounded-2xl p-6 mb-6">
    <div class="flex items-start justify-between">
      <div class="flex items-center gap-4">
        <div class="w-14 h-14 rounded-xl bg-blue-50 flex items-center justify-center font-semibold text-blue-700 text-xl">
          <?= strtoupper(substr($school_name, 0, 2)) ?>
        </div>
        <div>
          <h3 class="text-lg font-semibold text-gray-900"><?= htmlspecialchars($school_name) ?></h3>
          <p class="text-sm text-neutral-400"><?= htmlspecialchars(
            $school_address,
          ) ?> · Est . <?= $school_name ?></p> 
          <!-- year founded -->
        </div>
      </div>
      <span class="text-xs font-semibold px-3 py-1 rounded-full bg-green-100 text-green-800">Active</span>
    </div>

    <hr class="my-4 border-zinc-100">

    <div class="flex gap-8 flex-wrap text-sm">
      <div><p class="text-xs text-neutral-400 uppercase tracking-wide mb-1">Code</p><span class="font-medium"><?= $school_slug ?></span></div>
      <div><p class="text-xs text-neutral-400 uppercase tracking-wide mb-1">Email</p><span class="font-medium"><?= $school_email ?></span></div>
      <div><p class="text-xs text-neutral-400 uppercase tracking-wide mb-1">Phone</p><span class="font-medium"><?= $school_phone ?></span></div>
    </div>
  </div>

  <!-- Accordions -->
  <div x-data="{ open: null }" class="space-y-2">

    <!-- Term & Session -->
    <div class="border border-zinc-200/60 bg-white rounded-xl overflow-hidden">
      <button x-on:click="open = open === 'term' ? null : 'term'"
              class="w-full flex justify-between items-center px-5 py-4 text-sm font-semibold text-gray-800 hover:bg-zinc-50">
        <span class="flex items-center gap-3"><!-- icon --> Academic term & session</span>
        <svg :class="open === 'term' ? 'rotate-180' : ''" class="w-4 h-4 text-neutral-400 transition-transform"></svg>
      </button>
      <div x-show="open === 'term'" x-collapse class="px-5 pb-5 border-t border-zinc-100">
        <!-- term/session form fields -->
      </div>
    </div>

    <!-- Holidays, Events, Sessions follow same pattern -->

  </div>
</div>