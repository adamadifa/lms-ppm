@extends('layouts.app')

@section('title', 'Materi Pembelajaran')
@section('subtitle', 'Akses materi pembelajaran yang tersedia')

@section('content')
    <div class="p-4 sm:p-6">
        <!-- Header Section -->
        <div class="mb-4 sm:mb-6">
            <h2 class="text-xl sm:text-2xl font-bold text-gray-900">Materi Pembelajaran</h2>
            <p class="text-gray-600 text-sm sm:text-base">Pilih dan pelajari materi yang tersedia untuk kelas Anda</p>
        </div>

        <!-- Filter Section -->
        <div class="bg-white rounded-lg shadow p-4 sm:p-6 mb-4 sm:mb-6">
            <form action="{{ route('siswa.materi.filter') }}" method="GET"
                class="space-y-4 sm:space-y-0 sm:flex sm:flex-row sm:gap-4">
                <div class="flex-1 min-w-0">
                    <label for="mata_pelajaran_id" class="block text-xs sm:text-sm font-medium text-gray-700 mb-2">
                        Mata Pelajaran
                    </label>
                    <select name="mata_pelajaran_id" id="mata_pelajaran_id"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm sm:text-base">
                        <option value="">Semua Mata Pelajaran</option>
                        @foreach ($mataPelajaran as $mp)
                            <option value="{{ $mp->id }}"
                                {{ request('mata_pelajaran_id') == $mp->id ? 'selected' : '' }}>
                                {{ $mp->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="flex-1 min-w-0">
                    <label for="kelas_id" class="block text-xs sm:text-sm font-medium text-gray-700 mb-2">
                        Kelas
                    </label>
                    <select name="kelas_id" id="kelas_id"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm sm:text-base">
                        <option value="">Semua Kelas</option>
                        @foreach ($kelas as $k)
                            <option value="{{ $k->id }}" {{ request('kelas_id') == $k->id ? 'selected' : '' }}>
                                {{ $k->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="flex flex-col sm:flex-row items-stretch sm:items-end gap-2 sm:gap-0">
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md transition-colors text-sm sm:text-base font-medium">
                        Filter
                    </button>
                    @if (request('mata_pelajaran_id') || request('kelas_id'))
                        <a href="{{ route('siswa.materi.index') }}"
                            class="px-4 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 transition-colors text-sm sm:text-base font-medium text-center">
                            Reset
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <!-- Materi Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
            @forelse($materi as $item)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                    <!-- Header -->
                    <div class="p-4 sm:p-6 border-b border-gray-200">
                        <div class="flex items-start justify-between mb-3 sm:mb-4">
                            <div class="flex-1 min-w-0">
                                <h3 class="text-base sm:text-lg font-semibold text-gray-900 truncate mb-2">
                                    {{ $item->judul }}</h3>
                                <p class="text-xs sm:text-sm text-gray-600 line-clamp-2">
                                    {{ $item->deskripsi ?: 'Tidak ada deskripsi' }}</p>
                            </div>
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 flex-shrink-0 ml-2">
                                {{ ucfirst($item->status) }}
                            </span>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-4 sm:p-6">
                        <div class="space-y-3 sm:space-y-2 mb-4 sm:mb-6">
                            <div class="flex items-center text-xs sm:text-sm text-gray-600">
                                <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-2 sm:mr-3 flex-shrink-0" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                    </path>
                                </svg>
                                <span class="truncate">{{ $item->mataPelajaran->nama }}</span>
                            </div>
                            <div class="flex items-center text-xs sm:text-sm text-gray-600">
                                <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-2 sm:mr-3 flex-shrink-0" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                    </path>
                                </svg>
                                <span class="truncate">{{ $item->kelas->nama }}</span>
                            </div>
                            <div class="flex items-center text-xs sm:text-sm text-gray-600">
                                <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-2 sm:mr-3 flex-shrink-0" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                <span class="truncate">{{ $item->guru->name }}</span>
                            </div>
                            <div class="flex items-center text-xs sm:text-sm text-gray-600">
                                <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-2 sm:mr-3 flex-shrink-0" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z">
                                    </path>
                                </svg>
                                Urutan: {{ $item->urutan }}
                            </div>
                            @if ($item->file_path)
                                <div class="flex items-center text-xs sm:text-sm text-gray-600">
                                    <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-2 sm:mr-3 flex-shrink-0" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                        </path>
                                    </svg>
                                    File tersedia
                                </div>
                            @endif
                        </div>

                        <!-- Actions -->
                        <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-2">
                            <a href="{{ route('siswa.materi.show', $item) }}"
                                class="w-full sm:flex-1 bg-blue-600 text-white px-3 sm:px-4 py-2 rounded-md text-xs sm:text-sm font-medium hover:bg-blue-700 text-center transition-colors">
                                Pelajari
                            </a>
                            @if ($item->file_path)
                                <a href="{{ asset('storage/' . $item->file_path) }}" target="_blank"
                                    class="w-full sm:flex-1 bg-green-600 text-white px-3 sm:px-4 py-2 rounded-md text-xs sm:text-sm font-medium hover:bg-green-700 text-center transition-colors">
                                    Download
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full">
                    <div class="text-center py-8 sm:py-12">
                        <svg class="mx-auto h-8 w-8 sm:h-12 sm:w-12 text-gray-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                            </path>
                        </svg>
                        <h3 class="mt-2 text-sm sm:text-base font-medium text-gray-900">Tidak ada materi</h3>
                        <p class="mt-1 text-xs sm:text-sm text-gray-500">
                            @if (request('mata_pelajaran_id') || request('kelas_id'))
                                Tidak ada materi yang sesuai dengan filter yang dipilih.
                            @else
                                Belum ada materi pembelajaran yang tersedia untuk kelas Anda.
                            @endif
                        </p>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if ($materi->hasPages())
            <div class="mt-6 sm:mt-8">
                {{ $materi->links() }}
            </div>
        @endif
    </div>
@endsection
