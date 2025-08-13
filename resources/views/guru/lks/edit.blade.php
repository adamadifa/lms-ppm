@extends('layouts.app')

@section('title', 'Edit LKPD')
@section('subtitle', 'Edit Lembar Kerja Siswa')

@section('content')
    <div class="p-6">
        <!-- Header Section -->
        <div class="mb-6">
            <div class="flex items-center">
                <a href="{{ route('guru.lks.index') }}" class="text-blue-600 hover:text-blue-800 mr-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>
                <h2 class="text-2xl font-bold text-gray-900">Edit LKPD</h2>
            </div>
            <p class="text-gray-600 mt-1">Edit Lembar Kerja Siswa {{ $lks->judul }}</p>
        </div>

        <!-- Edit Form -->
        <div class="bg-white rounded-lg shadow p-6">
            <form action="{{ route('guru.lks.update', $lks) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Judul Field -->
                    <div class="col-span-2">
                        <label for="judul" class="block text-sm font-medium text-gray-700 mb-2">
                            Judul LKPD <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="judul" id="judul" value="{{ old('judul', $lks->judul) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('judul') border-red-500 @enderror"
                            placeholder="Contoh: Latihan Soal Aljabar" required>
                        @error('judul')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Materi Field -->
                    <div class="col-span-2 md:col-span-1">
                        <label for="materi_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Materi <span class="text-red-500">*</span>
                        </label>
                        <select name="materi_id" id="materi_id"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('materi_id') border-red-500 @enderror"
                            required>
                            <option value="">Pilih materi</option>
                            @foreach ($materi as $m)
                                <option value="{{ $m->id }}"
                                    {{ old('materi_id', $lks->materi_id) == $m->id ? 'selected' : '' }}>
                                    {{ $m->judul }}
                                </option>
                            @endforeach
                        </select>
                        @error('materi_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Info: Kelas otomatis dari Materi -->
                    <div class="col-span-2 md:col-span-1">
                        <div class="bg-blue-50 p-4 rounded-lg">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                    </path>
                                </svg>
                                <div>
                                    <p class="text-sm font-medium text-blue-900">Kelas</p>
                                    <p class="text-sm text-blue-700">Akan otomatis sesuai materi yang dipilih</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Deadline Field -->
                    <div class="col-span-2 md:col-span-1">
                        <label for="deadline" class="block text-sm font-medium text-gray-700 mb-2">
                            Deadline
                        </label>
                        <input type="datetime-local" name="deadline" id="deadline"
                            value="{{ old('deadline', $lks->deadline ? $lks->deadline->format('Y-m-d\TH:i') : '') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('deadline') border-red-500 @enderror">
                        <p class="mt-1 text-sm text-gray-500">Kosongkan jika tidak ada deadline</p>
                        @error('deadline')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status Field -->
                    <div class="col-span-2 md:col-span-1">
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                            Status <span class="text-red-500">*</span>
                        </label>
                        <select name="status" id="status"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('status') border-red-500 @enderror"
                            required>
                            <option value="">Pilih status</option>
                            <option value="draft" {{ old('status', $lks->status) == 'draft' ? 'selected' : '' }}>Draft
                            </option>
                            <option value="publikasi" {{ old('status', $lks->status) == 'publikasi' ? 'selected' : '' }}>
                                Publikasi</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Deskripsi Field -->
                    <div class="col-span-2">
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">
                            Deskripsi
                        </label>
                        <textarea name="deskripsi" id="deskripsi" rows="3"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('deskripsi') border-red-500 @enderror"
                            placeholder="Deskripsi singkat tentang LKPD ini">{{ old('deskripsi', $lks->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Instruksi Field -->
                    <div class="col-span-2">
                        <label for="instruksi" class="block text-sm font-medium text-gray-700 mb-2">
                            Instruksi <span class="text-red-500">*</span>
                        </label>
                        <textarea name="instruksi" id="instruksi" rows="4"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('instruksi') border-red-500 @enderror"
                            placeholder="Tulis instruksi pengerjaan LKPD untuk siswa..." required>{{ old('instruksi', $lks->instruksi) }}</textarea>
                        @error('instruksi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- File Upload Field -->
                    <div class="col-span-2">
                        <label for="file_path" class="block text-sm font-medium text-gray-700 mb-2">
                            File LKPD
                        </label>
                        <input type="file" name="file_path" id="file_path" accept=".pdf,.doc,.docx,.ppt,.pptx"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('file_path') border-red-500 @enderror">
                        <p class="mt-1 text-sm text-gray-500">Format: PDF, DOC, DOCX, PPT, PPTX (Max: 10MB)</p>
                        @if ($lks->file_path)
                            <p class="mt-1 text-sm text-blue-600">File saat ini: {{ basename($lks->file_path) }}</p>
                        @endif
                        @error('file_path')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex justify-end space-x-3 mt-8 pt-6 border-t border-gray-200">
                    <a href="{{ route('guru.lks.index') }}"
                        class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-4 py-2 bg-green-600 border border-transparent rounded-md text-sm font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        Update LKPD
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
