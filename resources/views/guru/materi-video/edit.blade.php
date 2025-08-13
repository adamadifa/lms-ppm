@extends('layouts.app')

@section('title', 'Edit Video Materi')
@section('subtitle', 'Edit video pembelajaran')

@section('content')
    <div class="p-6">
        <!-- Header Section -->
        <div class="mb-6">
            <div class="flex items-center">
                <a href="{{ route('guru.materi-video.show', $materiVideo) }}" class="text-blue-600 hover:text-blue-800 mr-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>
                <h2 class="text-2xl font-bold text-gray-900">Edit Video Materi</h2>
            </div>
            <p class="text-gray-600 mt-1">Edit informasi video pembelajaran</p>
        </div>

        <!-- Current Video Info -->
        <div class="bg-white rounded-lg shadow overflow-hidden mb-6">
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <h3 class="text-lg font-semibold text-gray-900">Video Saat Ini</h3>
                <p class="text-sm text-gray-600">Informasi video yang akan diedit</p>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-blue-50 p-4 rounded-lg">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                </path>
                            </svg>
                            <div>
                                <p class="text-sm font-medium text-blue-900">Materi</p>
                                <p class="text-sm text-blue-700">{{ $materiVideo->materi->judul }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-green-50 p-4 rounded-lg">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1m4 0h1m-6 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div>
                                <p class="text-sm font-medium text-green-900">Judul Saat Ini</p>
                                <p class="text-sm text-green-700">{{ $materiVideo->judul }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Form -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <h3 class="text-lg font-semibold text-gray-900">Form Edit Video</h3>
                <p class="text-sm text-gray-600">Ubah informasi video pembelajaran</p>
            </div>

            <form action="{{ route('guru.materi-video.update', $materiVideo) }}" method="POST" class="p-6">
                @csrf
                @method('PUT')

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
                            <option value="{{ $m->id }}" {{ old('materi_id', $materiVideo->materi_id) == $m->id ? 'selected' : '' }}>
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
                    <input type="text" name="judul" id="judul" value="{{ old('judul', $materiVideo->judul) }}"
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
                        placeholder="Jelaskan isi video pembelajaran ini...">{{ old('deskripsi', $materiVideo->deskripsi) }}</textarea>
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
                    <input type="url" name="youtube_url" id="youtube_url" value="{{ old('youtube_url', $materiVideo->youtube_url) }}"
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
                    <input type="number" name="urutan" id="urutan" value="{{ old('urutan', $materiVideo->urutan) }}" min="1"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 @error('urutan') border-red-500 @enderror"
                        placeholder="1">
                    @error('urutan')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-sm text-gray-500">Urutan menentukan posisi video dalam materi</p>
                </div>

                <!-- Status Video -->
                <div class="mb-6">
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                        Status Video <span class="text-red-500">*</span>
                    </label>
                    <select name="status" id="status"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 @error('status') border-red-500 @enderror"
                        required>
                        <option value="aktif" {{ old('status', $materiVideo->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="nonaktif" {{ old('status', $materiVideo->status) == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                    @error('status')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Form Actions -->
                <div class="flex justify-between items-center pt-6 border-t border-gray-200">
                    <a href="{{ route('guru.materi-video.show', $materiVideo) }}"
                        class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">
                        Batal
                    </a>
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">
                        Update Video
                    </button>
                </div>
            </form>
        </div>

        <!-- Related Actions -->
        <div class="mt-6 pt-6 border-t border-gray-200">
            <div class="flex space-x-4">
                <a href="{{ route('guru.materi-video.show', $materiVideo) }}" class="text-gray-600 hover:text-gray-800 flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                        </path>
                    </svg>
                    Lihat Detail Video
                </a>
                <a href="{{ route('guru.materi.show', $materiVideo->materi) }}" class="text-gray-600 hover:text-gray-800 flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                        </path>
                    </svg>
                    Lihat Materi
                </a>
                <a href="{{ route('guru.materi.videos', $materiVideo->materi) }}" class="text-gray-600 hover:text-gray-800 flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1m4 0h1m-6 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Kelola Video Materi Ini
                </a>
            </div>
        </div>
    </div>
@endsection
