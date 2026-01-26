<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Setup</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="assets/js/school-admin.js?v=<?= rand(0000,9999) ?>"></script>
</head>
<body class="bg-linear-to-br from-blue-50 to-indigo-100 min-h-screen">
    <div x-data="setupApp" class="container mx-auto px-4 py-8 max-w-4xl">
        
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-gray-800 mb-2">School Management System</h1>
            <p class="text-gray-600">Set up your school and create admin account</p>
        </div>

        <!-- Setup Form -->
        <div class="bg-white rounded-2xl shadow-xl p-8">
            
            <!-- Step Indicator -->
            <div class="mb-8">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div :class="step >= 1 ? 'bg-blue-600 text-white' : 'bg-gray-300 text-gray-600'" 
                             class="w-10 h-10 rounded-full flex items-center justify-center font-bold">
                            1
                        </div>
                        <span class="ml-3 font-medium text-gray-700">School Info</span>
                    </div>
                    <div class="flex-1 h-1 mx-4 bg-gray-300">
                        <div :class="step >= 2 ? 'bg-blue-600' : ''" class="h-full transition-all duration-300" 
                             :style="`width: ${step >= 2 ? '100%' : '0%'}`"></div>
                    </div>
                    <div class="flex items-center">
                        <div :class="step >= 2 ? 'bg-blue-600 text-white' : 'bg-gray-300 text-gray-600'" 
                             class="w-10 h-10 rounded-full flex items-center justify-center font-bold">
                            2
                        </div>
                        <span class="ml-3 font-medium text-gray-700">Admin Account</span>
                    </div>
                </div>
            </div>

            <!-- Step 1: School Information -->
            <div x-show="step === 1" x-transition class="space-y-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">School Information</h2>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                School Name <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                x-model="school.name"
                                placeholder="e.g., Green Valley Academy"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                School Slug <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                x-model="school.slug"
                                placeholder="e.g., gva or greenvalley"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                School Email <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="email" 
                                x-model="school.email"
                                placeholder="admin@yourschool.edu.ng"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Phone Number
                            </label>
                            <input 
                                type="tel" 
                                x-model="school.phone"
                                placeholder="090 XXX XXX XXXX"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Address
                            </label>
                            <textarea 
                                x-model="school.address"
                                rows="3"
                                placeholder="School address"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end">
                    <button 
                        @click="nextStep()"
                        class="px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors">
                        Next: Create Admin Account →
                    </button>
                </div>
            </div>

            <!-- Step 2: Admin Account -->
            <div x-show="step === 2" x-transition class="space-y-6">
                <div>
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-2xl font-bold text-gray-800">Admin Account</h2>
                        <button 
                            @click="step = 1"
                            class="text-sm text-blue-600 hover:text-blue-700 font-medium">
                            ← Back to School Info
                        </button>
                    </div>
                    
                    <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-6">
                        <p class="text-sm text-blue-800">
                            <strong>Note:</strong> Only one admin account is allowed per school. This admin will have full control over the system.
                        </p>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Admin Surname <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                x-model="admin.name.surname"
                                placeholder="Surname"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <div class="flex justify-center items-center gap-4">
                            <div class="w-full">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                Admin Firstname <span class="text-red-500">*</span>
                                </label>
                                <input 
                                    type="text" 
                                    x-model="admin.name.firstname"
                                    placeholder="Firstname"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                >
                            </div>

                            <div class="w-full">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                Admin Othername
                                </label>
                                <input 
                                    type="text" 
                                    x-model="admin.name.othername"
                                    placeholder="Othername"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                >
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Admin Email <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="email" 
                                x-model="admin.email"
                                placeholder="admin@yourschool.edu.ng"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Password <span class="text-red-500">*</span>
                            </label>
                            <input 
                                :type="showPassword ? 'text' : 'password'" 
                                x-model="admin.password"
                                placeholder="Create a strong password"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <div class="mt-2">
                                <label class="flex items-center">
                                    <input type="checkbox" x-model="showPassword" class="mr-2">
                                    <span class="text-sm text-gray-600">Show password</span>
                                </label>
                            </div>
                            <p class="mt-1 text-xs text-gray-500">Password must be at least 8 characters long</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Confirm Password <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="password" 
                                x-model="admin.confirm_password"
                                placeholder="Confirm password"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                    </div>
                </div>

                <div class="flex justify-end gap-4">
                    <button 
                        @click="submitSetup()"
                        :disabled="submitting"
                        class="px-8 py-3 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 disabled:opacity-50 disabled:cursor-not-allowed transition-colors">
                        <span x-show="!submitting">✓ Complete Setup</span>
                        <span x-show="submitting" class="flex items-center">
                            <svg class="animate-spin -ml-1 mr-2 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Setting up...
                        </span>
                    </button>
                </div>
            </div>

            <!-- Success Message -->
            <div x-show="success" x-transition class="text-center py-8">
                <div class="mb-6">
                    <div class="mx-auto w-20 h-20 bg-green-100 rounded-full flex items-center justify-center">
                        <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-2">Setup Complete!</h3>
                <p class="text-gray-600 mb-6">Your school and admin account have been created successfully.</p>
                <div class="bg-gray-50 rounded-lg p-4 mb-6 text-left">
                    <h4 class="font-semibold text-gray-800 mb-2">Login Details:</h4>
                    <p class="text-sm text-gray-600">School Code: <strong x-text="setupResult.school_code"></strong></p>
                    <p class="text-sm text-gray-600">Email: <strong x-text="admin.email"></strong></p>
                </div>
                <a href="login.php" class="inline-block px-8 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors">
                    Go to Login →
                </a>
            </div>

        </div>

        <!-- Notification Toast -->
        <div x-show="notification.show" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 transform translate-y-2"
             x-transition:enter-end="opacity-100 transform translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 transform translate-y-0"
             x-transition:leave-end="opacity-0 transform translate-y-2"
             class="fixed bottom-4 right-4 max-w-sm w-full shadow-lg rounded-lg pointer-events-auto"
             :class="notification.type === 'success' ? 'bg-green-500' : 'bg-red-500'"
             style="display: none;">
            <div class="p-4">
                <div class="flex items-center">
                    <div class="flex-1">
                        <p class="text-sm font-medium text-white" x-text="notification.message"></p>
                    </div>
                    <button @click="notification.show = false" class="ml-4 text-white hover:text-gray-100">
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>