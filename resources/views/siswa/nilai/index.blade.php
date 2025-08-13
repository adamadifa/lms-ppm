@extends('layouts.app')

@section('title', 'Nilai & Progress')
@section('subtitle', 'Lihat progress dan nilai Anda')

@section('content')
    <div class="p-6">
        <!-- Header Section -->
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-900">Nilai & Progress</h2>
            <p class="text-gray-600">Lihat progress pembelajaran dan nilai yang Anda dapatkan</p>
        </div>

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                            </path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total Mata Pelajaran</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $totalMataPelajaran }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100 text-green-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">LKS Dikerjakan</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $lksDikerjakan }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Quiz Dikerjakan</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $quizDikerjakan }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                            </path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Rata-rata Nilai</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ number_format($rataRataNilai, 1) }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="bg-white rounded-lg shadow p-4 mb-6">
            <form action="{{ route('siswa.nilai.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label for="mata_pelajaran_id" class="block text-sm font-medium text-gray-700 mb-2">Mata Pelajaran</label>
                    <select name="mata_pelajaran_id" id="mata_pelajaran_id"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Semua Mata Pelajaran</option>
                        @foreach ($mataPelajaran as $mp)
                            <option value="{{ $mp->id }}" {{ request('mata_pelajaran_id') == $mp->id ? 'selected' : '' }}>
                                {{ $mp->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="tipe_penilaian" class="block text-sm font-medium text-gray-700 mb-2">Tipe Penilaian</label>
                    <select name="tipe_penilaian" id="tipe_penilaian"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Semua Tipe</option>
                        <option value="LKS" {{ request('tipe_penilaian') == 'LKS' ? 'selected' : '' }}>LKS</option>
                        <option value="Quiz" {{ request('tipe_penilaian') == 'Quiz' ? 'selected' : '' }}>Quiz</option>
                        <option value="Ujian" {{ request('tipe_penilaian') == 'Ujian' ? 'selected' : '' }}>Ujian</option>
                    </select>
                </div>
                <div class="flex items-end">
                    <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">
                        Filter
                    </button>
                </div>
            </form>
        </div>

        <!-- Nilai Table -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Daftar Nilai</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tanggal
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Mata Pelajaran
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tipe
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nilai
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Guru
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Keterangan
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($nilai as $n)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $n->created_at->format('d M Y') }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $n->mataPelajaran->nama }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                @if ($n->tipe_penilaian === 'LKS') bg-green-100 text-green-800
                                @elseif($n->tipe_penilaian === 'Quiz') bg-purple-100 text-purple-800
                                @else bg-blue-100 text-blue-800 @endif">
                                        {{ $n->tipe_penilaian }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">
                                        @if ($n->nilai >= 85)
                                            <span class="text-green-600">{{ $n->nilai }}</span>
                                        @elseif($n->nilai >= 70)
                                            <span class="text-yellow-600">{{ $n->nilai }}</span>
                                        @else
                                            <span class="text-red-600">{{ $n->nilai }}</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $n->guru->name }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900">{{ $n->keterangan ?: '-' }}</div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                    @if (request('mata_pelajaran_id') || request('tipe_penilaian'))
                                        Tidak ada nilai yang sesuai dengan filter yang dipilih.
                                    @else
                                        Belum ada nilai yang tersedia.
                                    @endif
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if ($nilai->hasPages())
                <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                    {{ $nilai->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
