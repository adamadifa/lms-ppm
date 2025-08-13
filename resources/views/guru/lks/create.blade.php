@extends('layouts.app')

@section('title', 'Tambah LKS')
@section('subtitle', 'Buat Lembar Kerja Siswa baru')

@section('content')
    <div class="p-6">
        <!-- Header Section -->
        <div class="mb-6">
            <div class="flex items-center">
                @if (isset($materi) && $materi instanceof \App\Models\Materi)
                    <a href="{{ route('guru.materi.show', $materi) }}" class="text-blue-600 hover:text-blue-800 mr-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </a>
                    <h2 class="text-2xl font-bold text-gray-900">Buat LKS untuk Materi: {{ $materi->judul }}</h2>
                @else
                    <a href="{{ route('guru.lks.index') }}" class="text-blue-600 hover:text-blue-800 mr-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </a>
                    <h2 class="text-2xl font-bold text-gray-900">Tambah LKS Baru</h2>
                @endif
            </div>
            <p class="text-gray-600 mt-1">
                @if (isset($materi) && $materi instanceof \App\Models\Materi)
                    Buat Lembar Kerja Siswa untuk materi "{{ $materi->judul }}"
                @else
                    Buat Lembar Kerja Siswa untuk siswa Anda
                @endif
            </p>
        </div>

        <!-- Create Form -->
        <div class="bg-white rounded-lg shadow p-6">
            <form action="{{ route('guru.lks.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Judul Field -->
                    <div class="col-span-2">
                        <label for="judul" class="block text-sm font-medium text-gray-700 mb-2">
                            Judul LKS <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="judul" id="judul" value="{{ old('judul') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('judul') border-red-500 @enderror"
                            placeholder="Contoh: Latihan Soal Aljabar" required>
                        @error('judul')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Materi Field -->
                    <div class="col-span-2 md:col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-3">
                            Materi <span class="text-red-500">*</span>
                        </label>
                        @if (isset($materi) && $materi instanceof \App\Models\Materi)
                            <!-- Materi Pre-selected -->
                            <div class="bg-blue-50 p-4 rounded-lg border border-blue-200 h-20 flex items-center">
                                <div class="flex items-center w-full">
                                    <svg class="w-5 h-5 text-blue-600 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                        </path>
                                    </svg>
                                    <div class="min-w-0 flex-1">
                                        <p class="text-sm font-medium text-blue-900 truncate">{{ $materi->judul }}</p>
                                        <p class="text-xs text-blue-600">
                                            {{ $materi->mataPelajaran->nama ?? 'Mata Pelajaran' }} • {{ $materi->kelas->nama ?? 'Kelas' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="materi_id" value="{{ $materi->id }}">
                        @else
                            <!-- Materi Selection Dropdown -->
                            <select name="materi_id" id="materi_id"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('materi_id') border-red-500 @enderror"
                                required>
                                <option value="">Pilih materi</option>
                                @foreach ($materi as $m)
                                    <option value="{{ $m->id }}" {{ old('materi_id') == $m->id ? 'selected' : '' }}>
                                        {{ $m->judul }}
                                    </option>
                                @endforeach
                            </select>
                            @error('materi_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        @endif
                    </div>

                    <!-- Info: Kelas otomatis dari Materi -->
                    <div class="col-span-2 md:col-span-1">
                        <label class="block text-sm font-medium text-gray-700 mb-3">
                            Kelas
                        </label>
                        <div class="bg-green-50 p-4 rounded-lg border border-green-200 h-20 flex items-center">
                            <div class="flex items-center w-full">
                                <svg class="w-5 h-5 text-green-600 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                    </path>
                                </svg>
                                <div class="min-w-0 flex-1">
                                    <p class="text-sm font-medium text-green-900">
                                        @if (isset($materi) && $materi instanceof \App\Models\Materi)
                                            {{ $materi->kelas->nama ?? 'Kelas' }}
                                        @else
                                            Akan otomatis sesuai materi yang dipilih
                                        @endif
                                    </p>
                                    <p class="text-xs text-green-600">Otomatis dari materi</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Deadline Field -->
                    <div class="col-span-2 md:col-span-1">
                        <label for="deadline" class="block text-sm font-medium text-gray-700 mb-2">
                            Deadline
                        </label>
                        <input type="datetime-local" name="deadline" id="deadline" value="{{ old('deadline') }}"
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
                            <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="publikasi" {{ old('status') == 'publikasi' ? 'selected' : '' }}>Publikasi</option>
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
                            placeholder="Deskripsi singkat tentang LKS ini">{{ old('deskripsi') }}</textarea>
                        <p class="mt-1 text-sm text-gray-500">Berikan deskripsi singkat tentang LKS ini untuk siswa</p>
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
                            placeholder="Tulis instruksi pengerjaan LKS untuk siswa..." required>{{ old('instruksi') }}</textarea>
                        <p class="mt-1 text-sm text-gray-500">Instruksi yang jelas akan membantu siswa mengerjakan LKS dengan baik</p>
                        @error('instruksi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- File Upload Field -->
                    <div class="col-span-2">
                        <div class="border-t border-gray-200 pt-6 mt-6">
                            <label for="file_path" class="block text-sm font-medium text-gray-700 mb-2">
                                File LKS <span class="text-red-500">*</span>
                            </label>
                            <input type="file" name="file_path" id="file_path" accept=".pdf,.doc,.docx,.ppt,.pptx"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('file_path') border-red-500 @enderror"
                                required>
                            <p class="mt-1 text-sm text-gray-500">Format: PDF, DOC, DOCX, PPT, PPTX (Max: 10MB)</p>
                            @error('file_path')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex justify-end space-x-3 mt-8 pt-6 border-t border-gray-200">
                    @if (isset($materi) && $materi instanceof \App\Models\Materi)
                        <a href="{{ route('guru.materi.show', $materi) }}"
                            class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            Kembali ke Materi
                        </a>
                    @else
                        <a href="{{ route('guru.lks.index') }}"
                            class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            Batal
                        </a>
                    @endif
                    <button type="submit"
                        class="px-4 py-2 bg-green-600 border border-transparent rounded-md text-sm font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        Buat LKS
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
