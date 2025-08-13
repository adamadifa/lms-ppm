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

<body class="font-sans antialiased bg-gradient-to-br from-teal-800 to-teal-900 min-h-screen">
    <div class="min-h-screen flex items-center justify-center p-8">
        <!-- Main Container with Background -->
        <div class="w-full max-w-6xl bg-white rounded-3xl shadow-2xl overflow-hidden">
            <div class="flex">
                <!-- Left Panel - Form Login -->
                <div class="w-full lg:w-2/5 p-12 flex items-center justify-center">
                    <div class="w-full max-w-sm">
                        <!-- Logo -->
                        <div class="text-center mb-8">
                            <div class="flex items-center justify-center gap-2 text-2xl font-bold text-gray-900 mb-4">
                                <svg class="w-8 h-8 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
                                </svg>
                                LMS
                            </div>
                        </div>

                        <!-- Title -->
                        <div class="text-center mb-8">
                            <h1 class="text-2xl font-bold text-gray-900 mb-2">Welcome Back!</h1>
                            <p class="text-gray-600 text-sm">
                                Sign in to access your dashboard and continue optimizing your learning process.
                            </p>
                        </div>

                        <!-- Session Status -->
                        @if (session('status'))
                            <div class="mb-4 p-3 bg-green-50 border border-green-200 rounded-lg text-green-700 text-sm">
                                {{ session('status') }}
                            </div>
                        @endif

                        <!-- Login Form -->
                        <form method="POST" action="{{ route('login') }}" class="space-y-4">
                            @csrf

                            <!-- Email -->
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-400 text-lg">@</span>
                                </div>
                                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                                    autocomplete="username"
                                    class="w-full pl-10 pr-4 pt-6 pb-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 @error('email') border-red-500 @enderror peer"
                                    placeholder=" ">
                                <label for="email"
                                    class="absolute left-10 top-2 text-sm text-gray-500 transition-all duration-200 peer-focus:text-blue-500 peer-focus:text-xs peer-focus:-translate-y-1 peer-placeholder-shown:text-base peer-placeholder-shown:top-3 peer-placeholder-shown:text-gray-400">
                                    Email
                                </label>
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                        </path>
                                    </svg>
                                </div>
                                <input id="password" type="password" name="password" required autocomplete="current-password"
                                    class="w-full pl-10 pr-12 pt-6 pb-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 @error('password') border-red-500 @enderror peer"
                                    placeholder=" ">
                                <label for="password"
                                    class="absolute left-10 top-2 text-sm text-gray-500 transition-all duration-200 peer-focus:text-blue-500 peer-focus:text-xs peer-focus:-translate-y-1 peer-placeholder-shown:text-base peer-placeholder-shown:top-3 peer-placeholder-shown:text-gray-400">
                                    Password
                                </label>
                                <button type="button" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600"
                                    onclick="togglePassword()">
                                    <svg id="eye-icon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21">
                                        </path>
                                    </svg>
                                </button>
                                @error('password')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Forgot Password -->
                            <div class="flex justify-end">
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:text-blue-700">
                                        Forgot Password?
                                    </a>
                                @endif
                            </div>

                            <!-- Login Button -->
                            <button type="submit"
                                class="w-full bg-teal-700 text-white py-3 px-4 rounded-lg font-medium hover:bg-teal-800 focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 transition-colors duration-200 shadow-lg">
                                Sign In
                            </button>
                        </form>

                        <!-- Separator -->
                        <div class="my-6 flex items-center">
                            <div class="flex-1 border-t border-gray-300"></div>
                            <span class="px-4 text-sm text-gray-500">OR</span>
                            <div class="flex-1 border-t border-gray-300"></div>
                        </div>

                        <!-- Social Login Buttons -->
                        <div class="space-y-3">
                            <button
                                class="w-full flex items-center justify-center gap-3 px-4 py-3 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors duration-200 bg-white">
                                <svg class="w-5 h-5" viewBox="0 0 24 24">
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
                                class="w-full flex items-center justify-center gap-3 px-4 py-3 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors duration-200 bg-white">
                                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="M18.71 19.5c-.83 1.24-1.71 2.45-3.05 2.47-1.34.03-1.77-.79-3.29-.79-1.53 0-2 .77-3.27.82-1.31.05-2.3-1.32-3.14-2.53C4.25 17 2.94 12.45 4.7 9.39c.87-1.52 2.43-2.48 4.12-2.51 1.28-.02 2.5.87 3.29.87.78 0 2.26-1.07 3.81-.91.65.03 2.47.26 3.64 1.98-.09.06-2.17 1.28-2.15 3.81.03 3.02 2.65 4.03 2.68 4.04-.03.07-.42 1.44-1.38 2.83M13 3.5c.73-.83 1.94-1.46 2.94-1.5.13 1.17-.34 2.35-1.04 3.19-.69.85-1.83 1.51-2.95 1.42-.15-1.15.41-2.35 1.05-3.11z" />
                                </svg>
                                Continue with Apple
                            </button>
                        </div>

                        <!-- Sign Up Link -->
                        <div class="mt-6 text-center">
                            <p class="text-gray-600 text-sm">
                                Don't have an Account?
                                <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-700 font-medium">Sign Up</a>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Right Panel - Empty Background -->
                <div class="hidden lg:flex lg:w-3/5 bg-gradient-to-br from-teal-700 to-teal-800 relative">
                    <!-- Empty content - just background -->
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
