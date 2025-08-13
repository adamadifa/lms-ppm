@extends('layouts.app')

@section('title', 'Daftar Quiz')
@section('subtitle', 'Quiz yang tersedia untuk dikerjakan')

@section('content')
    <div class="p-4 sm:p-6">
        <!-- Header Section -->
        <div class="mb-4 sm:mb-6">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-3 sm:space-y-0">
                <div>
                    <h2 class="text-xl sm:text-2xl font-bold text-gray-900">Daftar Quiz</h2>
                    <p class="text-gray-600 mt-1 text-sm sm:text-base">Quiz yang tersedia untuk menguji pemahaman Anda</p>
                    <!-- Waktu Sekarang -->
                    <div class="mt-2 p-2 sm:p-3 bg-green-50 rounded-lg border border-green-200 inline-block">
                        <div class="flex items-center text-xs sm:text-sm text-green-800">
                            <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="font-medium">Waktu:</span>
                            <span class="ml-1 sm:ml-2 font-bold text-xs sm:text-sm">{{ now()->format('d M Y') }}</span>
                        </div>
                        <div class="flex items-center text-xs sm:text-sm text-green-800 mt-1">
                            <span class="font-medium">Sekarang:</span>
                            <span class="ml-1 sm:ml-2 font-bold">{{ now()->format('H:i:s') }}</span>
                        </div>
                    </div>
                </div>
                <a href="{{ route('siswa.materi.index') }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-xs sm:text-sm font-medium transition-colors text-center w-full sm:w-auto">
                    Lihat Materi
                </a>
            </div>
        </div>

        <!-- Quiz List -->
        @if ($quiz->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
                @foreach ($quiz as $q)
                    <div class="bg-white rounded-lg shadow overflow-hidden hover:shadow-lg transition-shadow">
                        <div class="p-4 sm:p-6">
                            <div class="flex items-start justify-between mb-3 sm:mb-4">
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-base sm:text-lg font-medium text-gray-900 mb-2 truncate">
                                        {{ $q->judul }}</h3>
                                    @if ($q->deskripsi)
                                        <p class="text-xs sm:text-sm text-gray-600 mb-3 line-clamp-2">
                                            {{ Str::limit($q->deskripsi, 100) }}</p>
                                    @endif

                                    <div class="space-y-2 text-xs sm:text-sm text-gray-500">
                                        <div class="flex items-center">
                                            <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-2 sm:mr-3 flex-shrink-0" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                                </path>
                                            </svg>
                                            <span class="truncate">{{ $q->materi->judul }}</span>
                                        </div>
                                        <div class="flex items-center">
                                            <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-2 sm:mr-3 flex-shrink-0" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                                </path>
                                            </svg>
                                            <span class="truncate">{{ $q->kelas->nama }}</span>
                                        </div>
                                        <div class="flex items-center">
                                            <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-2 sm:mr-3 flex-shrink-0" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            {{ $q->durasi }} menit
                                        </div>
                                        <div class="flex items-center">
                                            <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-2 sm:mr-3 flex-shrink-0" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                </path>
                                            </svg>
                                            {{ $q->jumlah_soal }} soal
                                        </div>
                                        <div class="flex items-center">
                                            <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-2 sm:mr-3 flex-shrink-0" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            {{ $q->passing_score }}% (Nilai Minimum)
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if ($q->waktu_mulai || $q->waktu_selesai)
                                <div class="mb-3 sm:mb-4 p-2 sm:p-3 bg-blue-50 rounded-lg border border-blue-200">
                                    <div class="text-xs sm:text-sm text-blue-800">
                                        @if ($q->waktu_mulai && $q->waktu_selesai)
                                            <div class="flex items-center mb-1">
                                                <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-2 flex-shrink-0" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                <span class="truncate">Jadwal: {{ $q->waktu_mulai->format('d M Y H:i') }} -
                                                    {{ $q->waktu_selesai->format('d M Y H:i') }}</span>
                                            </div>
                                            @if (now()->isBefore($q->waktu_mulai))
                                                <p class="text-xs text-blue-600 font-medium">Quiz belum dimulai</p>
                                            @elseif(now()->isAfter($q->waktu_selesai))
                                                <p class="text-xs text-red-600 font-medium">Quiz sudah selesai</p>
                                            @else
                                                <p class="text-xs text-green-600 font-medium">Quiz sedang berlangsung</p>
                                            @endif
                                        @elseif($q->waktu_mulai)
                                            <div class="flex items-center mb-1">
                                                <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-2 flex-shrink-0" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                <span>Mulai: {{ $q->waktu_mulai->format('d M Y H:i') }}</span>
                                            </div>
                                            @if (now()->isBefore($q->waktu_mulai))
                                                <p class="text-xs text-blue-600 font-medium">Quiz belum dimulai</p>
                                            @else
                                                <p class="text-xs text-green-600 font-medium">Quiz sudah dimulai</p>
                                            @endif
                                        @elseif($q->waktu_selesai)
                                            <div class="flex items-center mb-1">
                                                <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-2 flex-shrink-0" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                <span>Selesai: {{ $q->waktu_selesai->format('d M Y H:i') }}</span>
                                            </div>
                                            @if (now()->isAfter($q->waktu_selesai))
                                                <p class="text-xs text-red-600 font-medium">Quiz sudah selesai</p>
                                            @else
                                                <p class="text-xs text-green-600 font-medium">Quiz masih berlangsung</p>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            @endif

                            <div
                                class="flex flex-col sm:flex-row sm:justify-between sm:items-center space-y-2 sm:space-y-0 mb-3 sm:mb-4">
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800 self-start sm:self-auto">
                                    {{ ucfirst($q->status) }}
                                </span>

                                @php
                                    $hasil = \App\Models\HasilQuiz::where('quiz_id', $q->id)
                                        ->where('siswa_id', auth()->id())
                                        ->first();
                                @endphp

                                @if ($hasil)
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        Sudah Dikerjakan
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        Belum Dikerjakan
                                    </span>
                                @endif
                            </div>

                            <div class="mt-3 sm:mt-4">
                                @if ($hasil)
                                    <a href="{{ route('siswa.quiz.show', $q) }}"
                                        class="w-full bg-blue-600 hover:bg-blue-700 text-white px-3 sm:px-4 py-2 rounded-md text-xs sm:text-sm font-medium transition-colors text-center block">
                                        Lihat Hasil
                                    </a>
                                @else
                                    @php
                                        $soal = $q->soalQuiz()->orderBy('urutan')->get();
                                    @endphp

                                    @if ($q->waktu_mulai && now()->isBefore($q->waktu_mulai))
                                        <button disabled
                                            class="w-full bg-gray-400 text-white px-3 sm:px-4 py-2 rounded-md text-xs sm:text-sm font-medium cursor-not-allowed">
                                            Quiz Belum Dimulai
                                        </button>
                                    @elseif($q->waktu_selesai && now()->isAfter($q->waktu_selesai))
                                        <button disabled
                                            class="w-full bg-gray-400 text-white px-3 sm:px-4 py-2 rounded-md text-xs sm:text-sm font-medium cursor-not-allowed">
                                            Quiz Sudah Selesai
                                        </button>
                                    @elseif($soal->isEmpty())
                                        <button disabled
                                            class="w-full bg-yellow-400 text-white px-3 sm:px-4 py-2 rounded-md text-xs sm:text-sm font-medium cursor-not-allowed">
                                            Belum Ada Soal
                                        </button>
                                    @else
                                        <a href="{{ route('siswa.quiz.kerjakan', $q) }}"
                                            class="w-full bg-purple-600 hover:bg-purple-700 text-white px-3 sm:px-4 py-2 rounded-md text-xs sm:text-sm font-medium transition-colors text-center block">
                                            Mulai Quiz
                                        </a>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if ($quiz->hasPages())
                <div class="mt-4 sm:mt-6">
                    {{ $quiz->links() }}
                </div>
            @endif
        @else
            <div class="bg-white rounded-lg shadow p-6 sm:p-8 text-center">
                <svg class="mx-auto h-8 w-8 sm:h-12 sm:w-12 text-gray-400" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                    </path>
                </svg>
                <h3 class="mt-2 text-sm sm:text-base font-medium text-gray-900">Tidak ada Quiz</h3>
                <p class="mt-1 text-xs sm:text-sm text-gray-500">Belum ada quiz yang tersedia untuk Anda.</p>
                <div class="mt-4 sm:mt-6">
                    <a href="{{ route('siswa.materi.index') }}"
                        class="inline-flex items-center px-3 sm:px-4 py-2 border border-transparent shadow-sm text-xs sm:text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                        Lihat Materi
                    </a>
                </div>
            </div>
        @endif
    </div>
@endsection
