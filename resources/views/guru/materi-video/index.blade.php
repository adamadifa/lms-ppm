@extends('layouts.app')

@section('title', 'Daftar Video Materi')
@section('subtitle', 'Kelola semua video pembelajaran')

@section('content')
    <div class="p-6">
        <!-- Header Section -->
        <div class="mb-6">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">Video Pembelajaran</h2>
                    <p class="text-gray-600 mt-1">Kelola semua video pembelajaran yang Anda buat</p>
                </div>
                <a href="{{ route('guru.materi-video.create') }}"
                    class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Tambah Video
                </a>
            </div>
        </div>

        <!-- Videos List -->
        @if ($videos->count() > 0)
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h3 class="text-lg font-semibold text-gray-900">Daftar Video ({{ $videos->count() }})</h3>
                    <p class="text-sm text-gray-600">Semua video pembelajaran yang tersedia</p>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Video
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Materi
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Deskripsi
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Urutan
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Dibuat
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($videos as $video)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-16 w-24 bg-gray-200 rounded overflow-hidden">
                                                @if ($video->youtube_id)
                                                    <img src="{{ $video->thumbnailUrl }}" alt="{{ $video->judul }}" class="h-full w-full object-cover">
                                                @else
                                                    <div class="flex items-center justify-center h-full">
                                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1m4 0h1m-6 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                                            </path>
                                                        </svg>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $video->judul }}</div>
                                                <div class="text-sm text-gray-500">
                                                    <a href="{{ $video->youtube_url }}" target="_blank" class="text-red-600 hover:text-red-800">
                                                        Lihat di YouTube
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900">
                                            <a href="{{ route('guru.materi.show', $video->materi) }}" class="text-blue-600 hover:text-blue-800">
                                                {{ $video->materi->judul }}
                                            </a>
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ $video->materi->mataPelajaran->nama }} • {{ $video->materi->kelas->nama }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900">
                                            @if ($video->deskripsi)
                                                {{ Str::limit($video->deskripsi, 80) }}
                                            @else
                                                <span class="text-gray-500">Tidak ada deskripsi</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            {{ $video->urutan }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                            @if ($video->status === 'aktif') bg-green-100 text-green-800
                                            @else bg-gray-100 text-gray-800 @endif">
                                            {{ ucfirst($video->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $video->created_at->format('d M Y') }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('guru.materi-video.show', $video) }}" class="text-blue-600 hover:text-blue-900">Detail</a>
                                            <a href="{{ route('guru.materi-video.edit', $video) }}"
                                                class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                            <form action="{{ route('guru.materi-video.destroy', $video) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus video ini?')">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <!-- No Videos Message -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1m4 0h1m-6 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada video</h3>
                    <p class="mt-1 text-sm text-gray-500">Anda belum membuat video pembelajaran.</p>
                    <div class="mt-6">
                        <a href="{{ route('guru.materi-video.create') }}"
                            class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700">
                            <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Tambah Video Pertama
                        </a>
                    </div>
                </div>
            </div>
        @endif

        <!-- Actions -->
        <div class="flex justify-between items-center mt-6">
            <a href="{{ route('guru.materi.index') }}" class="text-blue-600 hover:text-blue-800 flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Kembali ke Materi
            </a>

            <div class="flex space-x-3">
                <a href="{{ route('guru.materi-video.create') }}"
                    class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">
                    Tambah Video Baru
                </a>
                <a href="{{ route('guru.materi.index') }}"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">
                    Lihat Materi
                </a>
            </div>
        </div>
    </div>
@endsection
