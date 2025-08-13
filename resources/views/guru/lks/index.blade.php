@extends('layouts.app')

@section('title', 'Kelola LKS')
@section('subtitle', 'Manajemen Lembar Kerja Siswa')

@section('content')
    <div class="p-6">
        <!-- Header Section -->
        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Kelola LKS</h2>
                <p class="text-gray-600">Manajemen Lembar Kerja Siswa yang Anda buat</p>
            </div>
            <a href="{{ route('guru.lks.create') }}"
                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg flex items-center transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Tambah LKS
            </a>
        </div>

        <!-- Success/Error Messages -->
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

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
                                                @if ($l->status === 'publikasi') bg-green-100 text-green-800
                        @else bg-yellow-100 text-yellow-800 @endif">
                                {{ ucfirst($l->status) }}
                            </span>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-4">
                        <div class="space-y-3">
                            <div>
                                <p class="text-sm text-gray-600">Materi</p>
                                <p class="text-sm font-medium text-gray-900">{{ $l->materi->judul ?? 'Tidak ada materi' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Kelas</p>
                                <p class="text-sm font-medium text-gray-900">{{ $l->kelas->nama }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Deadline</p>
                                <p class="text-sm font-medium text-gray-900">
                                    @if ($l->deadline && $l->deadline instanceof \Carbon\Carbon)
                                        {{ $l->deadline->format('d M Y H:i') }}
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
                            @if ($l->deskripsi)
                                <div>
                                    <p class="text-sm text-gray-600">Deskripsi</p>
                                    <p class="text-sm text-gray-900 line-clamp-2">{{ $l->deskripsi }}</p>
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
                                <a href="{{ route('guru.lks.show', $l) }}" class="text-blue-600 hover:text-blue-900 text-sm font-medium">Detail</a>
                                <a href="{{ route('guru.lks.edit', $l) }}" class="text-indigo-600 hover:text-indigo-900 text-sm font-medium">Edit</a>
                                <form action="{{ route('guru.lks.destroy', $l) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 text-sm font-medium"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus LKS ini?')">
                                        Hapus
                                    </button>
                                </form>
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
                        <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada LKS</h3>
                        <p class="mt-1 text-sm text-gray-500">Mulai buat LKS pertama Anda untuk siswa.</p>
                        <div class="mt-6">
                            <a href="{{ route('guru.lks.create') }}"
                                class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700">
                                <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Tambah LKS
                            </a>
                        </div>
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
