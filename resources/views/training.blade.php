@extends('layouts.app')

@section('title', 'Training')

@section('content')
    <div class="space-y-6">
        <!-- Header Section -->
        <div class="bg-gradient-to-r from-teal-600 to-teal-700 rounded-2xl p-8 text-white">
            <div class="flex items-center justify-between">
                <div class="max-w-md">
                    <h2 class="text-3xl font-bold mb-3">Training Programs</h2>
                    <p class="text-teal-100 mb-6 text-lg">
                        Enhance your skills with our comprehensive training programs designed for medical professionals.
                    </p>
                    <button class="bg-white text-teal-600 px-6 py-3 rounded-lg font-semibold hover:bg-teal-50 transition-colors duration-200">
                        Start Training >
                    </button>
                </div>
                <div class="hidden lg:block">
                    <div class="w-48 h-48 bg-teal-500 rounded-full flex items-center justify-center">
                        <svg class="w-24 h-24 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left Column - Training Programs -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Training Programs Header -->
                <div class="flex items-center justify-between">
                    <h3 class="text-xl font-semibold text-gray-900">Available Training Programs</h3>
                    <div class="flex gap-2">
                        <button
                            class="px-4 py-2 text-sm font-medium text-blue-600 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors duration-200">
                            All
                        </button>
                        <button class="px-4 py-2 text-sm font-medium text-gray-600 hover:text-blue-600 transition-colors duration-200">
                            Medical
                        </button>
                        <button class="px-4 py-2 text-sm font-medium text-gray-600 hover:text-blue-600 transition-colors duration-200">
                            Nursing
                        </button>
                    </div>
                </div>

                <!-- Training Programs Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Training Program 1 -->
                    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-200">
                        <div class="flex items-start justify-between mb-4">
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z">
                                    </path>
                                </svg>
                            </div>
                            <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">Active</span>
                        </div>
                        <h4 class="font-semibold text-gray-900 mb-2">Advanced Cardiac Life Support</h4>
                        <p class="text-sm text-gray-600 mb-4">Comprehensive training for healthcare providers in advanced cardiovascular life support
                            techniques.</p>
                        <div class="space-y-2 mb-4">
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-gray-500">Duration:</span>
                                <span class="text-gray-900">16 hours</span>
                            </div>
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-gray-500">Modules:</span>
                                <span class="text-gray-900">8</span>
                            </div>
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-gray-500">Certification:</span>
                                <span class="text-gray-900">ACLS</span>
                            </div>
                        </div>
                        <button class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition-colors duration-200">
                            Enroll Now
                        </button>
                    </div>

                    <!-- Training Program 2 -->
                    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-200">
                        <div class="flex items-start justify-between mb-4">
                            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                            </div>
                            <span class="px-3 py-1 bg-yellow-100 text-yellow-800 text-xs font-medium rounded-full">Coming Soon</span>
                        </div>
                        <h4 class="font-semibold text-gray-900 mb-2">Pediatric Advanced Life Support</h4>
                        <p class="text-sm text-gray-600 mb-4">Specialized training for healthcare providers working with pediatric patients in emergency
                            situations.</p>
                        <div class="space-y-2 mb-4">
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-gray-500">Duration:</span>
                                <span class="text-gray-900">14 hours</span>
                            </div>
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-gray-500">Modules:</span>
                                <span class="text-gray-900">6</span>
                            </div>
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-gray-500">Certification:</span>
                                <span class="text-gray-900">PALS</span>
                            </div>
                        </div>
                        <button class="w-full bg-gray-300 text-gray-500 py-2 px-4 rounded-lg cursor-not-allowed">
                            Coming Soon
                        </button>
                    </div>

                    <!-- Training Program 3 -->
                    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-200">
                        <div class="flex items-start justify-between mb-4">
                            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                    </path>
                                </svg>
                            </div>
                            <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">Active</span>
                        </div>
                        <h4 class="font-semibold text-gray-900 mb-2">Basic Life Support</h4>
                        <p class="text-sm text-gray-600 mb-4">Essential training for healthcare providers in basic life support and CPR techniques.</p>
                        <div class="space-y-2 mb-4">
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-gray-500">Duration:</span>
                                <span class="text-gray-900">4 hours</span>
                            </div>
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-gray-500">Modules:</span>
                                <span class="text-gray-900">3</span>
                            </div>
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-gray-500">Certification:</span>
                                <span class="text-gray-900">BLS</span>
                            </div>
                        </div>
                        <button class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition-colors duration-200">
                            Enroll Now
                        </button>
                    </div>

                    <!-- Training Program 4 -->
                    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-200">
                        <div class="flex items-start justify-between mb-4">
                            <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z">
                                    </path>
                                </svg>
                            </div>
                            <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">Active</span>
                        </div>
                        <h4 class="font-semibold text-gray-900 mb-2">Emergency Trauma Care</h4>
                        <p class="text-sm text-gray-600 mb-4">Comprehensive training in emergency trauma assessment and management for healthcare
                            providers.</p>
                        <div class="space-y-2 mb-4">
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-gray-500">Duration:</span>
                                <span class="text-gray-900">20 hours</span>
                            </div>
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-gray-500">Modules:</span>
                                <span class="text-gray-900">10</span>
                            </div>
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-gray-500">Certification:</span>
                                <span class="text-gray-900">ETC</span>
                            </div>
                        </div>
                        <button class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition-colors duration-200">
                            Enroll Now
                        </button>
                    </div>
                </div>
            </div>

            <!-- Right Column - Sidebar Cards -->
            <div class="space-y-6">
                <!-- My Progress Card -->
                <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">My Training Progress</h3>
                    <div class="space-y-4 mb-4">
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">ACLS Training</span>
                            <span class="text-sm font-medium text-gray-900">75%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-blue-600 h-2 rounded-full" style="width: 75%"></div>
                        </div>

                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">BLS Training</span>
                            <span class="text-sm font-medium text-gray-900">100%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-green-600 h-2 rounded-full" style="width: 100%"></div>
                        </div>

                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">ETC Training</span>
                            <span class="text-sm font-medium text-gray-900">45%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-blue-600 h-2 rounded-full" style="width: 45%"></div>
                        </div>
                    </div>
                    <button class="w-full text-blue-600 hover:text-blue-700 font-medium text-sm">View Details</button>
                </div>

                <!-- Upcoming Sessions Card -->
                <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Upcoming Sessions</h3>
                    <div class="space-y-3 mb-4">
                        <div class="flex items-center gap-3 p-3 bg-blue-50 rounded-lg">
                            <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-900">ACLS Module 3</p>
                                <p class="text-xs text-gray-500">Tomorrow, 2:00 PM</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-3 p-3 bg-purple-50 rounded-lg">
                            <div class="w-10 h-10 bg-purple-600 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-900">ETC Module 5</p>
                                <p class="text-xs text-gray-500">Friday, 10:00 AM</p>
                            </div>
                        </div>
                    </div>
                    <button class="w-full text-blue-600 hover:text-blue-700 font-medium text-sm">View All</button>
                </div>

                <!-- Quick Stats Card -->
                <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Stats</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="text-center">
                            <div class="text-2xl font-bold text-blue-600">3</div>
                            <div class="text-xs text-gray-500">Active Trainings</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-green-600">2</div>
                            <div class="text-xs text-gray-500">Completed</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-purple-600">15</div>
                            <div class="text-xs text-gray-500">Total Hours</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-orange-600">85%</div>
                            <div class="text-xs text-gray-500">Avg. Score</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
