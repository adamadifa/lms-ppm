@extends('layouts.app')

@section('title', 'Detail Quiz')
@section('subtitle', 'Kerjakan quiz untuk menguji pemahaman')

@section('content')
    <div class="p-4 sm:p-6">
        <!-- Header Section -->
        <div class="mb-4 sm:mb-6">
            <div class="flex items-center">
                <a href="{{ route('siswa.materi.show', $quiz->materi) }}" class="text-blue-600 hover:text-blue-800 mr-2">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>
                <h2 class="text-lg sm:text-xl lg:text-2xl font-bold text-gray-900">{{ $quiz->judul }}</h2>
            </div>
            <p class="text-sm sm:text-base text-gray-600 mt-1 text-center sm:text-left">Quiz dari {{ $quiz->guru->name }} •
                {{ $quiz->materi->judul }}</p>
        </div>

        <!-- Quiz Information -->
        <div class="bg-white rounded-lg shadow overflow-hidden mb-4 sm:mb-6">
            <div class="px-4 sm:px-6 py-3 sm:py-4 border-b border-gray-200 bg-gray-50">
                <h3 class="text-base sm:text-lg font-semibold text-gray-900 text-center sm:text-left">Informasi Quiz</h3>
            </div>
            <div class="p-4 sm:p-6">
                <div class="grid grid-cols-1 gap-4 sm:gap-6 mb-4 sm:mb-6">
                    <div class="bg-blue-50 p-3 sm:p-4 rounded-lg">
                        <div class="flex flex-col sm:flex-row sm:items-center text-center sm:text-left">
                            <div class="flex justify-center sm:justify-start items-center mb-2 sm:mb-0">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-blue-600 mr-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                    </path>
                                </svg>
                                <span class="text-xs sm:text-sm font-medium text-blue-900">Materi</span>
                            </div>
                            <div class="text-center sm:text-left">
                                <p class="text-xs sm:text-sm text-blue-700">{{ $quiz->materi->judul }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-green-50 p-3 sm:p-4 rounded-lg">
                        <div class="flex flex-col sm:flex-row sm:items-center text-center sm:text-left">
                            <div class="flex justify-center sm:justify-start items-center mb-2 sm:mb-0">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-green-600 mr-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="text-xs sm:text-sm font-medium text-green-900">Durasi</span>
                            </div>
                            <div class="text-center sm:text-left">
                                <p class="text-xs sm:text-sm text-green-700">{{ $quiz->durasi }} menit</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-purple-50 p-3 sm:p-4 rounded-lg">
                        <div class="flex flex-col sm:flex-row sm:items-center text-center sm:text-left">
                            <div class="flex justify-center sm:justify-start items-center mb-2 sm:mb-0">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-purple-600 mr-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                                <span class="text-xs sm:text-sm font-medium text-purple-900">Jumlah Soal</span>
                            </div>
                            <div class="text-center sm:text-left">
                                <p class="text-xs sm:text-sm text-purple-700">{{ $quiz->jumlah_soal }} soal</p>
                            </div>
                        </div>
                    </div>
                </div>

                @if ($quiz->deskripsi)
                    <div class="mb-4 sm:mb-6">
                        <h4 class="text-xs sm:text-sm font-medium text-gray-500 mb-2 text-center sm:text-left">Deskripsi
                        </h4>
                        <div class="bg-gray-50 p-3 sm:p-4 rounded-lg">
                            <p class="text-xs sm:text-sm text-gray-700 text-center sm:text-left">{{ $quiz->deskripsi }}</p>
                        </div>
                    </div>
                @endif

                @if ($quiz->waktu_mulai || $quiz->waktu_selesai)
                    <div class="mb-4 sm:mb-6">
                        <h4 class="text-xs sm:text-sm font-medium text-gray-500 mb-3 text-center sm:text-left">Jadwal Quiz
                        </h4>
                        <div class="grid grid-cols-1 gap-3 sm:gap-4">
                            @if ($quiz->waktu_mulai)
                                <div
                                    class="bg-blue-50 p-3 sm:p-4 rounded-lg border border-blue-200 text-center sm:text-left">
                                    <h5 class="text-xs font-medium text-blue-900 mb-1">Waktu Mulai</h5>
                                    <p class="text-xs sm:text-sm text-blue-800">
                                        {{ $quiz->waktu_mulai->format('d M Y H:i') }}</p>
                                </div>
                            @endif
                            @if ($quiz->waktu_selesai)
                                <div class="bg-red-50 p-3 sm:p-4 rounded-lg border border-red-200 text-center sm:text-left">
                                    <h5 class="text-xs font-medium text-red-900 mb-1">Waktu Selesai</h5>
                                    <p class="text-xs sm:text-sm text-red-800">
                                        {{ $quiz->waktu_selesai->format('d M Y H:i') }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                <div class="bg-yellow-50 p-3 sm:p-4 rounded-lg border border-yellow-200">
                    <div class="flex flex-col sm:flex-row sm:items-center text-center sm:text-left">
                        <div class="flex justify-center sm:justify-start items-center mb-2 sm:mb-0">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-yellow-600 mr-2" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="text-xs sm:text-sm font-medium text-yellow-900">Nilai Minimum Lulus</span>
                        </div>
                        <div class="text-center sm:text-left">
                            <p class="text-xs sm:text-sm text-yellow-800">{{ $quiz->passing_score }}%</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quiz Status -->
        @if ($hasil)
            <div class="bg-white rounded-lg shadow overflow-hidden mb-4 sm:mb-6">
                <div class="px-4 sm:px-6 py-3 sm:py-4 border-b border-gray-200 bg-green-50">
                    <h3 class="text-base sm:text-lg font-semibold text-green-900 text-center sm:text-left">Status Quiz</h3>
                </div>
                <div class="p-4 sm:p-6">
                    <div class="flex flex-col space-y-4 sm:space-y-0 sm:flex-row sm:items-center sm:justify-between">
                        <div class="flex flex-col sm:flex-row sm:items-center text-center sm:text-left">
                            <div class="flex justify-center sm:justify-start items-center mb-2 sm:mb-0">
                                <svg class="w-6 h-6 sm:w-8 sm:h-8 text-green-600 mr-2 sm:mr-3" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="text-center sm:text-left">
                                <p class="text-xs sm:text-sm font-medium text-green-900">Quiz sudah dikerjakan</p>
                                <p class="text-xs text-green-600">Dikerjakan pada:
                                    {{ $hasil->waktu_mulai->format('d M Y H:i') }}</p>
                            </div>
                        </div>
                        <div class="text-center sm:text-right">
                            <div class="text-xl sm:text-2xl font-bold text-green-600">{{ $hasil->nilai }}</div>
                            <div class="text-xs sm:text-sm text-green-600">
                                @if ($hasil->nilai >= $quiz->passing_score)
                                    <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">Lulus</span>
                                @else
                                    <span class="bg-red-100 text-red-800 px-2 py-1 rounded-full text-xs">Tidak Lulus</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <!-- Quiz Instructions -->
            <div class="bg-white rounded-lg shadow overflow-hidden mb-4 sm:mb-6">
                <div class="px-4 sm:px-6 py-3 sm:py-4 border-b border-gray-200 bg-blue-50">
                    <h3 class="text-base sm:text-lg font-semibold text-blue-900 text-center sm:text-left">Instruksi Quiz
                    </h3>
                </div>
                <div class="p-4 sm:p-6">
                    <div class="space-y-3 sm:space-y-4 text-xs sm:text-sm text-gray-700">
                        <div class="flex flex-col sm:flex-row sm:items-start text-center sm:text-left">
                            <div class="flex justify-center sm:justify-start items-start mb-2 sm:mb-0">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-blue-600 mr-2 mt-0.5" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <p class="text-center sm:text-left">Quiz terdiri dari <strong>{{ $quiz->jumlah_soal }}
                                    soal</strong> dengan durasi
                                <strong>{{ $quiz->durasi }} menit</strong>
                            </p>
                        </div>
                        <div class="flex flex-col sm:flex-row sm:items-start text-center sm:text-left">
                            <div class="flex justify-center sm:justify-start items-start mb-2 sm:mb-0">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-blue-600 mr-2 mt-0.5" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <p class="text-center sm:text-left">Nilai minimum untuk lulus adalah
                                <strong>{{ $quiz->passing_score }}%</strong>
                            </p>
                        </div>
                        <div class="flex flex-col sm:flex-row sm:items-start text-center sm:text-left">
                            <div class="flex justify-center sm:justify-start items-start mb-2 sm:mb-0">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-blue-600 mr-2 mt-0.5" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <p class="text-center sm:text-left">Pastikan Anda memiliki koneksi internet yang stabil sebelum
                                memulai quiz</p>
                        </div>
                        <div class="flex flex-col sm:flex-row sm:items-start text-center sm:text-left">
                            <div class="flex justify-center sm:justify-start items-start mb-2 sm:mb-0">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-blue-600 mr-2 mt-0.5" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <p class="text-center sm:text-left">Jangan refresh halaman atau menutup tab browser selama
                                mengerjakan quiz</p>
                        </div>
                    </div>

                    @if ($quiz->waktu_mulai && now()->isBefore($quiz->waktu_mulai))
                        <div class="mt-4 sm:mt-6 p-3 sm:p-4 bg-yellow-50 rounded-lg border border-yellow-200">
                            <div class="flex flex-col sm:flex-row sm:items-center text-center sm:text-left">
                                <div class="flex justify-center sm:justify-start items-center mb-2 sm:mb-0">
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-yellow-600 mr-2" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <span class="text-xs sm:text-sm text-yellow-800 text-center sm:text-left">Quiz belum
                                    dimulai. Silakan tunggu sampai waktu yang
                                    ditentukan.</span>
                            </div>
                            <!-- Debug info -->
                            <div class="mt-2 text-xs text-yellow-700 text-center sm:text-left">
                                Debug: Waktu sekarang: {{ now()->format('d M Y H:i:s') }} |
                                Waktu mulai: {{ $quiz->waktu_mulai->format('d M Y H:i:s') }} |
                                isBefore: {{ now()->isBefore($quiz->waktu_mulai) ? 'true' : 'false' }}
                            </div>
                        </div>
                    @elseif($quiz->waktu_selesai && now()->isAfter($quiz->waktu_selesai))
                        <div class="mt-4 sm:mt-6 p-3 sm:p-4 bg-red-50 rounded-lg border border-red-200">
                            <div class="flex flex-col sm:flex-row sm:items-center text-center sm:text-left">
                                <div class="flex justify-center sm:justify-start items-center mb-2 sm:mb-0">
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-red-600 mr-2" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <span class="text-xs sm:text-sm text-red-800 text-center sm:text-left">Quiz sudah selesai.
                                    Tidak dapat mengerjakan quiz ini.</span>
                            </div>
                            <!-- Debug info -->
                            <div class="mt-2 text-xs text-red-700 text-center sm:text-left">
                                Debug: Waktu sekarang: {{ now()->format('d M Y H:i:s') }} |
                                Waktu selesai: {{ $quiz->waktu_selesai->format('d M Y H:i:s') }} |
                                isAfter: {{ now()->isAfter($quiz->waktu_selesai) ? 'true' : 'false' }}
                            </div>
                        </div>
                    @else
                        @php
                            $soal = $quiz->soalQuiz()->orderBy('urutan')->get();
                        @endphp

                        @if ($soal->isEmpty())
                            <div class="mt-4 sm:mt-6 p-3 sm:p-4 bg-yellow-50 rounded-lg border border-yellow-200">
                                <div class="flex items-center text-center sm:text-left">
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-yellow-600 mr-2" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z">
                                        </path>
                                    </svg>
                                    <span class="text-xs sm:text-sm text-yellow-800">Quiz belum bisa dikerjakan karena
                                        belum memiliki soal.
                                        Silakan tunggu guru menambahkan soal.</span>
                                </div>
                            </div>
                        @else
                            <div class="mt-4 sm:mt-6 text-center">
                                <a href="{{ route('siswa.quiz.kerjakan', $quiz) }}"
                                    class="inline-flex items-center px-4 sm:px-6 py-2.5 sm:py-3 border border-transparent text-sm sm:text-base font-medium rounded-md text-white bg-purple-600 hover:bg-purple-700 transition-colors">
                                    <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                    Mulai Quiz
                                </a>
                                <!-- Debug info -->
                                <div class="mt-2 text-xs text-gray-600 text-center">
                                    Debug: Waktu sekarang: {{ now()->format('d M Y H:i:s') }} |
                                    Waktu mulai:
                                    {{ $quiz->waktu_mulai ? $quiz->waktu_mulai->format('d M Y H:i:s') : 'null' }} |
                                    Waktu selesai:
                                    {{ $quiz->waktu_selesai ? $quiz->waktu_selesai->format('d M Y H:i:s') : 'null' }}
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        @endif

        <!-- Navigation -->
        <div class="flex flex-col space-y-3 sm:space-y-0 sm:flex-row sm:justify-between sm:items-center">
            <a href="{{ route('siswa.materi.show', $quiz->materi) }}"
                class="text-blue-600 hover:text-blue-800 flex items-center justify-center sm:justify-start text-sm sm:text-base">
                <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Kembali ke Materi
            </a>

            <div class="flex justify-center sm:justify-end">
                <a href="{{ route('siswa.quiz.index') }}"
                    class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-md text-xs sm:text-sm font-medium transition-colors">
                    Lihat Semua Quiz
                </a>
            </div>
        </div>
    </div>
@endsection
