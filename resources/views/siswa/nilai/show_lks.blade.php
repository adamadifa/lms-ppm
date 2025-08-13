@extends('layouts.app')

@section('title', 'Detail Pengumpulan LKPD')
@section('subtitle', $pengumpulanLKS->lembarKerjaSiswa->judul)

@section('content')
    <div class="p-6">
        <!-- Header -->
        <div class="mb-6">
            <div class="flex items-center justify-between">
                <div>
                    <a href="{{ route('siswa.nilai.index') }}" class="text-blue-600 hover:text-blue-800 mr-2">
                        <svg class="w-5 h-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                        Kembali ke Nilai
                    </a>
                    <h2 class="text-2xl font-bold text-gray-900">{{ $pengumpulanLKS->lembarKerjaSiswa->judul }}</h2>
                    <p class="text-gray-600 mt-1">
                        {{ $pengumpulanLKS->lembarKerjaSiswa->materi->judul ?? 'Tidak ada materi' }}</p>
                </div>
                <div class="text-right">
                    <div class="text-2xl font-bold text-blue-600">
                        @if ($pengumpulanLKS->status === 'dikumpul')
                            <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">Sudah Dikumpul</span>
                        @else
                            <span
                                class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-sm">{{ ucfirst($pengumpulanLKS->status) }}</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- LKPD Details -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            <!-- LKPD Info -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi LKPD</h3>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Judul:</span>
                        <span class="font-medium">{{ $pengumpulanLKS->lembarKerjaSiswa->judul }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Deskripsi:</span>
                        <span
                            class="font-medium">{{ $pengumpulanLKS->lembarKerjaSiswa->deskripsi ?: 'Tidak ada deskripsi' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Status:</span>
                        <span class="font-medium">{{ ucfirst($pengumpulanLKS->lembarKerjaSiswa->status) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Deadline:</span>
                        <span class="font-medium">
                            @if ($pengumpulanLKS->lembarKerjaSiswa->deadline)
                                {{ $pengumpulanLKS->lembarKerjaSiswa->deadline->format('d M Y H:i') }}
                            @else
                                Tidak ada deadline
                            @endif
                        </span>
                    </div>
                </div>
            </div>

            <!-- Submission Info -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Pengumpulan</h3>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Status:</span>
                        <span class="font-medium">
                            @if ($pengumpulanLKS->status === 'dikumpul')
                                <span class="text-green-600">Sudah Dikumpul</span>
                            @else
                                <span class="text-gray-600">{{ ucfirst($pengumpulanLKS->status) }}</span>
                            @endif
                        </span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Waktu Pengumpulan:</span>
                        <span class="font-medium">
                            @if ($pengumpulanLKS->waktu_pengumpulan)
                                {{ $pengumpulanLKS->waktu_pengumpulan->format('d M Y H:i:s') }}
                            @else
                                Belum dikumpulkan
                            @endif
                        </span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">File Dikumpulkan:</span>
                        <span class="font-medium">
                            @if ($pengumpulanLKS->file_jawaban)
                                <span class="text-green-600">Ada File</span>
                            @else
                                <span class="text-gray-600">Tidak ada file</span>
                            @endif
                        </span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Jawaban Teks:</span>
                        <span class="font-medium">
                            @if ($pengumpulanLKS->jawaban)
                                <span class="text-green-600">Ada Jawaban</span>
                            @else
                                <span class="text-gray-600">Tidak ada jawaban</span>
                            @endif
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Submission Content -->
        @if ($pengumpulanLKS->jawaban || $pengumpulanLKS->file_jawaban)
            <div class="bg-white rounded-lg shadow p-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Jawaban Anda</h3>

                @if ($pengumpulanLKS->jawaban)
                    <div class="mb-6">
                        <h4 class="text-sm font-medium text-gray-600 mb-2">Jawaban Teks:</h4>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-gray-900 whitespace-pre-wrap">{{ $pengumpulanLKS->jawaban }}</p>
                        </div>
                    </div>
                @endif

                @if ($pengumpulanLKS->file_jawaban)
                    <div>
                        <h4 class="text-sm font-medium text-gray-600 mb-2">File Dikumpulkan:</h4>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <div class="flex items-center space-x-3">
                                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">File Dikumpulkan</p>
                                    <p class="text-xs text-gray-500">Dikumpulkan pada
                                        {{ $pengumpulanLKS->waktu_pengumpulan ? $pengumpulanLKS->waktu_pengumpulan->format('d M Y H:i') : 'waktu tidak diketahui' }}
                                    </p>
                                </div>
                                <a href="{{ asset('storage/' . $pengumpulanLKS->file_jawaban) }}" target="_blank"
                                    class="ml-auto bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-sm transition-colors">
                                    Download
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        @endif

        <!-- Action Buttons -->
        <div class="flex justify-between items-center">
            <a href="{{ route('siswa.nilai.index') }}"
                class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded-md text-sm font-medium transition-colors">
                Kembali ke Nilai
            </a>
            <a href="{{ route('siswa.lks.show', $pengumpulanLKS->lks_id) }}"
                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md text-sm font-medium transition-colors">
                Lihat LKPD
            </a>
        </div>
    </div>
@endsection
