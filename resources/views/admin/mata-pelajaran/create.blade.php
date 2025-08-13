@extends('layouts.app')

@section('title', 'Tambah Mata Pelajaran')
@section('subtitle', 'Buat mata pelajaran baru')

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
                <h2 class="text-2xl font-bold text-gray-900">Tambah Mata Pelajaran Baru</h2>
            </div>
            <p class="text-gray-600 mt-1">Isi form di bawah untuk membuat mata pelajaran baru</p>
        </div>

        <!-- Create Form -->
        <div class="bg-white rounded-lg shadow p-6">
            <form action="{{ route('admin.mata-pelajaran.store') }}" method="POST">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Kode Field -->
                    <div class="col-span-2 md:col-span-1">
                        <label for="kode" class="block text-sm font-medium text-gray-700 mb-2">
                            Kode Mata Pelajaran <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="kode" id="kode" value="{{ old('kode') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('kode') border-red-500 @enderror"
                            placeholder="Contoh: MAT, BIN, ING" required>
                        @error('kode')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nama Field -->
                    <div class="col-span-2 md:col-span-1">
                        <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Mata Pelajaran <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="nama" id="nama" value="{{ old('nama') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('nama') border-red-500 @enderror"
                            placeholder="Contoh: Matematika, Bahasa Indonesia" required>
                        @error('nama')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Deskripsi Field -->
                    <div class="col-span-2">
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">
                            Deskripsi
                        </label>
                        <textarea name="deskripsi" id="deskripsi" rows="4"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('deskripsi') border-red-500 @enderror"
                            placeholder="Deskripsi singkat tentang mata pelajaran ini">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status Field -->
                    <div class="col-span-2">
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                            Status <span class="text-red-500">*</span>
                        </label>
                        <select name="status" id="status"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('status') border-red-500 @enderror"
                            required>
                            <option value="">Pilih status</option>
                            <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="nonaktif" {{ old('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex justify-end space-x-3 mt-8 pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.mata-pelajaran.index') }}"
                        class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 border border-transparent rounded-md text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Buat Mata Pelajaran
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
