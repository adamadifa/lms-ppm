@extends('layouts.app')

@section('title', 'Edit Materi')
@section('subtitle', 'Edit materi pembelajaran')

@section('content')
    <div class="p-6">
        <!-- Header Section -->
        <div class="mb-6">
            <div class="flex items-center">
                <a href="{{ route('guru.materi.index') }}" class="text-blue-600 hover:text-blue-800 mr-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>
                <h2 class="text-2xl font-bold text-gray-900">Edit Materi</h2>
            </div>
            <p class="text-gray-600 mt-1">Edit materi pembelajaran {{ $materi->judul }}</p>
        </div>

        <!-- Edit Form -->
        <div class="bg-white rounded-lg shadow p-6">
            <form action="{{ route('guru.materi.update', $materi) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Judul Field -->
                    <div class="col-span-2">
                        <label for="judul" class="block text-sm font-medium text-gray-700 mb-2">
                            Judul Materi <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="judul" id="judul" value="{{ old('judul', $materi->judul) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('judul') border-red-500 @enderror"
                            placeholder="Contoh: Pengenalan Aljabar" required>
                        @error('judul')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Mata Pelajaran Field -->
                    <div class="col-span-2 md:col-span-1">
                        <label for="mata_pelajaran_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Mata Pelajaran <span class="text-red-500">*</span>
                        </label>
                        <select name="mata_pelajaran_id" id="mata_pelajaran_id"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('mata_pelajaran_id') border-red-500 @enderror"
                            required>
                            <option value="">Pilih mata pelajaran</option>
                            @foreach ($mataPelajaran as $mp)
                                <option value="{{ $mp->id }}"
                                    {{ old('mata_pelajaran_id', $materi->mata_pelajaran_id) == $mp->id ? 'selected' : '' }}>
                                    {{ $mp->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('mata_pelajaran_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Kelas Field -->
                    <div class="col-span-2 md:col-span-1">
                        <label for="kelas_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Kelas <span class="text-red-500">*</span>
                        </label>
                        <select name="kelas_id" id="kelas_id"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('kelas_id') border-red-500 @enderror"
                            required>
                            <option value="">Pilih kelas</option>
                            @foreach ($kelas as $k)
                                <option value="{{ $k->id }}" {{ old('kelas_id', $materi->kelas_id) == $k->id ? 'selected' : '' }}>
                                    {{ $k->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('kelas_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Urutan Field -->
                    <div class="col-span-2 md:col-span-1">
                        <label for="urutan" class="block text-sm font-medium text-gray-700 mb-2">
                            Urutan <span class="text-red-500">*</span>
                        </label>
                        <input type="number" name="urutan" id="urutan" value="{{ old('urutan', $materi->urutan) }}" min="1"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('urutan') border-red-500 @enderror"
                            required>
                        @error('urutan')
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
                            <option value="draft" {{ old('status', $materi->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="publikasi" {{ old('status', $materi->status) == 'publikasi' ? 'selected' : '' }}>Publikasi</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Deskripsi Field -->
                    <div class="col-span-2">
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">
                            Deskripsi Singkat
                        </label>
                        <textarea name="deskripsi" id="deskripsi" rows="3"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('deskripsi') border-red-500 @enderror"
                            placeholder="Deskripsi singkat tentang materi ini">{{ old('deskripsi', $materi->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Konten Field -->
                    <div class="col-span-2">
                        <label for="konten" class="block text-sm font-medium text-gray-700 mb-2">
                            Konten Materi <span class="text-red-500">*</span>
                        </label>
                        <textarea name="konten" id="konten" rows="8"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('konten') border-red-500 @enderror"
                            placeholder="Tulis konten materi pembelajaran di sini..." required>{{ old('konten', $materi->konten) }}</textarea>
                        @error('konten')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- File Upload Field -->
                    <div class="col-span-2">
                        <label for="file_path" class="block text-sm font-medium text-gray-700 mb-2">
                            File Pendukung
                        </label>
                        <input type="file" name="file_path" id="file_path" accept=".pdf,.doc,.docx,.ppt,.pptx"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('file_path') border-red-500 @enderror">
                        <p class="mt-1 text-sm text-gray-500">Format: PDF, DOC, DOCX, PPT, PPTX (Max: 10MB)</p>
                        @if ($materi->file_path)
                            <p class="mt-1 text-sm text-blue-600">File saat ini: {{ basename($materi->file_path) }}</p>
                        @endif
                        @error('file_path')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex justify-end space-x-3 mt-8 pt-6 border-t border-gray-200">
                    <a href="{{ route('guru.materi.index') }}"
                        class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 border border-transparent rounded-md text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Update Materi
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
