@extends('layouts.app')

@section('title', 'Quiz & Ujian')
@section('subtitle', 'Daftar quiz yang tersedia')

@section('content')
    <div class="p-6">
        <!-- Header Section -->
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-900">Quiz & Ujian</h2>
            <p class="text-gray-600">Daftar quiz yang tersedia untuk Anda ikuti</p>
        </div>

        <!-- Filter Section -->
        <div class="bg-white rounded-lg shadow p-4 mb-6">
            <form action="{{ route('siswa.quiz.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label for="mata_pelajaran_id" class="block text-sm font-medium text-gray-700 mb-2">Mata Pelajaran</label>
                    <select name="mata_pelajaran_id" id="mata_pelajaran_id"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Semua Mata Pelajaran</option>
                        @foreach ($mataPelajaran as $mp)
                            <option value="{{ $mp->id }}" {{ request('mata_pelajaran_id') == $mp->id ? 'selected' : '' }}>
                                {{ $mp->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select name="status" id="status"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Semua Status</option>
                        <option value="belum_dikerjakan" {{ request('status') == 'belum_dikerjakan' ? 'selected' : '' }}>Belum Dikerjakan</option>
                        <option value="sudah_dikerjakan" {{ request('status') == 'sudah_dikerjakan' ? 'selected' : '' }}>Sudah Dikerjakan</option>
                    </select>
                </div>
                <div class="flex items-end">
                    <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">
                        Filter
                    </button>
                </div>
            </form>
        </div>

        <!-- Quiz Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($quizzes as $quiz)
                <div class="bg-white rounded-lg shadow overflow-hidden hover:shadow-lg transition-shadow">
                    <!-- Header -->
                    <div class="px-4 py-3 bg-purple-50 border-b border-purple-200">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-gray-900 truncate">{{ $quiz->judul }}</h3>
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                        @if ($quiz->status === 'aktif') bg-green-100 text-green-800
                        @else bg-yellow-100 text-yellow-800 @endif">
                                {{ ucfirst($quiz->status) }}
                            </span>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-4">
                        <div class="space-y-3">
                            <div>
                                <p class="text-sm text-gray-600">Mata Pelajaran</p>
                                <p class="text-sm font-medium text-gray-900">{{ $quiz->mataPelajaran->nama }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Kelas</p>
                                <p class="text-sm font-medium text-gray-900">{{ $quiz->kelas->nama }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Guru</p>
                                <p class="text-sm font-medium text-gray-900">{{ $quiz->guru->name }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Jumlah Soal</p>
                                <p class="text-sm font-medium text-gray-900">{{ $quiz->jumlah_soal }} soal</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Durasi</p>
                                <p class="text-sm font-medium text-gray-900">{{ $quiz->durasi }} menit</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Waktu Mulai</p>
                                <p class="text-sm font-medium text-gray-900">{{ $quiz->waktu_mulai->format('d M Y H:i') }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Waktu Selesai</p>
                                <p class="text-sm font-medium text-gray-900">{{ $quiz->waktu_selesai->format('d M Y H:i') }}</p>
                            </div>
                            @if ($quiz->deskripsi)
                                <div>
                                    <p class="text-sm text-gray-600">Deskripsi</p>
                                    <p class="text-sm text-gray-900 line-clamp-2">{{ $quiz->deskripsi }}</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="px-4 py-3 bg-gray-50 border-t border-gray-200">
                        <div class="flex justify-between items-center">
                            <div class="text-xs text-gray-500">
                                Dibuat: {{ $quiz->created_at->format('d M Y') }}
                            </div>
                            <div class="flex space-x-2">
                                <a href="{{ route('siswa.quiz.show', $quiz) }}" class="text-blue-600 hover:text-blue-900 text-sm font-medium">Lihat</a>
                                @if ($quiz->status === 'aktif' && now()->between($quiz->waktu_mulai, $quiz->waktu_selesai))
                                    <a href="#" class="text-green-600 hover:text-green-900 text-sm font-medium">Mulai Quiz</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full">
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada Quiz</h3>
                        <p class="mt-1 text-sm text-gray-500">
                            @if (request('mata_pelajaran_id') || request('status'))
                                Tidak ada quiz yang sesuai dengan filter yang dipilih.
                            @else
                                Belum ada quiz yang tersedia untuk kelas Anda.
                            @endif
                        </p>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if ($quizzes->hasPages())
            <div class="mt-6">
                {{ $quizzes->links() }}
            </div>
        @endif
    </div>
@endsection
