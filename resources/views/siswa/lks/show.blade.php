@extends('layouts.app')

@section('title', 'Detail LKPD')
@section('subtitle', 'Kerjakan Lembar Kerja Peserta Didik')

@section('content')
    <div class="p-4 sm:p-6">
        <!-- Header Section -->
        <div class="mb-4 sm:mb-6">
            <div class="flex items-center">
                <a href="{{ route('siswa.materi.show', $lks->materi) }}"
                    class="text-blue-600 hover:text-blue-800 mr-2 sm:mr-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>
                <h2 class="text-xl sm:text-2xl font-bold text-gray-900 truncate">{{ $lks->judul }}</h2>
            </div>
            <p class="text-gray-600 mt-1 text-sm sm:text-base">LKPD dari {{ $lks->guru->name }} • {{ $lks->materi->judul }}
            </p>
        </div>

        <!-- LKPD Information -->
        <div class="bg-white rounded-lg shadow overflow-hidden mb-4 sm:mb-6">
            <div class="px-4 sm:px-6 py-3 sm:py-4 border-b border-gray-200 bg-gray-50">
                <h3 class="text-base sm:text-lg font-semibold text-gray-900">Informasi LKPD</h3>
            </div>
            <div class="p-4 sm:p-6">
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
                                <p class="text-xs sm:text-sm font-medium text-blue-900">Materi</p>
                                <p class="text-xs sm:text-sm text-blue-700 truncate">{{ $lks->materi->judul }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-green-50 p-3 sm:p-4 rounded-lg">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-green-600 mr-2 sm:mr-3 flex-shrink-0" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div class="min-w-0 flex-1">
                                <p class="text-xs sm:text-sm font-medium text-green-900">Durasi</p>
                                <p class="text-xs sm:text-sm text-green-700">{{ $lks->durasi }} menit</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-purple-50 p-3 sm:p-4 rounded-lg sm:col-span-2 lg:col-span-1">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-purple-600 mr-2 sm:mr-3 flex-shrink-0" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                            <div class="min-w-0 flex-1">
                                <p class="text-xs sm:text-sm font-medium text-purple-900">Jumlah Soal</p>
                                <p class="text-xs sm:text-sm text-purple-700">{{ $lks->jumlah_soal }} soal</p>
                            </div>
                        </div>
                    </div>
                </div>

                @if ($lks->deadline)
                    <div class="mb-4 sm:mb-6">
                        <h4 class="text-xs sm:text-sm font-medium text-gray-500 mb-2">Deadline</h4>
                        <div class="bg-red-50 p-3 sm:p-4 rounded-lg border border-red-200">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-red-600 mr-2 sm:mr-3 flex-shrink-0" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <div class="min-w-0 flex-1">
                                    <p class="text-xs sm:text-sm font-medium text-red-900">Deadline:
                                        {{ $lks->deadline->format('d M Y H:i') }}</p>
                                    @if (now()->isAfter($lks->deadline))
                                        <p class="text-xs text-red-600 font-medium">Deadline sudah lewat!</p>
                                    @else
                                        <p class="text-xs text-red-600">Sisa waktu:
                                            {{ now()->diffForHumans($lks->deadline) }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if ($lks->deskripsi)
                    <div class="mb-4 sm:mb-6">
                        <h4 class="text-xs sm:text-sm font-medium text-gray-500 mb-2">Deskripsi</h4>
                        <div class="bg-gray-50 p-3 sm:p-4 rounded-lg">
                            <p class="text-sm sm:text-base text-gray-700">{{ $lks->deskripsi }}</p>
                        </div>
                    </div>
                @endif

                @if ($lks->instruksi)
                    <div class="mb-4 sm:mb-6">
                        <h4 class="text-xs sm:text-sm font-medium text-gray-500 mb-2">Instruksi</h4>
                        <div class="bg-blue-50 p-3 sm:p-4 rounded-lg border border-blue-200">
                            <p class="text-sm sm:text-base text-blue-900">{{ $lks->instruksi }}</p>
                        </div>
                    </div>
                @endif

                @if ($lks->file_path)
                    <div class="mb-4 sm:mb-6">
                        <h4 class="text-xs sm:text-sm font-medium text-gray-500 mb-2">File LKPD</h4>
                        <div class="bg-green-50 p-3 sm:p-4 rounded-lg border border-green-200">
                            <div
                                class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-3 sm:space-y-0">
                                <div class="flex items-center">
                                    <svg class="w-6 h-6 sm:w-8 sm:h-8 text-green-600 mr-2 sm:mr-3 flex-shrink-0"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                        </path>
                                    </svg>
                                    <div class="min-w-0 flex-1">
                                        <p class="text-xs sm:text-sm font-medium text-green-900">File tersedia untuk diunduh
                                        </p>
                                        <p class="text-xs text-green-600 truncate">{{ basename($lks->file_path) }}</p>
                                    </div>
                                </div>
                                <a href="{{ asset('storage/' . $lks->file_path) }}" target="_blank"
                                    class="bg-green-600 hover:bg-green-700 text-white px-3 sm:px-4 py-2 rounded-md text-xs sm:text-sm font-medium transition-colors text-center w-full sm:w-auto">
                                    Download
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Submission Status -->
        @if ($pengumpulan)
            <div class="bg-white rounded-lg shadow overflow-hidden mb-4 sm:mb-6">
                <div class="px-4 sm:px-6 py-3 sm:py-4 border-b border-gray-200 bg-green-50">
                    <h3 class="text-base sm:text-lg font-semibold text-green-900">Status Pengumpulan</h3>
                </div>
                <div class="p-4 sm:p-6">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4 space-y-3 sm:space-y-0">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 sm:w-8 sm:h-8 text-green-600 mr-2 sm:mr-3 flex-shrink-0" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div class="min-w-0 flex-1">
                                <p class="text-xs sm:text-sm font-medium text-green-900">LKPD sudah dikumpulkan</p>
                                <p class="text-xs text-green-600">Dikumpulkan pada:
                                    {{ $pengumpulan->waktu_pengumpulan->format('d M Y H:i') }}</p>
                            </div>
                        </div>
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full text-xs sm:text-sm font-medium bg-green-100 text-green-800 self-start sm:self-auto">
                            {{ $pengumpulan->status === 'dikumpul' ? 'Dikumpulkan' : ucfirst($pengumpulan->status) }}
                        </span>
                    </div>

                    <!-- Jawaban yang dikumpulkan -->
                    <div class="mb-4">
                        <h4 class="text-xs sm:text-sm font-medium text-gray-700 mb-2">Jawaban Anda:</h4>
                        <div class="bg-gray-50 p-3 sm:p-4 rounded-lg">
                            <p class="text-sm sm:text-base text-gray-700">{{ $pengumpulan->jawaban }}</p>
                        </div>
                    </div>

                    <!-- File jawaban yang diupload -->
                    @if ($pengumpulan->file_jawaban)
                        <div class="mb-4">
                            <h4 class="text-xs sm:text-sm font-medium text-gray-700 mb-2">File Jawaban:</h4>
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
                                            <p class="text-xs sm:text-sm font-medium text-blue-900">File tersedia untuk
                                                diunduh</p>
                                            <p class="text-xs text-blue-600 truncate">
                                                {{ basename($pengumpulan->file_jawaban) }}</p>
                                        </div>
                                    </div>
                                    <a href="{{ asset('storage/' . $pengumpulan->file_jawaban) }}" target="_blank"
                                        class="bg-blue-600 hover:bg-blue-700 text-white px-3 sm:px-4 py-2 rounded-md text-xs sm:text-sm font-medium transition-colors text-center w-full sm:w-auto">
                                        Download
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @else
            <!-- Submit Form -->
            <div class="bg-white rounded-lg shadow overflow-hidden mb-4 sm:mb-6">
                <div class="px-4 sm:px-6 py-3 sm:py-4 border-b border-gray-200 bg-blue-50">
                    <h3 class="text-base sm:text-lg font-semibold text-blue-900">Kerjakan LKPD</h3>
                </div>
                <div class="p-4 sm:p-6">
                    @if ($lks->deadline && now()->isAfter($lks->deadline))
                        <div class="text-center py-6 sm:py-8">
                            <svg class="mx-auto h-8 w-8 sm:h-12 sm:w-12 text-red-400" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <h3 class="mt-2 text-sm sm:text-base font-medium text-red-900">Deadline Sudah Lewat</h3>
                            <p class="mt-1 text-xs sm:text-sm text-red-500">Tidak dapat mengumpulkan LKPD setelah deadline.
                            </p>
                        </div>
                    @else
                        <form action="{{ route('siswa.lks.submit', $lks) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="mb-4">
                                <label for="jawaban" class="block text-xs sm:text-sm font-medium text-gray-700 mb-2">
                                    Jawaban <span class="text-red-500">*</span>
                                </label>
                                <textarea name="jawaban" id="jawaban" rows="4" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm sm:text-base"
                                    placeholder="Tulis jawaban Anda untuk LKPD ini..."></textarea>
                                <p class="mt-1 text-xs sm:text-sm text-gray-500">Jawab sesuai dengan instruksi yang
                                    diberikan.</p>
                            </div>

                            <div class="mb-6">
                                <label for="file_jawaban" class="block text-xs sm:text-sm font-medium text-gray-700 mb-2">
                                    File Jawaban (Opsional)
                                </label>
                                <input type="file" name="file_jawaban" id="file_jawaban" accept=".pdf,.doc,.docx"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm sm:text-base">
                                <p class="mt-1 text-xs sm:text-sm text-gray-500">Upload file jawaban dalam format PDF, DOC,
                                    atau DOCX
                                    (max 10MB)</p>
                            </div>

                            <div class="flex justify-center sm:justify-end">
                                <button type="submit"
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 sm:px-6 py-2 rounded-md text-xs sm:text-sm font-medium transition-colors w-full sm:w-auto">
                                    Kumpulkan LKPD
                                </button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        @endif

        <!-- Navigation -->
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center space-y-4 sm:space-y-0">
            <a href="{{ route('siswa.materi.show', $lks->materi) }}"
                class="text-blue-600 hover:text-blue-800 flex items-center justify-center sm:justify-start">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Kembali ke Materi
            </a>

            <div class="flex justify-center sm:justify-end">
                <a href="{{ route('siswa.lks.index') }}"
                    class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md text-xs sm:text-sm font-medium transition-colors text-center w-full sm:w-auto">
                    Lihat Semua LKPD
                </a>
            </div>
        </div>
    </div>
@endsection
