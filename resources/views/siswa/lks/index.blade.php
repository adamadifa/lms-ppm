@extends('layouts.app')

@section('title', 'Lembar Kerja Siswa')
@section('subtitle', 'Daftar LKS yang tersedia')

@section('content')
    <div class="p-6">
        <!-- Header Section -->
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-900">Lembar Kerja Siswa</h2>
            <p class="text-gray-600">Daftar LKS yang tersedia untuk Anda kerjakan</p>
        </div>

        <!-- Filter Section -->
        <div class="bg-white rounded-lg shadow p-4 mb-6">
            <form action="{{ route('siswa.lks.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">
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
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select name="status" id="status"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Semua Status</option>
                        <option value="belum_dikerjakan" {{ request('status') == 'belum_dikerjakan' ? 'selected' : '' }}>Belum Dikerjakan</option>
                        <option value="sudah_dikerjakan" {{ request('status') == 'sudah_dikerjakan' ? 'selected' : '' }}>Sudah Dikerjakan</option>
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

        <!-- LKS Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($lks as $l)
                <div class="bg-white rounded-lg shadow overflow-hidden hover:shadow-lg transition-shadow">
                    <!-- Header -->
                    <div class="px-4 py-3 bg-green-50 border-b border-green-200">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-gray-900 truncate">{{ $l->judul }}</h3>
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                        @if ($l->status === 'aktif') bg-green-100 text-green-800
                        @else bg-yellow-100 text-yellow-800 @endif">
                                {{ ucfirst($l->status) }}
                            </span>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-4">
                        <div class="space-y-3">
                            <div>
                                <p class="text-sm text-gray-600">Mata Pelajaran</p>
                                <p class="text-sm font-medium text-gray-900">{{ $l->mataPelajaran->nama }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Kelas</p>
                                <p class="text-sm font-medium text-gray-900">{{ $l->kelas->nama }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Guru</p>
                                <p class="text-sm font-medium text-gray-900">{{ $l->guru->name }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Deadline</p>
                                <p class="text-sm font-medium text-gray-900">
                                    @if ($l->deadline)
                                        @if ($l->deadline->isPast())
                                            <span class="text-red-600">Lewat deadline</span>
                                        @else
                                            {{ $l->deadline->format('d M Y H:i') }}
                                        @endif
                                    @else
                                        Tidak ada deadline
                                    @endif
                                </p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">File</p>
                                <p class="text-sm font-medium text-gray-900">
                                    @if ($l->file_path)
                                        <span class="text-green-600">✓ Tersedia</span>
                                    @else
                                        <span class="text-gray-500">✗ Tidak ada file</span>
                                    @endif
                                </p>
                            </div>
                            @if ($l->instruksi)
                                <div>
                                    <p class="text-sm text-gray-600">Instruksi</p>
                                    <p class="text-sm text-gray-900 line-clamp-2">{{ $l->instruksi }}</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="px-4 py-3 bg-gray-50 border-t border-gray-200">
                        <div class="flex justify-between items-center">
                            <div class="text-xs text-gray-500">
                                Dibuat: {{ $l->created_at->format('d M Y') }}
                            </div>
                            <div class="flex space-x-2">
                                <a href="{{ route('siswa.lks.show', $l) }}" class="text-blue-600 hover:text-blue-900 text-sm font-medium">Lihat</a>
                                @if ($l->file_path)
                                    <a href="{{ asset('storage/' . $l->file_path) }}" target="_blank"
                                        class="text-green-600 hover:text-green-900 text-sm font-medium">Download</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full">
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada LKS</h3>
                        <p class="mt-1 text-sm text-gray-500">
                            @if (request('mata_pelajaran_id') || request('status'))
                                Tidak ada LKS yang sesuai dengan filter yang dipilih.
                            @else
                                Belum ada LKS yang tersedia untuk kelas Anda.
                            @endif
                        </p>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if ($lks->hasPages())
            <div class="mt-6">
                {{ $lks->links() }}
            </div>
        @endif
    </div>
@endsection
