@extends('layouts.app')

@section('title', 'Detail Kelas')
@section('subtitle', 'Informasi lengkap kelas')

@section('content')
    <div class="p-6">
        <!-- Header Section -->
        <div class="mb-6">
            <div class="flex items-center">
                <a href="{{ route('admin.kelas.index') }}" class="text-blue-600 hover:text-blue-800 mr-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>
                <h2 class="text-2xl font-bold text-gray-900">Detail Kelas</h2>
            </div>
            <p class="text-gray-600 mt-1">Informasi lengkap kelas {{ $kelas->nama }}</p>
        </div>

        <!-- Kelas Information -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <!-- Header -->
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-100 text-green-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                </path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-xl font-semibold text-gray-900">{{ $kelas->nama }}</h3>
                            <p class="text-gray-600">Tingkat: {{ $kelas->tingkat }}</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3">
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                        @if ($kelas->status === 'aktif') bg-green-100 text-green-800
                        @else bg-red-100 text-red-800 @endif">
                            {{ ucfirst($kelas->status) }}
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
                                <dt class="text-sm font-medium text-gray-500">Nama Kelas</dt>
                                <dd class="text-sm text-gray-900">{{ $kelas->nama }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Tingkat</dt>
                                <dd class="text-sm text-gray-900">{{ $kelas->tingkat }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Jurusan</dt>
                                <dd class="text-sm text-gray-900">{{ $kelas->jurusan ?: 'Tidak ada jurusan' }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Status</dt>
                                <dd class="text-sm text-gray-900">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    @if ($kelas->status === 'aktif') bg-green-100 text-green-800
                                    @else bg-red-100 text-red-800 @endif">
                                        {{ ucfirst($kelas->status) }}
                                    </span>
                                </dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Dibuat Pada</dt>
                                <dd class="text-sm text-gray-900">{{ $kelas->created_at->format('d M Y H:i') }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Terakhir Update</dt>
                                <dd class="text-sm text-gray-900">{{ $kelas->updated_at->format('d M Y H:i') }}</dd>
                            </div>
                        </dl>
                    </div>

                    <!-- Additional Information -->
                    <div>
                        <h4 class="text-lg font-medium text-gray-900 mb-4">Informasi Tambahan</h4>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-sm text-gray-600">
                                Kelas ini dapat digunakan untuk mengelompokkan siswa berdasarkan tingkat pendidikan dan jurusan yang dipilih.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                <div class="flex justify-between items-center">
                    <div class="text-sm text-gray-600">
                        Kelas ID: {{ $kelas->id }}
                    </div>
                    <div class="flex space-x-3">
                        <a href="{{ route('admin.kelas.edit', $kelas) }}"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">
                            Edit Kelas
                        </a>
                        <form action="{{ route('admin.kelas.destroy', $kelas) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus kelas ini?')">
                                Hapus Kelas
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
