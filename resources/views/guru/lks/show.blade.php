@extends('layouts.app')

@section('title', 'Detail LKPD')
@section('subtitle', 'Informasi lengkap LKPD')

@section('content')
    <div class="p-6">
        <!-- Header Section -->
        <div class="mb-6">
            <div class="flex items-center">
                <a href="{{ route('guru.lks.index') }}" class="text-blue-600 hover:text-blue-800 mr-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>
                <h2 class="text-2xl font-bold text-gray-900">{{ $lks->judul }}</h2>
            </div>
            <p class="text-gray-600 mt-1">Detail Lembar Kerja Peserta Didik yang Anda buat</p>
        </div>

        <!-- LKPD Information -->
        <div class="bg-white rounded-lg shadow overflow-hidden mb-6">
            <!-- Header -->
            <div class="px-6 py-4 border-b border-gray-200 bg-green-50">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="p-3 rounded-full bg-green-100 text-green-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">{{ $lks->judul }}</h3>
                            <p class="text-sm text-gray-600">{{ $lks->materi->judul ?? 'Tidak ada materi' }} •
                                {{ $lks->kelas->nama }}</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3">
                        <span
                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                        @if ($lks->status === 'publikasi') bg-green-100 text-green-800
                        @else bg-yellow-100 text-yellow-800 @endif">
                            {{ ucfirst($lks->status) }}
                        </span>
                        @if ($lks->file_path)
                            <a href="{{ asset('storage/' . $lks->file_path) }}" target="_blank"
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
                <!-- LKPD Details -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <div class="bg-blue-50 p-4 rounded-lg">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                </path>
                            </svg>
                            <div>
                                <p class="text-sm font-medium text-blue-900">Materi</p>
                                <p class="text-sm text-blue-700">{{ $lks->materi->judul ?? 'Tidak ada materi' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-green-50 p-4 rounded-lg">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                </path>
                            </svg>
                            <div>
                                <p class="text-sm font-medium text-green-900">Kelas</p>
                                <p class="text-sm text-green-700">{{ $lks->kelas->nama }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-purple-50 p-4 rounded-lg">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-purple-600 mr-2" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                            <div>
                                <p class="text-sm font-medium text-purple-900">Deadline</p>
                                <p class="text-sm text-purple-700">
                                    @if ($lks->deadline && $lks->deadline instanceof \Carbon\Carbon)
                                        {{ $lks->deadline->format('d M Y H:i') }}
                                    @else
                                        Tidak ada deadline
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Deskripsi -->
                @if ($lks->deskripsi)
                    <div class="mb-6">
                        <h4 class="text-lg font-medium text-gray-900 mb-3">Deskripsi</h4>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-gray-700">{{ $lks->deskripsi }}</p>
                        </div>
                    </div>
                @endif

                <!-- Instruksi -->
                <div class="mb-6">
                    <h4 class="text-lg font-medium text-gray-900 mb-3">Instruksi Pengerjaan</h4>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <div class="prose max-w-none">
                            {!! nl2br(e($lks->instruksi)) !!}
                        </div>
                    </div>
                </div>

                <!-- File Information -->
                @if ($lks->file_path)
                    <div class="mb-6">
                        <h4 class="text-lg font-medium text-gray-900 mb-3">File LKPD</h4>
                        <div class="bg-green-50 p-4 rounded-lg border border-green-200">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <svg class="w-8 h-8 text-green-600 mr-3" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                        </path>
                                    </svg>
                                    <div>
                                        <p class="text-sm font-medium text-green-900">File tersedia</p>
                                        <p class="text-xs text-green-600">{{ basename($lks->file_path) }}</p>
                                    </div>
                                </div>
                                <a href="{{ asset('storage/' . $lks->file_path) }}" target="_blank"
                                    class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">
                                    Download
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Pengumpulan Section -->
        @if ($lks->pengumpulanLKS && $lks->pengumpulanLKS->count() > 0)
            <div class="bg-white rounded-lg shadow overflow-hidden mb-6">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Pengumpulan Siswa</h3>
                    <p class="text-sm text-gray-600">Daftar siswa yang sudah mengumpulkan LKPD ini</p>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nama Siswa
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Waktu Pengumpulan
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Jawaban
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    File
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($lks->pengumpulanLKS as $pengumpulan)
                                <tr class="hover:bg-gray-50" data-pengumpulan-id="{{ $pengumpulan->id }}">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $pengumpulan->siswa->name }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            {{ $pengumpulan->waktu_pengumpulan ? $pengumpulan->waktu_pengumpulan->format('d M Y H:i') : $pengumpulan->created_at->format('d M Y H:i') }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900 max-w-xs">
                                            @if ($pengumpulan->jawaban)
                                                <div class="truncate" title="{{ $pengumpulan->jawaban }}">
                                                    {{ Str::limit($pengumpulan->jawaban, 50) }}
                                                </div>
                                                <button onclick="showFullAnswer('{{ $pengumpulan->id }}')"
                                                    class="text-blue-600 hover:text-blue-800 text-xs mt-1">
                                                    Lihat Lengkap
                                                </button>
                                            @else
                                                <span class="text-gray-500">Tidak ada jawaban</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($pengumpulan->file_jawaban)
                                            <div class="flex items-center space-x-2">
                                                <a href="{{ asset('storage/' . $pengumpulan->file_jawaban) }}"
                                                    target="_blank"
                                                    class="text-green-600 hover:text-green-900 text-sm font-medium">
                                                    Download
                                                </a>
                                                <span
                                                    class="text-xs text-gray-500">({{ basename($pengumpulan->file_jawaban) }})</span>
                                            </div>
                                        @else
                                            <span class="text-gray-500 text-sm">Tidak ada file</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            Sudah Dikumpulkan
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <div class="bg-white rounded-lg shadow p-6 mb-6">
                <div class="text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada pengumpulan</h3>
                    <p class="mt-1 text-sm text-gray-500">Siswa belum mengumpulkan LKPD ini.</p>
                </div>
            </div>
        @endif

        <!-- Actions -->
        <div class="flex justify-between items-center">
            <a href="{{ route('guru.lks.index') }}" class="text-blue-600 hover:text-blue-800 flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Kembali ke Daftar LKPD
            </a>

            <div class="flex space-x-3">
                <a href="{{ route('guru.lks.edit', $lks) }}"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">
                    Edit LKPD
                </a>
                <a href="{{ route('guru.quiz.index') }}"
                    class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">
                    Buat Quiz
                </a>
            </div>
        </div>
    </div>

    <!-- Modal untuk menampilkan jawaban lengkap -->
    <div id="answerModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-gray-900">Jawaban Lengkap Siswa</h3>
                    <button onclick="closeAnswerModal()" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div id="fullAnswerContent" class="text-gray-700 whitespace-pre-wrap"></div>
            </div>
        </div>
    </div>

    <script>
        function showFullAnswer(pengumpulanId) {
            // Ambil data jawaban dari row yang sesuai
            const row = document.querySelector(`tr[data-pengumpulan-id="${pengumpulanId}"]`);
            if (row) {
                const jawaban = row.querySelector('.truncate').getAttribute('title');
                document.getElementById('fullAnswerContent').textContent = jawaban;
                document.getElementById('answerModal').classList.remove('hidden');
            }
        }

        function closeAnswerModal() {
            document.getElementById('answerModal').classList.add('hidden');
        }

        // Tutup modal jika klik di luar modal
        document.getElementById('answerModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeAnswerModal();
            }
        });
    </script>
@endsection
