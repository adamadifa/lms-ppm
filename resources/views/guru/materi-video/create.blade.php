@extends('layouts.app')

@section('title', 'Tambah Video Materi')
@section('subtitle', 'Tambahkan video pembelajaran baru')

@section('content')
    <div class="p-6">
        <!-- Header Section -->
        <div class="mb-6">
            <div class="flex items-center">
                <a href="{{ route('guru.materi-video.index') }}" class="text-blue-600 hover:text-blue-800 mr-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>
                <h2 class="text-2xl font-bold text-gray-900">Tambah Video Materi</h2>
            </div>
            <p class="text-gray-600 mt-1">Tambahkan video pembelajaran baru untuk materi</p>
        </div>

        <!-- Form -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <h3 class="text-lg font-semibold text-gray-900">Form Video Baru</h3>
                <p class="text-sm text-gray-600">Isi informasi video pembelajaran</p>
            </div>

            <form action="{{ route('guru.materi-video.store') }}" method="POST" class="p-6">
                @csrf

                <!-- Materi Selection -->
                <div class="mb-6">
                    <label for="materi_id" class="block text-sm font-medium text-gray-700 mb-2">
                        Materi <span class="text-red-500">*</span>
                    </label>
                    <select name="materi_id" id="materi_id"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 @error('materi_id') border-red-500 @enderror"
                        required>
                        <option value="">Pilih materi</option>
                        @foreach ($materi as $m)
                            <option value="{{ $m->id }}" {{ old('materi_id') == $m->id ? 'selected' : '' }}>
                                {{ $m->judul }} ({{ $m->mataPelajaran->nama }} • {{ $m->kelas->nama }})
                            </option>
                        @endforeach
                    </select>
                    @error('materi_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Judul Video -->
                <div class="mb-6">
                    <label for="judul" class="block text-sm font-medium text-gray-700 mb-2">
                        Judul Video <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="judul" id="judul" value="{{ old('judul') }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 @error('judul') border-red-500 @enderror"
                        placeholder="Contoh: Pengenalan Aljabar - Bagian 1" required>
                    @error('judul')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Deskripsi Video -->
                <div class="mb-6">
                    <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">
                        Deskripsi Video
                    </label>
                    <textarea name="deskripsi" id="deskripsi" rows="3"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 @error('deskripsi') border-red-500 @enderror"
                        placeholder="Jelaskan isi video pembelajaran ini...">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-sm text-gray-500">Deskripsi membantu siswa memahami isi video</p>
                </div>

                <!-- YouTube URL -->
                <div class="mb-6">
                    <label for="youtube_url" class="block text-sm font-medium text-gray-700 mb-2">
                        URL YouTube <span class="text-red-500">*</span>
                    </label>
                    <input type="url" name="youtube_url" id="youtube_url" value="{{ old('youtube_url') }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 @error('youtube_url') border-red-500 @enderror"
                        placeholder="https://www.youtube.com/watch?v=VIDEO_ID atau https://youtu.be/VIDEO_ID" required>
                    @error('youtube_url')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-sm text-gray-500">Format yang didukung: youtube.com/watch?v=... atau youtu.be/...</p>
                </div>

                <!-- Urutan Video -->
                <div class="mb-6">
                    <label for="urutan" class="block text-sm font-medium text-gray-700 mb-2">
                        Urutan Video
                    </label>
                    <input type="number" name="urutan" id="urutan" value="{{ old('urutan') }}" min="1"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 @error('urutan') border-red-500 @enderror"
                        placeholder="1">
                    @error('urutan')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-sm text-gray-500">Kosongkan untuk urutan otomatis (setelah video terakhir)</p>
                </div>

                <!-- Status Video -->
                <div class="mb-6">
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                        Status Video <span class="text-red-500">*</span>
                    </label>
                    <select name="status" id="status"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 @error('status') border-red-500 @enderror"
                        required>
                        <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="nonaktif" {{ old('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                    @error('status')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Form Actions -->
                <div class="flex justify-between items-center pt-6 border-t border-gray-200">
                    <a href="{{ route('guru.materi-video.index') }}"
                        class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">
                        Batal
                    </a>
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">
                        Simpan Video
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
