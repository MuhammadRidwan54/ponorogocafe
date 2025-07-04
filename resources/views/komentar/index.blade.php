@extends('layouts.app')

@section('title', 'Kelola Komentar - PonorogoCafe')

@section('header-title', 'Kelola Komentar')

@section('header-description', 'Kelola komentar pengguna di PonorogoCafe')

@section('content')

<div class="bg-white rounded-xl shadow-md">
    <div class="p-4 lg:p-6">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-6">
            <h1 class="text-xl lg:text-2xl font-bold text-gray-800">Kelola Komentar</h1>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-3 lg:px-6 py-3 lg:py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th class="px-3 lg:px-6 py-3 lg:py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cafe</th>
                        <th class="px-3 lg:px-6 py-3 lg:py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Komentar</th>
                        <th class="px-3 lg:px-6 py-3 lg:py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-3 lg:px-6 py-3 lg:py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($komentar as $index => $komen)
                        <tr class="hover:bg-gray-50">
                            <td class="px-3 lg:px-6 py-3 lg:py-4 whitespace-nowrap text-sm text-gray-900">{{ $index + 1 }}</td>
                            <td class="px-3 lg:px-6 py-3 lg:py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $komen->cafe ? $komen->cafe->nama_cafe : '-' }}
                            </td>
                            <td class="px-3 lg:px-6 py-3 lg:py-4 text-sm text-gray-900">
                                <div class="max-w-xs lg:max-w-sm truncate" title="{{ $komen->isi_komentar }}">
                                    {{ $komen->isi_komentar }}
                                </div>
                            </td>
                            <td class="px-3 lg:px-6 py-3 lg:py-4 whitespace-nowrap text-sm font-medium">
                                @if ($komen->disetujui)
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                        Disetujui
                                    </span>
                                @else
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                        Menunggu
                                    </span>
                                @endif
                            </td>
                            <td class="px-3 lg:px-6 py-3 lg:py-4 whitespace-nowrap text-sm font-medium space-x-3">
                                @if (!$komen->disetujui)
                                    <form action="{{ route('admin.komentar.setujui', $komen->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="text-blue-600 hover:text-blue-900 transition-colors" title="Setujui Komentar">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </form>
                                @else
                                    <span class="text-gray-400">
                                        <i class="fas fa-check"></i>
                                    </span>
                                @endif

                                <!-- Tombol hapus -->
                                <form action="{{ route('admin.komentar.hapus', $komen->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus komentar ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 transition-colors" title="Hapus Komentar">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if($komentar->isEmpty())
            <div class="text-center py-8">
                <div class="text-gray-500">
                    <i class="fas fa-comments text-4xl mb-4"></i>
                    <p class="text-lg">Belum ada komentar</p>
                    <p class="text-sm">Komentar dari pengguna akan muncul di sini</p>
                </div>
            </div>
        @endif
    </div>
</div>

@endsection
