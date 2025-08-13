@extends('layouts.app')

@section('title', 'Detail Video Materi')
@section('subtitle', 'Detail video pembelajaran')

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
                <h2 class="text-2xl font-bold text-gray-900">Detail Video</h2>
            </div>
            <p class="text-gray-600 mt-1">Informasi lengkap video pembelajaran</p>
        </div>

        <!-- Video Player Section -->
        <div class="bg-white rounded-lg shadow overflow-hidden mb-6">
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <h3 class="text-lg font-semibold text-gray-900">{{ $materiVideo->judul }}</h3>
                <p class="text-sm text-gray-600">Video pembelajaran dari materi: {{ $materiVideo->materi->judul }}</p>
            </div>

            <div class="p-6">
                @if ($materiVideo->youtube_id)
                    <!-- YouTube Embed Player -->
                    <div class="aspect-w-16 aspect-h-9 mb-6">
                        <iframe src="{{ $materiVideo->embedUrl }}" title="{{ $materiVideo->judul }}" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen
                            class="w-full h-96 rounded-lg">
                        </iframe>
                    </div>
                @else
                    <!-- Fallback for invalid YouTube URL -->
                    <div class="bg-gray-100 rounded-lg p-8 text-center">
                        <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1m4 0h1m-6 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Video tidak dapat ditampilkan</h3>
                        <p class="text-gray-600 mb-4">URL YouTube tidak valid atau video tidak tersedia</p>
                        <a href="{{ $materiVideo->youtube_url }}" target="_blank"
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                            </svg>
                            Lihat di YouTube
                        </a>
                    </div>
                @endif

                <!-- Video Information -->
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
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                </path>
                            </svg>
                            <div>
                                <p class="text-sm font-medium text-green-900">Kelas</p>
                                <p class="text-sm text-green-700">{{ $materiVideo->materi->kelas->nama }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-purple-50 p-4 rounded-lg">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-purple-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                            <div>
                                <p class="text-sm font-medium text-purple-900">Urutan</p>
                                <p class="text-sm text-purple-700">{{ $materiVideo->urutan }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-yellow-50 p-4 rounded-lg">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-yellow-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                            <div>
                                <p class="text-sm font-medium text-yellow-900">Status</p>
                                <p class="text-sm text-yellow-700">{{ ucfirst($materiVideo->status) }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Video Description -->
                @if ($materiVideo->deskripsi)
                    <div class="mt-6">
                        <h4 class="text-lg font-medium text-gray-900 mb-3">Deskripsi Video</h4>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-gray-700">{{ $materiVideo->deskripsi }}</p>
                        </div>
                    </div>
                @endif

                <!-- Video Metadata -->
                <div class="mt-6 pt-6 border-t border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm text-gray-600">
                        <div>
                            <span class="font-medium">Dibuat:</span> {{ $materiVideo->created_at->format('d M Y H:i') }}
                        </div>
                        <div>
                            <span class="font-medium">Terakhir Update:</span> {{ $materiVideo->updated_at->format('d M Y H:i') }}
                        </div>
                        <div>
                            <span class="font-medium">YouTube ID:</span> {{ $materiVideo->youtube_id ?? 'Tidak valid' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="flex justify-between items-center">
            <a href="{{ route('guru.materi-video.index') }}" class="text-blue-600 hover:text-blue-800 flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Kembali ke Daftar Video
            </a>

            <div class="flex space-x-3">
                <a href="{{ route('guru.materi-video.edit', $materiVideo) }}"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">
                    Edit Video
                </a>
                <form action="{{ route('guru.materi-video.destroy', $materiVideo) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors"
                        onclick="return confirm('Apakah Anda yakin ingin menghapus video ini?')">
                        Hapus Video
                    </button>
                </form>
            </div>
        </div>

        <!-- Related Actions -->
        <div class="mt-6 pt-6 border-t border-gray-200">
            <div class="flex space-x-4">
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
                <a href="{{ $materiVideo->youtube_url }}" target="_blank" class="text-red-600 hover:text-red-800 flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                    </svg>
                    Buka di YouTube
                </a>
            </div>
        </div>
    </div>
@endsection
