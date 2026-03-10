<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Setup</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="assets/js/school-admin.js?v=<?= rand(0000,9999) ?>"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700;800&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'DM Sans', sans-serif; }
        h1,h2,h3,h4,.sora { font-family: 'Sora', sans-serif; }
    </style>
</head>

<body class="bg-slate-100 min-h-screen flex items-center justify-center md:p-4">
    <div x-data="setupApp" class="w-full">
        <div
            x-show="notification.show"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 -translate-y-3"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-3"
            class="fixed top-5 left-1/2 -translate-x-1/2 z-50 w-full max-w-sm shadow-2xl rounded-2xl overflow-hidden"
            :class="notification.type === 'success' ? 'bg-green-500' : 'bg-red-500'"
            style="display:none;"
        >
            <div class="flex items-center gap-3 px-5 py-4">
                <p class="flex-1 text-sm font-medium text-white" x-text="notification.message"></p>
                <button @click="notification.show = false" class="text-white/70 hover:text-white transition-colors">
                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </button>
            </div>
        </div>

        <div class="mx-auto flex w-full lg:w-3/4 min-h-[620px] rounded-3xl overflow-hidden shadow-2xl shadow-indigo-200/60">
            <div class="hidden md:flex w-60 lg:w-80 shrink-0 bg-linear-to-br from-blue-600 via-indigo-700 to-indigo-900 flex-col justify-between p-10 relative overflow-hidden">
                <div class="absolute -top-16 -right-16 w-64 h-64 rounded-full bg-white/5"></div>
                <div class="absolute -bottom-20 -left-10 w-72 h-72 rounded-full bg-white/5"></div>
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-40 h-40 rounded-full bg-white/5"></div>

                <p class="sora text-xs font-bold tracking-widest uppercase text-white/50 relative z-10">School Management System</p>

                <div class="relative z-10 flex-1 flex flex-col justify-center py-10">
                    <h2 class="sora text-3xl lg:text-4xl font-extrabold text-white leading-tight tracking-tight mb-5">
                        Set up your<br>school in minutes.
                    </h2>
                    <p class="text-sm text-white/60 leading-relaxed font-light">
                        Configure your institution and create an admin account with full system control — quick, simple, and secure.
                    </p>
                    <div class="flex items-center gap-2 mt-8">
                        <span class="h-2 w-6 rounded-full bg-white"></span>
                        <span class="h-2 w-2 rounded-full bg-white/30"></span>
                        <span class="h-2 w-2 rounded-full bg-white/30"></span>
                    </div>
                </div>

                <div class="relative z-10 bg-white/10 border border-white/15 rounded-2xl p-5 backdrop-blur-sm">
                    <p class="text-sm text-white/80 leading-relaxed italic mb-4">"Getting our school online took less than 5 minutes. The setup flow is incredibly smooth."</p>
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-full bg-indigo-400 flex items-center justify-center sora font-bold text-sm text-white">AK</div>
                        <div>
                            <p class="sora text-sm font-semibold text-white">Adaeze K.</p>
                            <p class="text-xs text-white/45">School Administrator</p>
                        </div>
                    </div>
                </div>

            </div>

            <div class="flex-1 bg-white flex flex-col overflow-y-auto">
                <div class="flex justify-center items-center px-2 mt-2 md:px-8 lg:px-12">
                    <button 
                        class="relative border rounded-xl flex items-center gap-2.5 py-3 px-3 mr-8 transition-all duration-300"
                        :class="step === 1 ? 'border-slate-300 bg-slate-100' : 'border-slate-200/50 bg-slate-50/50'"
                    >
                        <div class="w-7 h-7 rounded-full flex items-center justify-center sora text-xs font-bold transition-all duration-300"
                            :class="step > 1 ? 'bg-green-500 text-white' : step === 1 ? 'bg-indigo-600 text-white' : 'bg-slate-100 text-slate-400'">
                            <template x-if="step > 1">
                                <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                            </template>
                            <template x-if="step <= 1"><span>1</span></template>
                        </div>
                        <span class="sora text-xs md:text-sm font-semibold transition-colors duration-300"
                            :class="step === 1 ? 'text-slate-800' : step > 1 ? 'text-green-500' : 'text-slate-400'">
                            School Info
                        </span>
                        <div class="rounded-full absolute top-0 -right-1" :class="step === 1 ? 'h-3 w-3 bg-indigo-600' : 'bg-neutral-50'"></div>
                    </button>

                    <button 
                        class="relative border rounded-xl flex items-center gap-2.5 py-3 px-3 transition-all duration-300"
                        :class="step === 2 ? 'border-slate-300 bg-slate-100' : 'border-slate-100 bg-slate-50/50'"
                    >
                        <div class="w-7 h-7 rounded-full flex items-center justify-center sora text-xs font-bold transition-all duration-300"
                            :class="step === 2 ? 'bg-indigo-600 text-white' : 'bg-slate-100 text-slate-400'">
                            2
                        </div>
                        <span class="sora text-xs md:text-sm font-semibold transition-colors duration-300"
                            :class="step === 2 ? 'text-slate-800' : 'text-slate-400'">
                            Admin Account
                        </span>
                        <div class="rounded-full absolute top-0 -right-1" :class="step === 2 ? 'h-3 w-3 bg-indigo-600' : 'bg-neutral-50'"></div>
                    </button>
                </div>

                <div 
                    x-show="step === 1"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-x-4"
                    x-transition:enter-end="opacity-100 translate-x-0"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-x-0"
                    x-transition:leave-end="opacity-0 -translate-x-4"
                    class="flex-1 px-3 md:px-8 lg:px-12 py-8"
                >
                    <h2 class="sora text-xl md:text-2xl font-bold text-slate-900 mb-1 tracking-tight">School Information</h2>
                    <p class="text-xs md:text-sm text-slate-400 mb-8">Tell us about your school to get started.</p>
                    <div class="space-y-5">
                        <div>
                            <label class="block sora text-sm font-medium text-slate-700 mb-2">School Name <span class="text-red-500">*</span></label>
                            <input type="text" x-model="school.name" placeholder="e.g., Green Valley Academy"
                                class="w-full px-4 py-3 border border-slate-200 rounded-xl bg-slate-50 text-slate-800 placeholder-slate-300 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent focus:bg-white transition-all duration-200">
                        </div>

                        <div>
                            <label class="block sora text-sm font-medium text-slate-700 mb-2">School Slug <span class="text-red-500">*</span></label>
                            <input type="text" x-model="school.slug" placeholder="e.g., gva or greenvalley"
                                class="w-full px-4 py-3 border border-slate-200 rounded-xl bg-slate-50 text-slate-800 placeholder-slate-300 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent focus:bg-white transition-all duration-200">
                        </div>

                        <div>
                            <label class="block sora text-sm font-medium text-slate-700 mb-2">School Email <span class="text-red-500">*</span></label>
                            <input type="email" x-model="school.email" placeholder="admin@yourschool.edu.ng"
                                class="w-full px-4 py-3 border border-slate-200 rounded-xl bg-slate-50 text-slate-800 placeholder-slate-300 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent focus:bg-white transition-all duration-200">
                        </div>

                        <div>
                            <label class="block sora text-sm font-medium text-slate-700 mb-2">Phone Number</label>
                            <input type="tel" x-model="school.phone" placeholder="090 XXX XXX XXXX"
                                class="w-full px-4 py-3 border border-slate-200 rounded-xl bg-slate-50 text-slate-800 placeholder-slate-300 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent focus:bg-white transition-all duration-200">
                        </div>

                        <div>
                            <label class="block sora text-sm font-medium text-slate-700 mb-2">Address</label>
                            <textarea x-model="school.address" rows="3" placeholder="School address"
                                class="w-full px-4 py-3 border border-slate-200 rounded-xl bg-slate-50 text-slate-800 placeholder-slate-300 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent focus:bg-white transition-all duration-200 resize-none"></textarea>
                        </div>
                    </div>

                    <div class="flex justify-end mt-8 pt-6 border-t border-slate-100">
                        <button @click="nextStep()"
                            class="flex items-center gap-2 px-7 py-3 bg-indigo-600 text-white sora text-sm font-semibold rounded-xl hover:bg-indigo-700 hover:-translate-y-0.5 hover:shadow-lg hover:shadow-indigo-200 active:translate-y-0 transition-all duration-200">
                            Next: Create Admin Account →
                        </button>
                    </div>

                </div>

                <div 
                    x-show="step === 2 && !success"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-x-4"
                    x-transition:enter-end="opacity-100 translate-x-0"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-x-0"
                    x-transition:leave-end="opacity-0 -translate-x-4"
                    class="flex-1 px-8 lg:px-12 py-8"
                >
                    <h2 class="sora text-2xl font-bold text-slate-900 mb-1 tracking-tight">Admin Account</h2>
                    <p class="text-sm text-slate-400 mb-6">This account will have full control over the system.</p>
                    <div class="bg-blue-50 border border-indigo-100/60 rounded-xl p-4 mb-6">
                        <p class="text-sm text-indigo-800">
                            <strong>Note:</strong> Only one admin account is allowed per school. This admin will have full control over the system.
                        </p>
                    </div>
                    <div class="space-y-5">
                        <div>
                            <label class="block sora text-sm font-medium text-slate-700 mb-2">Admin Surname <span class="text-red-500">*</span></label>
                            <input type="text" x-model="admin.name.surname" placeholder="Surname"
                                class="w-full px-4 py-3 border border-slate-200 rounded-xl bg-slate-50 text-slate-800 placeholder-slate-300 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent focus:bg-white transition-all duration-200">
                        </div>

                        <div class="flex justify-center items-center gap-4">
                            <div class="w-full">
                                <label class="block sora text-sm font-medium text-slate-700 mb-2">Admin Firstname <span class="text-red-500">*</span></label>
                                <input type="text" x-model="admin.name.firstname" placeholder="Firstname"
                                    class="w-full px-4 py-3 border border-slate-200 rounded-xl bg-slate-50 text-slate-800 placeholder-slate-300 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent focus:bg-white transition-all duration-200">
                            </div>
                            <div class="w-full">
                                <label class="block sora text-sm font-medium text-slate-700 mb-2">Admin Othername</label>
                                <input type="text" x-model="admin.name.othername" placeholder="Othername"
                                    class="w-full px-4 py-3 border border-slate-200 rounded-xl bg-slate-50 text-slate-800 placeholder-slate-300 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent focus:bg-white transition-all duration-200">
                            </div>
                        </div>

                        <div>
                            <label class="block sora text-sm font-medium text-slate-700 mb-2">Admin Email <span class="text-red-500">*</span></label>
                            <input type="email" x-model="admin.email" placeholder="admin@yourschool.edu.ng"
                                class="w-full px-4 py-3 border border-slate-200 rounded-xl bg-slate-50 text-slate-800 placeholder-slate-300 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent focus:bg-white transition-all duration-200">
                        </div>

                        <div>
                            <label class="block sora text-sm font-medium text-slate-700 mb-2">Password <span class="text-red-500">*</span></label>
                            <input :type="showPassword ? 'text' : 'password'" x-model="admin.password" placeholder="Create a strong password"
                                class="w-full px-4 py-3 border border-slate-200 rounded-xl bg-slate-50 text-slate-800 placeholder-slate-300 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent focus:bg-white transition-all duration-200">
                            <div class="mt-2">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox" x-model="showPassword" class="accent-indigo-600 w-4 h-4">
                                    <span class="text-sm text-slate-500">Show password</span>
                                </label>
                            </div>
                            <p class="mt-1 text-xs text-slate-400">Password must be at least 8 characters long</p>
                        </div>

                        <div>
                            <label class="block sora text-sm font-medium text-slate-700 mb-2">Confirm Password <span class="text-red-500">*</span></label>
                            <input type="password" x-model="admin.confirm_password" placeholder="Confirm password"
                                class="w-full px-4 py-3 border border-slate-200 rounded-xl bg-slate-50 text-slate-800 placeholder-slate-300 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent focus:bg-white transition-all duration-200">
                        </div>
                    </div>

                    <div class="flex items-center justify-between mt-8 pt-6 border-t border-slate-100">
                        <button @click="step = 1" class="text-sm text-indigo-600 hover:text-indigo-800 font-medium transition-colors duration-200">
                            ← Back to School Info
                        </button>
                        <button @click="submitSetup()" :disabled="submitting"
                            class="flex items-center gap-2 px-7 py-3 bg-green-600 text-white sora text-sm font-semibold rounded-xl hover:bg-green-700 hover:-translate-y-0.5 hover:shadow-lg hover:shadow-green-200 active:translate-y-0 disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none disabled:shadow-none transition-all duration-200">
                            <span x-show="!submitting" class="flex items-center gap-2">
                                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                Complete Setup
                            </span>
                            <span x-show="submitting" class="flex items-center gap-2">
                                <svg class="animate-spin w-4 h-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Setting up...
                            </span>
                        </button>
                    </div>
                </div>

                <div 
                    x-show="success"
                    x-transition:enter="transition ease-out duration-400"
                    x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100"
                    class="flex-1 flex flex-col items-center justify-center text-center px-8 lg:px-12 py-16"
                >
                    <div class="w-20 h-20 rounded-full bg-green-100 flex items-center justify-center mb-6">
                        <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <h3 class="sora text-2xl font-bold text-slate-900 mb-2">Setup Complete!</h3>
                    <p class="text-slate-500 text-sm mb-8">Your school and admin account have been created successfully.</p>
                    <div class="bg-slate-50 border border-slate-200 rounded-2xl p-6 mb-8 text-left w-full max-w-md">
                        <h4 class="sora font-semibold text-slate-800 mb-3">Login Details:</h4>
                        <p class="text-sm text-slate-500 mb-1">School Name: <strong class="text-slate-800" x-text="setupResult.school_name"></strong></p>
                        <p class="text-sm text-slate-500 mb-1">Email: <strong class="text-slate-800" x-text="admin.email"></strong></p>
                        <p class="text-sm text-slate-500">School Unique Link: <strong class="text-indigo-500 border-b border-dotted border-b-indigo-200" x-text="`schoolManagementSystem/s/${setupResult.school_slug}/login`"></strong></p>
                    </div>
                    <a :href="`/schoolManagementSystem/s/${setupResult.school_slug}/login`"
                        class="inline-flex items-center gap-2 px-8 py-3 bg-indigo-600 text-white sora text-sm font-semibold rounded-xl hover:bg-indigo-700 hover:-translate-y-0.5 hover:shadow-lg hover:shadow-indigo-200 transition-all duration-200">
                        Go to Login →
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>