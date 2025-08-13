@extends('layouts.app')

@section('title', 'Detail Materi')
@section('subtitle', 'Pelajari materi pembelajaran')

@section('content')
    <div class="p-6">
        <!-- Header Section -->
        <div class="mb-6">
            <div class="flex items-center">
                <a href="{{ route('siswa.materi.index') }}" class="text-blue-600 hover:text-blue-800 mr-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>
                <h2 class="text-2xl font-bold text-gray-900">{{ $materi->judul }}</h2>
            </div>
            <p class="text-gray-600 mt-1">Materi pembelajaran dari {{ $materi->guru->name }}</p>
        </div>

        <!-- Materi Information -->
        <div class="bg-white rounded-lg shadow overflow-hidden mb-6">
            <!-- Header -->
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">{{ $materi->judul }}</h3>
                            <p class="text-sm text-gray-600">{{ $materi->mataPelajaran->nama }} • {{ $materi->kelas->nama }}</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            {{ ucfirst($materi->status) }}
                        </span>
                        @if ($materi->file_path)
                            <a href="{{ asset('storage/' . $materi->file_path) }}" target="_blank"
                                class="bg-green-600 hover:bg-green-700 text-white px-3 py-2 rounded-md text-sm font-medium transition-colors flex items-center">
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
            <div class="px-6 py-4">
                <!-- Materi Details -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <div class="bg-blue-50 p-4 rounded-lg">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                </path>
                            </svg>
                            <div>
                                <p class="text-sm font-medium text-blue-900">Mata Pelajaran</p>
                                <p class="text-sm text-blue-700">{{ $materi->mataPelajaran->nama }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-green-50 p-4 rounded-lg">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                </path>
                            </svg>
                            <div>
                                <p class="text-sm font-medium text-green-900">Kelas</p>
                                <p class="text-sm text-green-700">{{ $materi->kelas->nama }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-purple-50 p-4 rounded-lg">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-purple-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                            <div>
                                <p class="text-sm font-medium text-purple-900">Urutan</p>
                                <p class="text-sm text-purple-700">{{ $materi->urutan }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Deskripsi -->
                @if ($materi->deskripsi)
                    <div class="mb-6">
                        <h4 class="text-lg font-medium text-gray-900 mb-3">Deskripsi</h4>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-gray-700">{{ $materi->deskripsi }}</p>
                        </div>
                    </div>
                @endif

                <!-- Konten Materi -->
                <div class="mb-6">
                    <h4 class="text-lg font-medium text-gray-900 mb-3">Konten Materi</h4>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <div class="prose max-w-none">
                            {!! nl2br(e($materi->konten)) !!}
                        </div>
                    </div>
                </div>

                <!-- File Information -->
                @if ($materi->file_path)
                    <div class="mb-6">
                        <h4 class="text-lg font-medium text-gray-900 mb-3">File Pendukung</h4>
                        <div class="bg-blue-50 p-4 rounded-lg border border-blue-200">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <svg class="w-8 h-8 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                        </path>
                                    </svg>
                                    <div>
                                        <p class="text-sm font-medium text-blue-900">File tersedia untuk diunduh</p>
                                        <p class="text-xs text-blue-600">{{ basename($materi->file_path) }}</p>
                                    </div>
                                </div>
                                <a href="{{ asset('storage/' . $materi->file_path) }}" target="_blank"
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">
                                    Download
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Navigation -->
        <div class="flex justify-between items-center">
            <a href="{{ route('siswa.materi.index') }}" class="text-blue-600 hover:text-blue-800 flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Kembali ke Daftar Materi
            </a>

            <div class="flex space-x-3">
                <a href="{{ route('siswa.lks.index') }}"
                    class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">
                    Lihat LKS
                </a>
                <a href="{{ route('siswa.quiz.index') }}"
                    class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">
                    Ikut Quiz
                </a>
            </div>
        </div>
    </div>
@endsection
