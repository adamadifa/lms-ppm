@extends('layouts.app')

@section('title', 'Detail Quiz')
@section('subtitle', 'Informasi lengkap quiz dan hasil siswa')

@push('styles')
<style>
    .math-fraction {
        display: inline-block;
        text-align: center;
        vertical-align: middle;
        margin: 0 0.2em;
    }
    
    .math-fraction::before {
        content: '';
        display: block;
        border-bottom: 1px solid currentColor;
        margin-bottom: 0.1em;
    }
    
    .math-sqrt {
        border-top: 1px solid currentColor;
        padding-top: 0.1em;
    }
    
    .math-sum, .math-integral {
        font-weight: bold;
    }
    
    sup, sub {
        font-size: 0.75em;
        line-height: 1;
    }
</style>
@endpush

@section('content')
    <div class="p-6">
        <!-- Header Section -->
        <div class="mb-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <a href="{{ route('guru.quiz.index') }}" class="text-blue-600 hover:text-blue-800 mr-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                            </path>
                        </svg>
                    </a>
                    <h2 class="text-2xl font-bold text-gray-900">{{ $quiz->judul }}</h2>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('guru.quiz.edit', $quiz) }}"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">
                        Edit Quiz
                    </a>
                    <a href="{{ route('guru.quiz.index') }}"
                        class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">
                        Kembali
                    </a>
                </div>
            </div>
            <p class="text-gray-600 mt-1">Detail lengkap quiz dan hasil siswa</p>
        </div>

        <!-- Quiz Information -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
            <!-- Quiz Details -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h3 class="text-lg font-semibold text-gray-900">Informasi Quiz</h3>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <h4 class="text-sm font-medium text-gray-500">Judul</h4>
                                <p class="text-lg text-gray-900">{{ $quiz->judul }}</p>
                            </div>
                            <div>
                                <h4 class="text-sm font-medium text-gray-500">Status</h4>
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    @if ($quiz->status === 'aktif') bg-green-100 text-green-800
                                    @elseif ($quiz->status === 'draft') bg-yellow-100 text-yellow-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                    {{ ucfirst($quiz->status) }}
                                </span>
                            </div>
                            <div>
                                <h4 class="text-sm font-medium text-gray-500">Materi</h4>
                                <p class="text-gray-900">{{ $quiz->materi->judul }}</p>
                            </div>
                            <div>
                                <h4 class="text-sm font-medium text-gray-500">Kelas</h4>
                                <p class="text-gray-900">{{ $quiz->kelas->nama }}</p>
                            </div>
                            <div>
                                <h4 class="text-sm font-medium text-gray-500">Durasi</h4>
                                <p class="text-gray-900">{{ $quiz->durasi }} menit</p>
                            </div>
                            <div>
                                <h4 class="text-sm font-medium text-gray-500">Jumlah Soal</h4>
                                <p class="text-gray-900">{{ $quiz->jumlah_soal }} soal</p>
                            </div>
                            <div>
                                <h4 class="text-sm font-medium text-gray-500">Nilai Minimum Lulus</h4>
                                <p class="text-gray-900">{{ $quiz->passing_score }}%</p>
                            </div>
                            <div>
                                <h4 class="text-sm font-medium text-gray-500">Dibuat</h4>
                                <p class="text-gray-900">{{ $quiz->created_at->format('d M Y H:i') }}</p>
                            </div>
                        </div>

                        @if ($quiz->deskripsi)
                            <div class="mt-6 pt-6 border-t border-gray-200">
                                <h4 class="text-sm font-medium text-gray-500 mb-2">Deskripsi</h4>
                                <p class="text-gray-900">{{ $quiz->deskripsi }}</p>
                            </div>
                        @endif

                        @if ($quiz->waktu_mulai || $quiz->waktu_selesai)
                            <div class="mt-6 pt-6 border-t border-gray-200">
                                <h4 class="text-sm font-medium text-gray-500 mb-3">Jadwal Quiz</h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    @if ($quiz->waktu_mulai)
                                        <div>
                                            <h5 class="text-xs font-medium text-gray-500">Waktu Mulai</h5>
                                            <p class="text-gray-900">
                                                {{ \Carbon\Carbon::parse($quiz->waktu_mulai)->format('d M Y H:i') }}</p>
                                        </div>
                                    @endif
                                    @if ($quiz->waktu_selesai)
                                        <div>
                                            <h5 class="text-xs font-medium text-gray-500">Waktu Selesai</h5>
                                            <p class="text-gray-900">
                                                {{ \Carbon\Carbon::parse($quiz->waktu_selesai)->format('d M Y H:i') }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Quiz Statistics -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h3 class="text-lg font-semibold text-gray-900">Statistik Quiz</h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            <div class="text-center">
                                <div class="text-2xl font-bold text-purple-600">{{ $hasil->count() }}</div>
                                <div class="text-sm text-gray-500">Total Peserta</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-green-600">
                                    {{ $hasil->where('nilai', '>=', $quiz->passing_score)->count() }}
                                </div>
                                <div class="text-sm text-gray-500">Lulus</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-red-600">
                                    {{ $hasil->where('nilai', '<', $quiz->passing_score)->count() }}
                                </div>
                                <div class="text-sm text-gray-500">Tidak Lulus</div>
                            </div>
                            @if ($hasil->count() > 0)
                                <div class="text-center">
                                    <div class="text-2xl font-bold text-blue-600">
                                        {{ number_format($hasil->avg('nilai'), 1) }}
                                    </div>
                                    <div class="text-sm text-gray-500">Rata-rata Nilai</div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Soal Quiz -->
        <div class="bg-white rounded-lg shadow overflow-hidden mb-6">
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900">Daftar Soal ({{ $soal->count() }})</h3>
                    <a href="{{ route('guru.quiz.soal', $quiz) }}"
                        class="text-purple-600 hover:text-purple-700 text-sm font-medium">
                        Kelola Soal
                    </a>
                </div>
            </div>
            <div class="p-6">
                @if ($soal->count() > 0)
                    <div class="space-y-4">
                        @foreach ($soal as $index => $s)
                            <div class="border border-gray-200 rounded-lg p-4">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <div class="flex items-center mb-2">
                                            <span
                                                class="bg-purple-100 text-purple-800 text-xs font-medium px-2.5 py-0.5 rounded-full mr-3">
                                                Soal {{ $index + 1 }}
                                            </span>
                                            <span class="text-sm text-gray-500">Urutan: {{ $s->urutan }}</span>
                                        </div>
                                        <h4 class="text-lg font-medium text-gray-900 mb-2">
                                            @if($s->pertanyaan_html)
                                                {!! $s->pertanyaan_html !!}
                                            @else
                                                {{ $s->pertanyaan }}
                                            @endif
                                        </h4>
                                        
                                        @if($s->gambar_soal)
                                            <div class="mb-3">
                                                <img src="{{ asset('storage/' . $s->gambar_soal) }}" 
                                                     alt="Gambar soal" 
                                                     class="max-w-md rounded border">
                                            </div>
                                        @endif
                                        <div class="space-y-2">
                                            @foreach (['a', 'b', 'c', 'd'] as $option)
                                                <div class="flex items-start">
                                                    <span class="w-4 h-4 mr-2 text-sm text-gray-600 mt-1">{{ strtoupper($option) }}.</span>
                                                    <div class="flex-1">
                                                        <span class="text-gray-700 {{ $s->jawaban_benar === $option ? 'font-semibold text-green-600' : '' }}">
                                                            {{ $s->{'opsi_' . $option} }}
                                                            @if ($s->jawaban_benar === $option)
                                                                <span class="ml-2 text-xs bg-green-100 text-green-800 px-2 py-1 rounded">Jawaban Benar</span>
                                                            @endif
                                                        </span>
                                                        @if($s->{'gambar_opsi_' . $option})
                                                            <div class="mt-2">
                                                                <img src="{{ asset('storage/' . $s->{'gambar_opsi_' . $option}) }}" 
                                                                     alt="Gambar opsi {{ strtoupper($option) }}" 
                                                                     class="max-w-32 rounded border">
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada soal</h3>
                        <p class="mt-1 text-sm text-gray-500">Tambahkan soal untuk quiz ini.</p>
                        <div class="mt-6">
                            <a href="{{ route('guru.quiz.soal', $quiz) }}"
                                class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-purple-600 hover:bg-purple-700">
                                Tambah Soal Pertama
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Hasil Quiz -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <h3 class="text-lg font-semibold text-gray-900">Hasil Quiz ({{ $hasil->count() }})</h3>
            </div>
            <div class="p-6">
                @if ($hasil->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Siswa
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Nilai
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Waktu Mulai
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Waktu Selesai
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Durasi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($hasil as $h)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    <div
                                                        class="h-10 w-10 rounded-full bg-purple-100 flex items-center justify-center">
                                                        <span class="text-sm font-medium text-purple-600">
                                                            {{ strtoupper(substr($h->siswa->name, 0, 1)) }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">{{ $h->siswa->name }}
                                                    </div>
                                                    <div class="text-sm text-gray-500">{{ $h->siswa->email }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">{{ $h->nilai }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                @if ($h->nilai >= $quiz->passing_score) bg-green-100 text-green-800
                                                @else bg-red-100 text-red-800 @endif">
                                                {{ $h->nilai >= $quiz->passing_score ? 'Lulus' : 'Tidak Lulus' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                {{ $h->waktu_mulai ? \Carbon\Carbon::parse($h->waktu_mulai)->format('d M Y H:i') : '-' }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                {{ $h->waktu_selesai ? \Carbon\Carbon::parse($h->waktu_selesai)->format('d M Y H:i') : '-' }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                @if ($h->waktu_mulai && $h->waktu_selesai)
                                                    {{ \Carbon\Carbon::parse($h->waktu_mulai)->diffInMinutes(\Carbon\Carbon::parse($h->waktu_selesai)) }}
                                                    menit
                                                @else
                                                    -
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-8">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada hasil quiz</h3>
                        <p class="mt-1 text-sm text-gray-500">Siswa belum mengerjakan quiz ini.</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Actions -->
        <div class="flex justify-between items-center mt-6">
            <a href="{{ route('guru.quiz.index') }}" class="text-blue-600 hover:text-blue-800 flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Kembali ke Daftar Quiz
            </a>

            <div class="flex space-x-3">
                <a href="{{ route('guru.quiz.edit', $quiz) }}"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">
                    Edit Quiz
                </a>
                <a href="{{ route('guru.quiz.index') }}"
                    class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">
                    Lihat Semua Quiz
                </a>
            </div>
        </div>
    </div>
@endsection
