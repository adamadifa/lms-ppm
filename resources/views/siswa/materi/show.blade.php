@extends('layouts.app')

@section('title', 'Detail Materi')
@section('subtitle', 'Pelajari materi pembelajaran')

@section('content')
    <div class="p-4 sm:p-6">
        <!-- Header Section -->
        <div class="mb-4 sm:mb-6">
            <div class="flex items-center">
                <a href="{{ route('siswa.materi.index') }}" class="text-blue-600 hover:text-blue-800 mr-2 sm:mr-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>
                <h2 class="text-xl sm:text-2xl font-bold text-gray-900">{{ $materi->judul }}</h2>
            </div>
            <p class="text-gray-600 mt-1 text-sm sm:text-base">Materi pembelajaran dari {{ $materi->guru->name }}</p>
        </div>

        <!-- Materi Information -->
        <div class="bg-white rounded-lg shadow overflow-hidden mb-4 sm:mb-6">
            <!-- Header -->
            <div class="px-4 sm:px-6 py-3 sm:py-4 border-b border-gray-200 bg-gray-50">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-3 sm:space-y-0">
                    <div class="flex items-center space-x-3 sm:space-x-4">
                        <div class="p-2 sm:p-3 rounded-full bg-blue-100 text-blue-600 flex-shrink-0">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                </path>
                            </svg>
                        </div>
                        <div class="min-w-0 flex-1">
                            <h3 class="text-base sm:text-lg font-semibold text-gray-900 truncate">{{ $materi->judul }}</h3>
                            <p class="text-xs sm:text-sm text-gray-600 truncate">{{ $materi->mataPelajaran->nama }} •
                                {{ $materi->kelas->nama }}</p>
                        </div>
                    </div>
                    <div class="flex flex-col sm:flex-row items-start sm:items-center space-y-2 sm:space-y-0 sm:space-x-3">
                        <span
                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            {{ ucfirst($materi->status) }}
                        </span>
                        @if ($materi->file_path)
                            <a href="{{ asset('storage/' . $materi->file_path) }}" target="_blank"
                                class="bg-green-600 hover:bg-green-700 text-white px-3 py-2 rounded-md text-xs sm:text-sm font-medium transition-colors flex items-center justify-center w-full sm:w-auto">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                                Download File
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="px-4 sm:px-6 py-4">
                <!-- Materi Details -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-6 mb-4 sm:mb-6">
                    <div class="bg-blue-50 p-3 sm:p-4 rounded-lg">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-blue-600 mr-2 sm:mr-3 flex-shrink-0" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                </path>
                            </svg>
                            <div class="min-w-0 flex-1">
                                <p class="text-xs sm:text-sm font-medium text-blue-900">Mata Pelajaran</p>
                                <p class="text-xs sm:text-sm text-blue-700 truncate">{{ $materi->mataPelajaran->nama }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-green-50 p-3 sm:p-4 rounded-lg">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-green-600 mr-2 sm:mr-3 flex-shrink-0" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                </path>
                            </svg>
                            <div class="min-w-0 flex-1">
                                <p class="text-xs sm:text-sm font-medium text-green-900">Kelas</p>
                                <p class="text-xs sm:text-sm text-green-700 truncate">{{ $materi->kelas->nama }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-purple-50 p-3 sm:p-4 rounded-lg sm:col-span-2 lg:col-span-1">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-purple-600 mr-2 sm:mr-3 flex-shrink-0" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                            <div class="min-w-0 flex-1">
                                <p class="text-xs sm:text-sm font-medium text-purple-900">Urutan</p>
                                <p class="text-xs sm:text-sm text-purple-700">{{ $materi->urutan }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Deskripsi -->
                @if ($materi->deskripsi)
                    <div class="mb-4 sm:mb-6">
                        <h4 class="text-base sm:text-lg font-medium text-gray-900 mb-2 sm:mb-3">Deskripsi</h4>
                        <div class="bg-gray-50 p-3 sm:p-4 rounded-lg">
                            <p class="text-sm sm:text-base text-gray-700">{{ $materi->deskripsi }}</p>
                        </div>
                    </div>
                @endif

                <!-- Konten Materi -->
                <div class="mb-4 sm:mb-6">
                    <h4 class="text-base sm:text-lg font-medium text-gray-900 mb-2 sm:mb-3">Konten Materi</h4>
                    <div class="bg-gray-50 p-3 sm:p-4 rounded-lg">
                        <div class="prose max-w-none text-sm sm:text-base">
                            {!! nl2br(e($materi->konten)) !!}
                        </div>
                    </div>
                </div>

                <!-- File Information -->
                @if ($materi->file_path)
                    <div class="mb-4 sm:mb-6">
                        <h4 class="text-base sm:text-lg font-medium text-gray-900 mb-2 sm:mb-3">File Pendukung</h4>
                        <div class="bg-blue-50 p-3 sm:p-4 rounded-lg border border-blue-200">
                            <div
                                class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-3 sm:space-y-0">
                                <div class="flex items-center">
                                    <svg class="w-6 h-6 sm:w-8 sm:h-8 text-blue-600 mr-2 sm:mr-3 flex-shrink-0"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                        </path>
                                    </svg>
                                    <div class="min-w-0 flex-1">
                                        <p class="text-xs sm:text-sm font-medium text-blue-900">File tersedia untuk diunduh
                                        </p>
                                        <p class="text-xs text-blue-600 truncate">{{ basename($materi->file_path) }}</p>
                                    </div>
                                </div>
                                <a href="{{ asset('storage/' . $materi->file_path) }}" target="_blank"
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-3 sm:px-4 py-2 rounded-md text-xs sm:text-sm font-medium transition-colors text-center">
                                    Download
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Daftar LKPD -->
        @if ($lkpd->count() > 0)
            <div class="bg-white rounded-lg shadow overflow-hidden mb-4 sm:mb-6">
                <div class="px-4 sm:px-6 py-3 sm:py-4 border-b border-gray-200 bg-gray-50">
                    <h3 class="text-base sm:text-lg font-semibold text-gray-900">LKPD Tersedia ({{ $lkpd->count() }})</h3>
                    <p class="text-xs sm:text-sm text-gray-600 mt-1">Daftar Lembar Kerja Peserta Didik yang dapat
                        dikerjakan</p>
                </div>
                <div class="p-4 sm:p-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-4">
                        @foreach ($lkpd as $l)
                            <div class="border border-gray-200 rounded-lg p-3 sm:p-4 hover:bg-gray-50 transition-colors">
                                <div
                                    class="flex flex-col space-y-3 sm:space-y-0 sm:items-start sm:justify-between sm:mb-3">
                                    <div class="flex-1 min-w-0">
                                        <h4 class="text-base sm:text-lg font-medium text-gray-900 mb-2 truncate">
                                            {{ $l->judul }}</h4>
                                        <p class="text-xs sm:text-sm text-gray-600 mb-3 line-clamp-2">
                                            {{ Str::limit($l->deskripsi, 100) }}</p>

                                        <div
                                            class="flex flex-wrap items-center gap-2 sm:gap-4 text-xs sm:text-sm text-gray-500 mb-3">
                                            <span class="flex items-center">
                                                <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-1" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                {{ $l->durasi }} menit
                                            </span>
                                            <span class="flex items-center">
                                                <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-1" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                    </path>
                                                </svg>
                                                {{ $l->jumlah_soal }} soal
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div
                                    class="flex flex-col sm:flex-row sm:justify-between sm:items-center space-y-2 sm:space-y-0">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 self-start sm:self-auto">
                                        {{ ucfirst($l->status) }}
                                    </span>
                                    <a href="{{ route('siswa.lks.show', $l->id) }}"
                                        class="bg-green-600 hover:bg-green-700 text-white px-3 sm:px-4 py-2 rounded-md text-xs sm:text-sm font-medium transition-colors text-center">
                                        Kerjakan LKPD
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        <!-- Pesan jika tidak ada LKPD -->
        @if ($lkpd->count() == 0)
            <div class="bg-white rounded-lg shadow overflow-hidden mb-4 sm:mb-6">
                <div class="px-4 sm:px-6 py-6 sm:py-8 text-center">
                    <svg class="mx-auto h-8 w-8 sm:h-12 sm:w-12 text-gray-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                    <h3 class="mt-2 text-sm sm:text-base font-medium text-gray-900">Belum ada LKPD</h3>
                    <p class="mt-1 text-xs sm:text-sm text-gray-500">Guru belum membuat Lembar Kerja Peserta Didik untuk
                        materi ini.</p>
                </div>
            </div>
        @endif

        <!-- Daftar Video Materi -->
        @if ($video->count() > 0)
            <div class="bg-white rounded-lg shadow overflow-hidden mb-4 sm:mb-6">
                <div class="px-4 sm:px-6 py-3 sm:py-4 border-b border-gray-200 bg-gray-50">
                    <h3 class="text-base sm:text-lg font-semibold text-gray-900">Video Materi ({{ $video->count() }})</h3>
                    <p class="text-xs sm:text-sm text-gray-600 mt-1">Video pembelajaran yang dapat ditonton untuk memahami
                        materi</p>
                </div>
                <div class="p-4 sm:p-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
                        @foreach ($video as $v)
                            <div
                                class="border border-gray-200 rounded-lg overflow-hidden hover:shadow-lg transition-shadow">
                                <!-- Video Thumbnail -->
                                <div class="relative">
                                    <img src="{{ $v->thumbnail_url }}" alt="{{ $v->judul }}"
                                        class="w-full h-32 sm:h-48 object-cover">
                                    <div class="absolute inset-0 bg-black bg-opacity-20 flex items-center justify-center">
                                        <div class="bg-red-600 rounded-full p-2 sm:p-3">
                                            <svg class="w-4 h-4 sm:w-6 sm:h-6 text-white" fill="currentColor"
                                                viewBox="0 0 24 24">
                                                <path d="M8 5v14l11-7z" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>

                                <!-- Video Info -->
                                <div class="p-3 sm:p-4">
                                    <h4 class="text-base sm:text-lg font-medium text-gray-900 mb-2 truncate">
                                        {{ $v->judul }}</h4>
                                    @if ($v->deskripsi)
                                        <p class="text-xs sm:text-sm text-gray-600 mb-3 line-clamp-2">
                                            {{ Str::limit($v->deskripsi, 100) }}</p>
                                    @endif

                                    <div
                                        class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-2 sm:space-y-0">
                                        <span class="text-xs text-gray-500">Urutan: {{ $v->urutan }}</span>
                                        <button onclick="playVideo('{{ $v->embed_url }}', '{{ $v->judul }}')"
                                            class="bg-red-600 hover:bg-red-700 text-white px-3 sm:px-4 py-2 rounded-md text-xs sm:text-sm font-medium transition-colors text-center w-full sm:w-auto">
                                            Tonton Video
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        <!-- Pesan jika tidak ada Video -->
        @if ($video->count() == 0)
            <div class="bg-white rounded-lg shadow overflow-hidden mb-4 sm:mb-6">
                <div class="px-4 sm:px-6 py-6 sm:py-8 text-center">
                    <svg class="mx-auto h-8 w-8 sm:h-12 sm:w-12 text-gray-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z">
                        </path>
                    </svg>
                    <h3 class="mt-2 text-sm sm:text-base font-medium text-gray-900">Belum ada Video</h3>
                    <p class="mt-1 text-xs sm:text-sm text-gray-500">Guru belum membuat video pembelajaran untuk materi
                        ini.</p>
                </div>
            </div>
        @endif

        <!-- Daftar Quiz -->
        @if ($quiz->count() > 0)
            <div class="bg-white rounded-lg shadow overflow-hidden mb-4 sm:mb-6">
                <div class="px-4 sm:px-6 py-3 sm:py-4 border-b border-gray-200 bg-gray-50">
                    <h3 class="text-base sm:text-lg font-semibold text-gray-900">Quiz Tersedia ({{ $quiz->count() }})</h3>
                    <p class="text-xs sm:text-sm text-gray-600 mt-1">Daftar quiz yang dapat dikerjakan untuk menguji
                        pemahaman</p>
                </div>
                <div class="p-4 sm:p-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-4">
                        @foreach ($quiz as $q)
                            <div class="border border-gray-200 rounded-lg p-3 sm:p-4 hover:bg-gray-50 transition-colors">
                                <div
                                    class="flex flex-col space-y-3 sm:space-y-0 sm:items-start sm:justify-between sm:mb-3">
                                    <div class="flex-1 min-w-0">
                                        <h4 class="text-base sm:text-lg font-medium text-gray-900 mb-2 truncate">
                                            {{ $q->judul }}</h4>
                                        @if ($q->deskripsi)
                                            <p class="text-xs sm:text-sm text-gray-600 mb-3 line-clamp-2">
                                                {{ Str::limit($q->deskripsi, 100) }}</p>
                                        @endif

                                        <div
                                            class="flex flex-wrap items-center gap-2 sm:gap-4 text-xs sm:text-sm text-gray-500 mb-3">
                                            <span class="flex items-center">
                                                <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-1" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                {{ $q->durasi }} menit
                                            </span>
                                            <span class="flex items-center">
                                                <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-1" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                    </path>
                                                </svg>
                                                {{ $q->jumlah_soal }} soal
                                            </span>
                                            <span class="flex items-center">
                                                <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-1" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 9l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                {{ $q->passing_score }}%
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div
                                    class="flex flex-col sm:flex-row sm:justify-between sm:items-center space-y-2 sm:space-y-0">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800 self-start sm:self-auto">
                                        {{ ucfirst($q->status) }}
                                    </span>
                                    <a href="{{ route('siswa.quiz.show', $q) }}"
                                        class="bg-purple-600 hover:bg-purple-700 text-white px-3 sm:px-4 py-2 rounded-md text-xs sm:text-sm font-medium transition-colors text-center">
                                        Mulai Quiz
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        <!-- Pesan jika tidak ada Quiz -->
        @if ($quiz->count() == 0)
            <div class="bg-white rounded-lg shadow overflow-hidden mb-4 sm:mb-6">
                <div class="px-4 sm:px-6 py-6 sm:py-8 text-center">
                    <svg class="mx-auto h-8 w-8 sm:h-12 sm:w-12 text-gray-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                        </path>
                    </svg>
                    <h3 class="mt-2 text-sm sm:text-base font-medium text-gray-900">Belum ada Quiz</h3>
                    <p class="mt-1 text-xs sm:text-sm text-gray-500">Guru belum membuat quiz untuk materi ini.</p>
                </div>
            </div>
        @endif

        <!-- Navigation -->
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center space-y-4 sm:space-y-0">
            <a href="{{ route('siswa.materi.index') }}"
                class="text-blue-600 hover:text-blue-800 flex items-center justify-center sm:justify-start">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Kembali ke Daftar Materi
            </a>

            <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-3">
                @if ($lkpd->count() > 0)
                    <a href="{{ route('siswa.lks.index') }}"
                        class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md text-xs sm:text-sm font-medium transition-colors text-center">
                        Lihat Semua LKPD
                    </a>
                @endif
                @if ($video->count() > 0)
                    <a href="{{ route('guru.materi.videos', $materi) }}"
                        class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md text-xs sm:text-sm font-medium transition-colors text-center">
                        Lihat Semua Video
                    </a>
                @endif
                @if ($quiz->count() > 0)
                    <a href="{{ route('siswa.quiz.index') }}"
                        class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-md text-xs sm:text-sm font-medium transition-colors text-center">
                        Lihat Semua Quiz
                    </a>
                @endif
            </div>
        </div>
    </div>

    <!-- Video Modal -->
    <div id="videoModal"
        class="fixed inset-0 bg-black bg-opacity-75 hidden z-50 flex items-center justify-center p-2 sm:p-4">
        <div class="bg-white rounded-lg w-full max-w-4xl max-h-full overflow-hidden">
            <div class="flex items-center justify-between p-3 sm:p-4 border-b border-gray-200">
                <h3 id="videoTitle" class="text-base sm:text-lg font-semibold text-gray-900 truncate flex-1 mr-2"></h3>
                <button onclick="closeVideo()" class="text-gray-400 hover:text-gray-600 flex-shrink-0">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>
            <div class="p-2 sm:p-4">
                <div class="relative" style="padding-bottom: 56.25%;">
                    <iframe id="videoFrame" class="absolute inset-0 w-full h-full rounded" frameborder="0"
                        allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>

    <script>
        function playVideo(embedUrl, title) {
            document.getElementById('videoTitle').textContent = title;
            document.getElementById('videoFrame').src = embedUrl;
            document.getElementById('videoModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeVideo() {
            document.getElementById('videoModal').classList.add('hidden');
            document.getElementById('videoFrame').src = '';
            document.body.style.overflow = 'auto';
        }

        // Close modal when clicking outside
        document.getElementById('videoModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeVideo();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeVideo();
            }
        });
    </script>
@endsection
