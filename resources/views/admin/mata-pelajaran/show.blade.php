@extends('layouts.app')

@section('title', 'Detail Mata Pelajaran')
@section('subtitle', 'Informasi lengkap mata pelajaran')

@section('content')
    <div class="p-6">
        <!-- Header Section -->
        <div class="mb-6">
            <div class="flex items-center">
                <a href="{{ route('admin.mata-pelajaran.index') }}" class="text-blue-600 hover:text-blue-800 mr-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>
                <h2 class="text-2xl font-bold text-gray-900">Detail Mata Pelajaran</h2>
            </div>
            <p class="text-gray-600 mt-1">Informasi lengkap mata pelajaran {{ $mataPelajaran->nama }}</p>
        </div>

        <!-- Mata Pelajaran Information -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <!-- Header -->
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-100 text-green-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                </path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-xl font-semibold text-gray-900">{{ $mataPelajaran->nama }}</h3>
                            <p class="text-gray-600">Kode: {{ $mataPelajaran->kode }}</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3">
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                        @if ($mataPelajaran->status === 'aktif') bg-green-100 text-green-800
                        @else bg-red-100 text-red-800 @endif">
                            {{ ucfirst($mataPelajaran->status) }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="px-6 py-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Basic Information -->
                    <div>
                        <h4 class="text-lg font-medium text-gray-900 mb-4">Informasi Dasar</h4>
                        <dl class="space-y-3">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Kode Mata Pelajaran</dt>
                                <dd class="text-sm text-gray-900">{{ $mataPelajaran->kode }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Nama Mata Pelajaran</dt>
                                <dd class="text-sm text-gray-900">{{ $mataPelajaran->nama }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Status</dt>
                                <dd class="text-sm text-gray-900">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    @if ($mataPelajaran->status === 'aktif') bg-green-100 text-green-800
                                    @else bg-red-100 text-red-800 @endif">
                                        {{ ucfirst($mataPelajaran->status) }}
                                    </span>
                                </dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Dibuat Pada</dt>
                                <dd class="text-sm text-gray-900">{{ $mataPelajaran->created_at->format('d M Y H:i') }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Terakhir Update</dt>
                                <dd class="text-sm text-gray-900">{{ $mataPelajaran->updated_at->format('d M Y H:i') }}</dd>
                            </div>
                        </dl>
                    </div>

                    <!-- Description -->
                    <div>
                        <h4 class="text-lg font-medium text-gray-900 mb-4">Deskripsi</h4>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            @if ($mataPelajaran->deskripsi)
                                <p class="text-gray-700">{{ $mataPelajaran->deskripsi }}</p>
                            @else
                                <p class="text-gray-500 italic">Tidak ada deskripsi</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                <div class="flex justify-between items-center">
                    <div class="text-sm text-gray-600">
                        Mata Pelajaran ID: {{ $mataPelajaran->id }}
                    </div>
                    <div class="flex space-x-3">
                        <a href="{{ route('admin.mata-pelajaran.edit', $mataPelajaran) }}"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">
                            Edit Mata Pelajaran
                        </a>
                        <form action="{{ route('admin.mata-pelajaran.destroy', $mataPelajaran) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus mata pelajaran ini?')">
                                Hapus Mata Pelajaran
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
