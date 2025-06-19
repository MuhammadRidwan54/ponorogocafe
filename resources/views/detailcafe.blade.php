@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <!-- Tombol Kembali -->
    <div class="mb-4">
        <a href="{{ url()->previous() }}" class="text-gray-500 hover:text-black text-sm">&larr; Kembali</a>
    </div>

    <!-- Gambar Utama -->
    <div class="relative bg-gray-200 rounded-lg overflow-hidden">
        @if(is_array($cafe->gambar) && count($cafe->gambar))
            <img src="{{ asset('storage/' . $cafe->gambar[0]) }}"
                 alt="Gambar Cafe"
                 class="w-full h-64 object-cover">
        @else
            <div class="w-full h-64 flex items-center justify-center bg-gray-300 text-gray-600">
                Tidak ada gambar
            </div>
        @endif
    </div>

    <!-- Informasi Umum -->
    <div class="mt-4">
        <h1 class="text-2xl font-bold">{{ $cafe->nama_cafe }}</h1>
        <p class="text-gray-600 flex items-center mt-1">
            <svg class="w-5 h-5 mr-1 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                <path d="M5.05 3.05a7 7 0 019.9 0c2.73 2.73 2.73 7.17 0 9.9l-4.95 4.95a.75.75 0 01-1.06 0L5.05 12.95a7 7 0 010-9.9zM10 11a1 1 0 100-2 1 1 0 000 2z"/>
            </svg>
            {{ $cafe->alamat }}
        </p>
    </div>

    <!-- Detail Keterangan -->
    <div class="mt-6">
        <h2 class="text-xl font-semibold border-b pb-2 mb-3">Informasi Detail</h2>
        <ul class="space-y-2 text-gray-700 text-sm">
            <li class="flex items-center space-x-2">
                <x-icon name="clock" />
                <span>Jam Buka: {{ $cafe->jambuka->jam_buka ?? 'Tidak tersedia' }}</span>
            </li>
            <li class="flex items-center space-x-2">
                <x-icon name="car" />
                <span>Tempat Parkir: {{ $cafe->tempatparkir->tempat_parkir ?? 'Tidak tersedia' }}</span>
            </li>
            <li class="flex items-center space-x-2">
                <x-icon name="users" />
                <span>Kapasitas: {{ $cafe->kapasitasruang->kapasitas_ruang ?? 'Tidak tersedia' }}</span>
            </li>
            <li class="flex items-center space-x-2">
                <x-icon name="dollar-sign" />
                <span>Harga Menu: {{ $cafe->hargamenu->harga_menu ?? 'Tidak tersedia' }}</span>
            </li>
            <li class="flex items-center space-x-2">
                <x-icon name="map-pin" />
                <a href="{{ $cafe->maps_url }}" target="_blank" class="text-blue-600 hover:underline">
                    Lihat di Google Maps
                </a>
            </li>
        </ul>
    </div>

    <!-- Fasilitas -->
    @if($cafe->fasilitas && $cafe->fasilitas->count())
    <div class="mt-6">
        <h2 class="text-lg font-semibold mb-2">Fasilitas</h2>
        <ul class="flex flex-wrap gap-2">
            @foreach($cafe->fasilitas as $fasilitas)
                <li class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm">
                    {{ $fasilitas->nama_fasilitas }}
                </li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- Galeri Tambahan -->
    @if(is_array($cafe->gambar) && count($cafe->gambar) > 1)
    <div class="mt-6">
        <h2 class="text-lg font-semibold mb-2">Galeri Cafe</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @foreach(array_slice($cafe->gambar, 1) as $gambar)
                <img src="{{ asset('storage/' . $gambar) }}"
                     alt="Galeri Cafe"
                     class="w-full h-32 object-cover rounded">
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection
