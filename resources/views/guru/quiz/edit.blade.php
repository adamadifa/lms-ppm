@extends('layouts.app')

@section('title', 'Edit Quiz')
@section('subtitle', 'Edit quiz pembelajaran')

@section('content')
    <div class="p-4 sm:p-6">
        <!-- Header Section -->
        <div class="mb-4 sm:mb-6">
            <div class="flex items-center">
                <a href="{{ route('guru.quiz.index') }}" class="text-blue-600 hover:text-blue-800 mr-2">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>
                <h2 class="text-lg sm:text-xl lg:text-2xl font-bold text-gray-900">Edit Quiz: {{ $quiz->judul }}</h2>
            </div>
            <p class="text-sm sm:text-base text-gray-600 mt-1">Edit informasi quiz pembelajaran</p>
        </div>

        <!-- Form -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="px-4 sm:px-6 py-3 sm:py-4 border-b border-gray-200 bg-gray-50">
                <h3 class="text-base sm:text-lg font-semibold text-gray-900">Form Edit Quiz</h3>
                <p class="text-xs sm:text-sm text-gray-600">Ubah informasi quiz yang akan diedit</p>
            </div>

            <!-- Error Messages -->
            @if ($errors->any())
                <div class="px-4 sm:px-6 py-3 sm:py-4 bg-red-50 border-b border-red-200">
                    <div class="text-xs sm:text-sm text-red-800">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <form action="{{ route('guru.quiz.update', $quiz) }}" method="POST" class="p-4 sm:p-6">
                @csrf
                @method('PUT')



                <!-- Judul Quiz -->
                <div class="mb-4 sm:mb-6">
                    <label for="judul" class="block text-sm font-medium text-gray-700 mb-2">
                        Judul Quiz <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="judul" id="judul" value="{{ old('judul', $quiz->judul) }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 @error('judul') border-red-500 @enderror"
                        placeholder="Contoh: Quiz Aljabar Dasar" required>
                    @error('judul')
                        <p class="mt-1 text-xs sm:text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Deskripsi Quiz -->
                <div class="mb-6">
                    <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">
                        Deskripsi Quiz
                    </label>
                    <textarea name="deskripsi" id="deskripsi" rows="3"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 @error('deskripsi') border-red-500 @enderror"
                        placeholder="Jelaskan isi dan tujuan quiz ini...">{{ old('deskripsi', $quiz->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-sm text-gray-500">Deskripsi membantu siswa memahami quiz yang akan dikerjakan</p>
                </div>

                <!-- Mata Pelajaran dan Kelas -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- Materi -->
                    <div>
                        <label for="materi_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Materi <span class="text-red-500">*</span>
                        </label>
                        <select name="materi_id" id="materi_id"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 @error('materi_id') border-red-500 @enderror"
                            required>
                            <option value="">Pilih materi</option>
                            @foreach ($materi as $m)
                                <option value="{{ $m->id }}"
                                    {{ old('materi_id', $quiz->materi_id) == $m->id ? 'selected' : '' }}>
                                    {{ $m->judul }}
                                </option>
                            @endforeach
                        </select>
                        @error('materi_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Kelas -->
                    <div>
                        <label for="kelas_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Kelas <span class="text-red-500">*</span>
                        </label>
                        <select name="kelas_id" id="kelas_id"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 @error('kelas_id') border-red-500 @enderror"
                            required>
                            <option value="">Pilih kelas</option>
                            @foreach ($kelas as $k)
                                <option value="{{ $k->id }}"
                                    {{ old('kelas_id', $quiz->kelas_id) == $k->id ? 'selected' : '' }}>
                                    {{ $k->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('kelas_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Waktu Quiz -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- Waktu Mulai -->
                    <div>
                        <label for="waktu_mulai" class="block text-sm font-medium text-gray-700 mb-2">
                            Waktu Mulai
                        </label>
                        <input type="datetime-local" name="waktu_mulai" id="waktu_mulai"
                            value="{{ old('waktu_mulai', $quiz->waktu_mulai ? $quiz->waktu_mulai->format('Y-m-d\TH:i') : '') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 @error('waktu_mulai') border-red-500 @enderror">
                        @error('waktu_mulai')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-sm text-gray-500">Kosongkan untuk mulai segera</p>
                    </div>

                    <!-- Waktu Selesai -->
                    <div>
                        <label for="waktu_selesai" class="block text-sm font-medium text-gray-700 mb-2">
                            Waktu Selesai
                        </label>
                        <input type="datetime-local" name="waktu_selesai" id="waktu_selesai"
                            value="{{ old('waktu_selesai', $quiz->waktu_selesai ? $quiz->waktu_selesai->format('Y-m-d\TH:i') : '') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 @error('waktu_selesai') border-red-500 @enderror">
                        @error('waktu_selesai')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-sm text-gray-500">Kosongkan untuk tidak ada batas waktu</p>
                    </div>
                </div>

                <!-- Durasi dan Jumlah Soal -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- Durasi -->
                    <div>
                        <label for="durasi" class="block text-sm font-medium text-gray-700 mb-2">
                            Durasi (menit) <span class="text-red-500">*</span>
                        </label>
                        <input type="number" name="durasi" id="durasi" value="{{ old('durasi', $quiz->durasi) }}"
                            min="1" max="180"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 @error('durasi') border-red-500 @enderror"
                            placeholder="60" required>
                        @error('durasi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-sm text-gray-500">Maksimal 180 menit (3 jam)</p>
                    </div>

                    <!-- Jumlah Soal -->
                    <div>
                        <label for="jumlah_soal" class="block text-sm font-medium text-gray-700 mb-2">
                            Jumlah Soal <span class="text-red-500">*</span>
                        </label>
                        <input type="number" name="jumlah_soal" id="jumlah_soal"
                            value="{{ old('jumlah_soal', $quiz->jumlah_soal) }}" min="1" max="100"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 @error('jumlah_soal') border-red-500 @enderror"
                            placeholder="20" required>
                        @error('jumlah_soal')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-sm text-gray-500">Maksimal 100 soal</p>
                    </div>
                </div>

                <!-- Passing Score dan Status -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- Passing Score -->
                    <div>
                        <label for="passing_score" class="block text-sm font-medium text-gray-700 mb-2">
                            Nilai Minimum Lulus (%) <span class="text-red-500">*</span>
                        </label>
                        <input type="number" name="passing_score" id="passing_score"
                            value="{{ old('passing_score', $quiz->passing_score) }}" min="0" max="100"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 @error('passing_score') border-red-500 @enderror"
                            placeholder="70" required>
                        @error('passing_score')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-sm text-gray-500">Nilai minimum untuk lulus quiz</p>
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                            Status <span class="text-red-500">*</span>
                        </label>
                        <select name="status" id="status"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 @error('status') border-red-500 @enderror"
                            required>
                            <option value="draft" {{ old('status', $quiz->status) == 'draft' ? 'selected' : '' }}>Draft
                            </option>
                            <option value="aktif" {{ old('status', $quiz->status) == 'aktif' ? 'selected' : '' }}>Aktif
                            </option>
                            <option value="selesai" {{ old('status', $quiz->status) == 'selesai' ? 'selected' : '' }}>
                                Selesai</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex justify-between items-center pt-6 border-t border-gray-200">
                    <a href="{{ route('guru.quiz.index') }}"
                        class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">
                        Batal
                    </a>
                    <button type="submit"
                        class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">
                        Update Quiz
                    </button>
                </div>
            </form>
        </div>
    </div>


@endsection
