<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
</head>

<body class="font-sans antialiased bg-gradient-to-br from-blue-800 to-blue-900 min-h-screen">
    <div class="min-h-screen flex items-center justify-center p-3 sm:p-4 lg:p-6 xl:p-8">
        <!-- Main Container with Background -->
        <div
            class="w-full max-w-6xl bg-white rounded-xl sm:rounded-2xl lg:rounded-3xl shadow-lg sm:shadow-xl lg:shadow-2xl overflow-hidden">
            <div class="flex flex-col lg:flex-row">
                <!-- Left Panel - Form Login -->
                <div class="w-full lg:w-2/5 p-3 sm:p-4 lg:p-6 xl:p-12 flex items-center justify-center">
                    <div class="w-full max-w-sm">
                        <!-- Logo -->
                        <div class="text-center mb-3 sm:mb-4 lg:mb-6 xl:mb-8">
                            <div
                                class="flex items-center justify-center gap-2 text-lg sm:text-xl lg:text-2xl font-bold text-gray-900 mb-1.5 sm:mb-2 lg:mb-3 xl:mb-4">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6 lg:w-8 lg:h-8 text-blue-600" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
                                </svg>
                                DeepMath
                            </div>
                        </div>

                        <!-- Title -->
                        <div class="text-center mb-3 sm:mb-4 lg:mb-6 xl:mb-8">
                            <h1 class="text-lg sm:text-xl lg:text-2xl font-bold text-gray-900 mb-2">Welcome Back!</h1>
                            <p class="text-gray-600 text-xs sm:text-sm px-2">
                                Sign in to access your dashboard and continue optimizing your learning process.
                            </p>
                        </div>

                        <!-- Session Status -->
                        @if (session('status'))
                            <div
                                class="mb-2 sm:mb-2.5 lg:mb-3 xl:mb-4 p-2 sm:p-2.5 lg:p-3 bg-green-50 border border-green-200 rounded-lg text-green-700 text-xs sm:text-sm">
                                {{ session('status') }}
                            </div>
                        @endif

                        <!-- Login Form -->
                        <form method="POST" action="{{ route('login') }}" class="space-y-2 sm:space-y-3 lg:space-y-4">
                            @csrf

                            <!-- Email -->
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-400 text-base sm:text-lg">@</span>
                                </div>
                                <input id="email" type="email" name="email" value="{{ old('email') }}" required
                                    autofocus autocomplete="username"
                                    class="w-full pl-10 pr-4 pt-5 sm:pt-6 pb-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 @error('email') border-red-500 @enderror peer text-sm sm:text-base h-12 sm:h-14"
                                    placeholder=" ">
                                <label for="email"
                                    class="absolute left-10 top-1.5 sm:top-2 text-xs sm:text-sm text-gray-500 transition-all duration-200 peer-focus:text-blue-500 peer-focus:text-xs peer-focus:-translate-y-1 peer-placeholder-shown:text-sm sm:peer-placeholder-shown:text-base peer-placeholder-shown:top-2.5 sm:peer-placeholder-shown:top-3 peer-placeholder-shown:text-gray-400">
                                    Email
                                </label>
                                @error('email')
                                    <p class="mt-1 text-xs sm:text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-4 w-4 sm:h-5 sm:w-5 text-gray-400" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                        </path>
                                    </svg>
                                </div>
                                <input id="password" type="password" name="password" required
                                    autocomplete="current-password"
                                    class="w-full pl-10 pr-12 pt-5 sm:pt-6 pb-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 @error('password') border-red-500 @enderror peer text-sm sm:text-base h-12 sm:h-14"
                                    placeholder=" ">
                                <label for="password"
                                    class="absolute left-10 top-1.5 sm:top-2 text-xs sm:text-sm text-gray-500 transition-all duration-200 peer-focus:text-blue-500 peer-focus:text-xs peer-focus:-translate-y-1 peer-placeholder-shown:text-sm sm:peer-placeholder-shown:text-base peer-placeholder-shown:top-2.5 sm:peer-placeholder-shown:top-3 peer-placeholder-shown:text-gray-400">
                                    Password
                                </label>
                                <button type="button"
                                    class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600"
                                    onclick="togglePassword()">
                                    <svg id="eye-icon" class="w-4 h-4 sm:w-5 sm:h-5" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21">
                                        </path>
                                    </svg>
                                </button>
                                @error('password')
                                    <p class="mt-1 text-xs sm:text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Forgot Password -->
                            <div class="flex justify-end">
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}"
                                        class="text-xs sm:text-sm text-blue-600 hover:text-blue-700 py-1">
                                        Forgot Password?
                                    </a>
                                @endif
                            </div>

                            <!-- Login Button -->
                            <button type="submit"
                                class="w-full bg-blue-700 text-white py-2.5 sm:py-3 px-4 rounded-lg font-medium hover:bg-blue-800 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-200 shadow-lg text-sm sm:text-base h-11 sm:h-12">
                                Sign In
                            </button>
                        </form>

                        <!-- Separator -->
                        <div class="my-2.5 sm:my-3 lg:my-4 xl:my-6 flex items-center">
                            <div class="flex-1 border-t border-gray-300"></div>
                            <span class="px-2 sm:px-3 lg:px-4 text-xs sm:text-sm text-gray-500">OR</span>
                            <div class="flex-1 border-t border-gray-300"></div>
                        </div>

                        <!-- Social Login Buttons -->
                        <div class="space-y-2 sm:space-y-2.5 lg:space-y-3">
                            <button
                                class="w-full flex items-center justify-center gap-2 sm:gap-3 px-2.5 sm:px-3 lg:px-4 py-2 sm:py-2.5 lg:py-3 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors duration-200 bg-white text-xs sm:text-sm h-10 sm:h-11 lg:h-12">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5" viewBox="0 0 24 24">
                                    <path fill="#4285F4"
                                        d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" />
                                    <path fill="#34A853"
                                        d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" />
                                    <path fill="#FBBC05"
                                        d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" />
                                    <path fill="#EA4335"
                                        d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" />
                                </svg>
                                Continue with Google
                            </button>

                            <button
                                class="w-full flex items-center justify-center gap-2 sm:gap-3 px-2.5 sm:px-3 lg:px-4 py-2 sm:py-2.5 lg:py-3 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors duration-200 bg-white text-xs sm:text-sm h-10 sm:h-11 lg:h-12">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5" viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="M18.71 19.5c-.83 1.24-1.71 2.45-3.05 2.47-1.34.03-1.77-.79-3.29-.79-1.53 0-2 .77-3.27.82-1.31.05-2.3-1.32-3.14-2.53C4.25 17 2.94 12.45 4.7 9.39c.87-1.52 2.43-2.48 4.12-2.51 1.28-.02 2.5.87 3.29.87.78 0 2.26-1.07 3.81-.91.65.03 2.47.26 3.64 1.98-.09.06-2.17 1.28-2.15 3.81.03 3.02 2.65 4.03 2.68 4.04-.03.07-.42 1.44-1.38 2.83M13 3.5c.73-.83 1.94-1.46 2.94-1.5.13 1.17-.34 2.35-1.04 3.19-.69.85-1.83 1.51-2.95 1.42-.15-1.15.41-2.35 1.05-3.11z" />
                                </svg>
                                Continue with Apple
                            </button>
                        </div>

                        <!-- Sign Up Link -->
                        <div class="mt-2.5 sm:mt-3 lg:mt-4 xl:mt-6 text-center">
                            <p class="text-gray-600 text-xs sm:text-sm">
                                Don't have an Account?
                                <a href="{{ route('register') }}"
                                    class="text-blue-600 hover:text-blue-700 font-medium">Sign Up</a>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Right Panel - DeepMath Branding -->
                <div
                    class="hidden lg:flex lg:w-3/5 bg-gradient-to-br from-blue-700 to-blue-800 relative overflow-hidden">
                    <!-- Background Pattern -->
                    <div class="absolute inset-0 opacity-10">
                        <!-- Mathematical Symbols Pattern -->
                        <div class="absolute top-10 left-10 text-6xl text-white opacity-20">∫</div>
                        <div class="absolute top-32 right-16 text-5xl text-white opacity-20">∑</div>
                        <div class="absolute top-64 left-20 text-4xl text-white opacity-20">π</div>
                        <div class="absolute top-96 right-24 text-6xl text-white opacity-20">∞</div>
                        <div class="absolute bottom-32 left-16 text-5xl text-white opacity-20">√</div>
                        <div class="absolute bottom-64 right-32 text-4xl text-white opacity-20">θ</div>
                        <div class="absolute bottom-96 left-32 text-6xl text-white opacity-20">Δ</div>

                        <!-- Geometric Shapes -->
                        <div
                            class="absolute top-20 right-32 w-16 h-16 border-2 border-white opacity-20 transform rotate-45">
                        </div>
                        <div class="absolute top-80 left-32 w-12 h-12 border-2 border-white opacity-20 rounded-full">
                        </div>
                        <div
                            class="absolute bottom-40 right-20 w-20 h-20 border-2 border-white opacity-20 transform rotate-12">
                        </div>
                    </div>

                    <!-- Main Content -->
                    <div
                        class="relative z-10 flex flex-col items-center justify-center text-center text-white px-12 w-full">
                        <!-- Logo -->
                        <div class="mb-8">
                            <div
                                class="w-24 h-24 bg-white bg-opacity-20 rounded-full flex items-center justify-center mb-6 backdrop-blur-sm">
                                <span class="text-4xl font-bold text-white">D</span>
                            </div>
                        </div>

                        <!-- App Name -->
                        <h1 class="text-5xl font-bold mb-4 tracking-wider">
                            DeepMath
                        </h1>

                        <!-- Tagline -->
                        <p class="text-xl font-medium mb-6 text-blue-100">
                            Deep Learning
                        </p>

                        <!-- Description -->
                        <p class="text-lg text-blue-200 leading-relaxed max-w-md mb-8">
                            Platform pembelajaran yang menggabungkan teknologi modern dengan metode
                            pembelajaran yang efektif untuk mengoptimalkan pemahaman konsep materi pemebelajaran.
                        </p>

                        <!-- Features -->
                        <div class="grid grid-cols-2 gap-6 max-w-lg">
                            <div class="text-center">
                                <div
                                    class="w-12 h-12 bg-white bg-opacity-20 rounded-lg flex items-center justify-center mx-auto mb-3 backdrop-blur-sm">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z">
                                        </path>
                                    </svg>
                                </div>
                                <p class="text-sm text-blue-100">Flexible Learning</p>
                            </div>

                            <div class="text-center">
                                <div
                                    class="w-12 h-12 bg-white bg-opacity-20 rounded-lg flex items-center justify-center mx-auto mb-3 backdrop-blur-sm">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                        </path>
                                    </svg>
                                </div>
                                <p class="text-sm text-blue-100">Interactive Content</p>
                            </div>

                            <div class="text-center">
                                <div
                                    class="w-12 h-12 bg-white bg-opacity-20 rounded-lg flex items-center justify-center mx-auto mb-3 backdrop-blur-sm">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                        </path>
                                    </svg>
                                </div>
                                <p class="text-sm text-blue-100">Progress Tracking</p>
                            </div>

                            <div class="text-center">
                                <div
                                    class="w-12 h-12 bg-white bg-opacity-20 rounded-lg flex items-center justify-center mx-auto mb-3 backdrop-blur-sm">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                        </path>
                                    </svg>
                                </div>
                                <p class="text-sm text-blue-100">Collaborative Learning</p>
                            </div>
                        </div>

                        <!-- Decorative Elements -->
                        <div
                            class="absolute bottom-8 left-8 w-16 h-16 border border-white opacity-20 transform rotate-45">
                        </div>
                        <div class="absolute bottom-8 right-8 w-12 h-12 border border-white opacity-20 rounded-full">
                        </div>
                    </div>
                </div>

                <!-- Mobile Branding Header (Visible only on mobile) -->
                <div
                    class="lg:hidden w-full bg-gradient-to-br from-blue-700 to-blue-800 py-3 sm:py-4 lg:py-6 px-2 sm:px-3 lg:px-4 text-center text-white">
                    <div class="flex flex-col items-center">
                        <!-- Mobile Logo -->
                        <div
                            class="w-10 h-10 sm:w-12 sm:h-12 lg:w-16 lg:h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center mb-1.5 sm:mb-2 lg:mb-3 backdrop-blur-sm">
                            <span class="text-lg sm:text-xl lg:text-2xl font-bold text-white">D</span>
                        </div>

                        <!-- Mobile App Name -->
                        <h1 class="text-lg sm:text-xl lg:text-2xl font-bold mb-1 sm:mb-2 tracking-wider">DeepMath</h1>

                        <!-- Mobile Tagline -->
                        <p class="text-xs sm:text-sm text-blue-100">Deep Learning Matematika</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                `;
            } else {
                passwordInput.type = 'password';
                eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>
                `;
            }
        }
    </script>
</body>

</html>
