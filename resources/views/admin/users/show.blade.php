@extends('layouts.app')

@section('title', 'Detail User')
@section('subtitle', 'Informasi lengkap user')

@section('content')
    <div class="p-6">
        <!-- Header Section -->
        <div class="mb-6">
            <div class="flex items-center">
                <a href="{{ route('admin.users.index') }}" class="text-blue-600 hover:text-blue-800 mr-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>
                <h2 class="text-2xl font-bold text-gray-900">Detail User</h2>
            </div>
            <p class="text-gray-600 mt-1">Informasi lengkap user {{ $user->name }}</p>
        </div>

        <!-- User Information -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <!-- Header -->
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <div class="flex items-center">
                    <div class="flex-shrink-0 h-16 w-16">
                        <div class="h-16 w-16 rounded-full bg-blue-600 flex items-center justify-center">
                            <span class="text-white font-semibold text-xl">
                                {{ substr($user->name, 0, 1) }}
                            </span>
                        </div>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-xl font-semibold text-gray-900">{{ $user->name }}</h3>
                        <p class="text-gray-600">ID: {{ $user->id }}</p>
                    </div>
                    <div class="ml-auto">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                            Aktif
                        </span>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="px-6 py-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Basic Information -->
                    <div>
                        <h4 class="text-lg font-medium text-gray-900 mb-4">Informasi Dasar</h4>
                        <dl class="space-y-3">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Nama Lengkap</dt>
                                <dd class="text-sm text-gray-900">{{ $user->name }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Email</dt>
                                <dd class="text-sm text-gray-900">{{ $user->email }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Email Verified</dt>
                                <dd class="text-sm text-gray-900">
                                    @if ($user->email_verified_at)
                                        <span class="text-green-600">✓ Terverifikasi</span>
                                    @else
                                        <span class="text-red-600">✗ Belum terverifikasi</span>
                                    @endif
                                </dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Dibuat Pada</dt>
                                <dd class="text-sm text-gray-900">{{ $user->created_at->format('d M Y H:i') }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Terakhir Update</dt>
                                <dd class="text-sm text-gray-900">{{ $user->updated_at->format('d M Y H:i') }}</dd>
                            </div>
                        </dl>
                    </div>

                    <!-- Role Information -->
                    <div>
                        <h4 class="text-lg font-medium text-gray-900 mb-4">Role & Permission</h4>
                        <div class="space-y-3">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Role</dt>
                                <dd class="mt-1">
                                    @foreach ($user->roles as $role)
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        @if ($role->name === 'admin') bg-red-100 text-red-800
                                        @elseif($role->name === 'guru') bg-blue-100 text-blue-800
                                        @else bg-green-100 text-green-800 @endif">
                                            {{ ucfirst($role->name) }}
                                        </span>
                                    @endforeach
                                </dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Permissions</dt>
                                <dd class="mt-1">
                                    @if ($user->permissions->count() > 0)
                                        <div class="flex flex-wrap gap-1">
                                            @foreach ($user->permissions as $permission)
                                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800">
                                                    {{ $permission->name }}
                                                </span>
                                            @endforeach
                                        </div>
                                    @else
                                        <span class="text-sm text-gray-500">Tidak ada permission khusus</span>
                                    @endif
                                </dd>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                <div class="flex justify-between items-center">
                    <div class="text-sm text-gray-600">
                        User ID: {{ $user->id }}
                    </div>
                    <div class="flex space-x-3">
                        <a href="{{ route('admin.users.edit', $user) }}"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">
                            Edit User
                        </a>
                        @if ($user->id !== auth()->id())
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
                                    Hapus User
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
