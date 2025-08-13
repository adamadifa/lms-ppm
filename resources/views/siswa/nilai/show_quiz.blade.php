@extends('layouts.app')

@section('title', 'Detail Hasil Quiz')
@section('subtitle', $hasilQuiz->quiz->judul)

@section('content')
    <div class="p-6">
        <!-- Header -->
        <div class="mb-6">
            <div class="flex items-center justify-between">
                <div>
                    <a href="{{ route('siswa.nilai.index') }}" class="text-blue-600 hover:text-blue-800 mr-2">
                        <svg class="w-5 h-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                        Kembali ke Nilai
                    </a>
                    <h2 class="text-2xl font-bold text-gray-900">{{ $hasilQuiz->quiz->judul }}</h2>
                    <p class="text-gray-600 mt-1">{{ $hasilQuiz->quiz->materi->judul ?? 'Tidak ada materi' }}</p>
                </div>
                <div class="text-right">
                    <div
                        class="text-4xl font-bold {{ $hasilQuiz->nilai >= ($hasilQuiz->quiz->passing_score ?? 70) ? 'text-green-600' : 'text-red-600' }}">
                        {{ $hasilQuiz->nilai }}
                    </div>
                    <div class="text-sm text-gray-600">
                        @if ($hasilQuiz->nilai >= ($hasilQuiz->quiz->passing_score ?? 70))
                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">Lulus</span>
                        @else
                            <span class="bg-red-100 text-red-800 px-2 py-1 rounded-full text-xs">Tidak Lulus</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Quiz Details -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            <!-- Quiz Info -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Quiz</h3>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Durasi:</span>
                        <span class="font-medium">{{ $hasilQuiz->quiz->durasi }} menit</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Jumlah Soal:</span>
                        <span class="font-medium">{{ $hasilQuiz->quiz->jumlah_soal }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Nilai Minimum:</span>
                        <span class="font-medium">{{ $hasilQuiz->quiz->passing_score ?? 70 }}%</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Status:</span>
                        <span class="font-medium">{{ ucfirst($hasilQuiz->quiz->status) }}</span>
                    </div>
                </div>
            </div>

            <!-- Performance Info -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Performa Anda</h3>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Jawaban Benar:</span>
                        <span class="font-medium text-green-600">{{ $hasilQuiz->jumlah_benar ?? 0 }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Jawaban Salah:</span>
                        <span class="font-medium text-red-600">{{ $hasilQuiz->jumlah_salah ?? 0 }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Total Soal:</span>
                        <span class="font-medium">{{ $hasilQuiz->total_soal ?? 0 }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Akurasi:</span>
                        <span class="font-medium">
                            @if ($hasilQuiz->total_soal > 0)
                                {{ round(($hasilQuiz->jumlah_benar / $hasilQuiz->total_soal) * 100, 1) }}%
                            @else
                                0%
                            @endif
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Time Information -->
        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Waktu</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h4 class="text-sm font-medium text-gray-600 mb-2">Waktu Mulai</h4>
                    <p class="text-lg font-medium text-gray-900">
                        {{ $hasilQuiz->waktu_mulai ? $hasilQuiz->waktu_mulai->format('d M Y H:i:s') : 'Tidak tersedia' }}
                    </p>
                </div>
                <div>
                    <h4 class="text-sm font-medium text-gray-600 mb-2">Waktu Selesai</h4>
                    <p class="text-lg font-medium text-gray-900">
                        {{ $hasilQuiz->waktu_selesai ? $hasilQuiz->waktu_selesai->format('d M Y H:i:s') : 'Tidak tersedia' }}
                    </p>
                </div>
            </div>
            @if ($hasilQuiz->waktu_mulai && $hasilQuiz->waktu_selesai)
                <div class="mt-4 pt-4 border-t border-gray-200">
                    <h4 class="text-sm font-medium text-gray-600 mb-2">Durasi Pengerjaan</h4>
                    <p class="text-lg font-medium text-gray-900">
                        {{ $hasilQuiz->waktu_mulai->diffForHumans($hasilQuiz->waktu_selesai, true) }}
                    </p>
                </div>
            @endif
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-between items-center">
            <a href="{{ route('siswa.nilai.index') }}"
                class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded-md text-sm font-medium transition-colors">
                Kembali ke Nilai
            </a>
            <a href="{{ route('siswa.quiz.show', $hasilQuiz->quiz) }}"
                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md text-sm font-medium transition-colors">
                Lihat Quiz
            </a>
        </div>
    </div>
@endsection
