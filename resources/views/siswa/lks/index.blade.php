@extends('layouts.app')

@section('title', 'Daftar LKPD')
@section('subtitle', 'Lembar Kerja Peserta Didik yang tersedia')

@section('content')
    <div class="p-4 sm:p-6">
        <!-- Header Section -->
        <div class="mb-4 sm:mb-6">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-3 sm:space-y-0">
                <div>
                    <h2 class="text-xl sm:text-2xl font-bold text-gray-900">Daftar LKPD</h2>
                    <p class="text-gray-600 mt-1 text-sm sm:text-base">Lembar Kerja Peserta Didik yang dapat dikerjakan</p>
                </div>
                <a href="{{ route('siswa.materi.index') }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-xs sm:text-sm font-medium transition-colors text-center w-full sm:w-auto">
                    Lihat Materi
                </a>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="bg-white rounded-lg shadow overflow-hidden mb-4 sm:mb-6">
            <div class="px-4 sm:px-6 py-3 sm:py-4 border-b border-gray-200 bg-gray-50">
                <h3 class="text-base sm:text-lg font-semibold text-gray-900">Filter LKPD</h3>
            </div>
            <div class="p-4 sm:p-6">
                <form action="{{ route('siswa.lks.index') }}" method="GET"
                    class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-4">
                    <div>
                        <label for="materi_id"
                            class="block text-xs sm:text-sm font-medium text-gray-700 mb-2">Materi</label>
                        <select name="materi_id" id="materi_id"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm sm:text-base">
                            <option value="">Semua Materi</option>
                            @foreach ($materi ?? [] as $m)
                                <option value="{{ $m->id }}" {{ request('materi_id') == $m->id ? 'selected' : '' }}>
                                    {{ $m->judul }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="status" class="block text-xs sm:text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select name="status" id="status"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm sm:text-base">
                            <option value="">Semua Status</option>
                            <option value="belum_dikerjakan"
                                {{ request('status') == 'belum_dikerjakan' ? 'selected' : '' }}>
                                Belum Dikerjakan
                            </option>
                            <option value="sudah_dikerjakan"
                                {{ request('status') == 'sudah_dikerjakan' ? 'selected' : '' }}>
                                Sudah Dikerjakan
                            </option>
                        </select>
                    </div>
                    <div class="flex items-end sm:col-span-2 lg:col-span-1">
                        <button type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-xs sm:text-sm font-medium transition-colors">
                            Filter
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- LKPD List -->
        @if ($lkpd->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
                @foreach ($lkpd as $l)
                    <div class="bg-white rounded-lg shadow overflow-hidden hover:shadow-lg transition-shadow">
                        <div class="p-4 sm:p-6">
                            <div class="flex items-start justify-between mb-3 sm:mb-4">
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-base sm:text-lg font-medium text-gray-900 mb-2 truncate">
                                        {{ $l->judul }}</h3>
                                    @if ($l->deskripsi)
                                        <p class="text-xs sm:text-sm text-gray-600 mb-3 line-clamp-2">
                                            {{ Str::limit($l->deskripsi, 100) }}</p>
                                    @endif

                                    <div class="space-y-2 text-xs sm:text-sm text-gray-500">
                                        <div class="flex items-center">
                                            <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-2 flex-shrink-0" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                                </path>
                                            </svg>
                                            <span class="truncate">{{ $l->materi->judul }}</span>
                                        </div>
                                        <div class="flex items-center">
                                            <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-2 flex-shrink-0" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                                </path>
                                            </svg>
                                            <span class="truncate">{{ $l->kelas->nama }}</span>
                                        </div>
                                        <div class="flex items-center">
                                            <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-2 flex-shrink-0" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            {{ $l->durasi }} menit
                                        </div>
                                        <div class="flex items-center">
                                            <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-2 flex-shrink-0" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                </path>
                                            </svg>
                                            {{ $l->jumlah_soal }} soal
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if ($l->deadline)
                                <div class="mb-3 sm:mb-4 p-2 sm:p-3 bg-red-50 rounded-lg border border-red-200">
                                    <div class="flex items-center text-xs sm:text-sm">
                                        <svg class="w-3 h-3 sm:w-4 sm:h-4 text-red-600 mr-2 flex-shrink-0" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <span class="text-red-800 truncate">
                                            Deadline: {{ $l->deadline->format('d M Y H:i') }}
                                        </span>
                                    </div>
                                    @if (now()->isAfter($l->deadline))
                                        <p class="text-xs text-red-600 mt-1 font-medium">Deadline sudah lewat!</p>
                                    @else
                                        <p class="text-xs text-red-600 mt-1">Sisa: {{ now()->diffForHumans($l->deadline) }}
                                        </p>
                                    @endif
                                </div>
                            @endif

                            <div
                                class="flex flex-col sm:flex-row sm:justify-between sm:items-center space-y-2 sm:space-y-0 mb-3 sm:mb-4">
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 self-start sm:self-auto">
                                    {{ ucfirst($l->status) }}
                                </span>

                                @php
                                    $pengumpulan = \App\Models\PengumpulanLKS::where('lks_id', $l->id)
                                        ->where('siswa_id', auth()->id())
                                        ->first();
                                @endphp

                                @if ($pengumpulan)
                                    <div class="flex flex-col items-end space-y-1">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            {{ $pengumpulan->status === 'dikumpul' ? 'Sudah Dikerjakan' : ucfirst($pengumpulan->status) }}
                                        </span>
                                        @if ($pengumpulan->file_jawaban)
                                            <span
                                                class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                📎 Ada File
                                            </span>
                                        @endif
                                    </div>
                                @else
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 self-start sm:self-auto">
                                        Belum Dikerjakan
                                    </span>
                                @endif
                            </div>

                            <div class="mt-3 sm:mt-4">
                                @if ($pengumpulan)
                                    <a href="{{ route('siswa.lks.show', $l->id) }}"
                                        class="w-full bg-blue-600 hover:bg-blue-700 text-white px-3 sm:px-4 py-2 rounded-md text-xs sm:text-sm font-medium transition-colors text-center block">
                                        Lihat Hasil
                                    </a>
                                @else
                                    @if ($l->deadline && now()->isAfter($l->deadline))
                                        <button disabled
                                            class="w-full bg-gray-400 text-white px-3 sm:px-4 py-2 rounded-md text-xs sm:text-sm font-medium cursor-not-allowed">
                                            Deadline Lewat
                                        </button>
                                    @else
                                        <a href="{{ route('siswa.lks.show', $l->id) }}"
                                            class="w-full bg-green-600 hover:bg-green-700 text-white px-3 sm:px-4 py-2 rounded-md text-xs sm:text-sm font-medium transition-colors text-center block">
                                            Kerjakan LKPD
                                        </a>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if ($lkpd->hasPages())
                <div class="mt-4 sm:mt-6">
                    {{ $lkpd->links() }}
                </div>
            @endif
        @else
            <div class="bg-white rounded-lg shadow p-6 sm:p-8 text-center">
                <svg class="mx-auto h-8 w-8 sm:h-12 sm:w-12 text-gray-400" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                    </path>
                </svg>
                <h3 class="mt-2 text-sm sm:text-base font-medium text-gray-900">Tidak ada LKPD</h3>
                <p class="mt-1 text-xs sm:text-sm text-gray-500">Belum ada Lembar Kerja Peserta Didik yang tersedia untuk
                    Anda.</p>
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
