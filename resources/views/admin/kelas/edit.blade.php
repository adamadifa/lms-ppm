@extends('layouts.app')

@section('title', 'Edit Kelas')
@section('subtitle', 'Edit informasi kelas')

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
                <h2 class="text-2xl font-bold text-gray-900">Edit Kelas</h2>
            </div>
            <p class="text-gray-600 mt-1">Edit informasi kelas {{ $kelas->nama }}</p>
        </div>

        <!-- Edit Form -->
        <div class="bg-white rounded-lg shadow p-6">
            <form action="{{ route('admin.kelas.update', $kelas) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nama Field -->
                    <div class="col-span-2 md:col-span-1">
                        <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Kelas <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="nama" id="nama" value="{{ old('nama', $kelas->nama) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('nama') border-red-500 @enderror"
                            placeholder="Contoh: X-A, XI-IPA-1, XII-IPS-2" required>
                        @error('nama')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tingkat Field -->
                    <div class="col-span-2 md:col-span-1">
                        <label for="tingkat" class="block text-sm font-medium text-gray-700 mb-2">
                            Tingkat <span class="text-red-500">*</span>
                        </label>
                        <select name="tingkat" id="tingkat"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('tingkat') border-red-500 @enderror"
                            required>
                            <option value="">Pilih tingkat</option>
                            <option value="X" {{ old('tingkat', $kelas->tingkat) == 'X' ? 'selected' : '' }}>X (Kelas 10)</option>
                            <option value="XI" {{ old('tingkat', $kelas->tingkat) == 'XI' ? 'selected' : '' }}>XI (Kelas 11)</option>
                            <option value="XII" {{ old('tingkat', $kelas->tingkat) == 'XII' ? 'selected' : '' }}>XII (Kelas 12)</option>
                        </select>
                        @error('tingkat')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Jurusan Field -->
                    <div class="col-span-2 md:col-span-1">
                        <label for="jurusan" class="block text-sm font-medium text-gray-700 mb-2">
                            Jurusan
                        </label>
                        <select name="jurusan" id="jurusan"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('jurusan') border-red-500 @enderror">
                            <option value="">Pilih jurusan</option>
                            <option value="IPA" {{ old('jurusan', $kelas->jurusan) == 'IPA' ? 'selected' : '' }}>IPA</option>
                            <option value="IPS" {{ old('jurusan', $kelas->jurusan) == 'IPS' ? 'selected' : '' }}>IPS</option>
                            <option value="Bahasa" {{ old('jurusan', $kelas->jurusan) == 'Bahasa' ? 'selected' : '' }}>Bahasa</option>
                            <option value="Umum" {{ old('jurusan', $kelas->jurusan) == 'Umum' ? 'selected' : '' }}>Umum</option>
                        </select>
                        <p class="mt-1 text-sm text-gray-500">Kosongkan untuk kelas X atau kelas tanpa jurusan</p>
                        @error('jurusan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status Field -->
                    <div class="col-span-2 md:col-span-1">
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                            Status <span class="text-red-500">*</span>
                        </label>
                        <select name="status" id="status"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('status') border-red-500 @enderror"
                            required>
                            <option value="">Pilih status</option>
                            <option value="aktif" {{ old('status', $kelas->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="nonaktif" {{ old('status', $kelas->status) == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex justify-end space-x-3 mt-8 pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.kelas.index') }}"
                        class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 border border-transparent rounded-md text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Update Kelas
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
