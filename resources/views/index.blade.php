@extends('layouts-user.app')

@section('title', 'Rekomendasi Cafe - Ponorogo')

@section('content')
    <div class="bg-gradient-to-b from-amber-50 to-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center py-16 px-4">
                <h1 class="text-4xl md:text-6xl font-bold text-gray-900 mb-6 leading-tight">
                    Rekomendasi Cafe untuk Anda
                </h1>
                <p class="text-gray-600 text-xl mb-12 max-w-2xl mx-auto">
                    Cari rekomendasi cafe sesuai kriteria
                </p>

                <!-- Enhanced Search Form -->
                <form action="{{ route('cafe.search') }}" method="GET" class="relative mx-auto w-full max-w-6xl">
                    <div
                        class="bg-gray-200 rounded-full px-6 py-4 flex items-center justify-between shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <!-- Filter Toggle Button -->
                        <div class="flex items-center gap-3">
                            <button type="button" id="toggleFilter"
                                class="text-amber-700 hover:bg-amber-100 rounded-full p-2 mr-3 transition-all duration-300 hover:scale-110 flex-shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4" />
                                </svg>
                            </button>
                            <!-- Selected Filters Chips -->
                            <div id="selectedFilters" class="flex flex-wrap mr-3 hidden"></div>
                        </div>
                        <!-- Search Input -->
                        <input type="text" name="search" id="searchInput" placeholder="Pilih kriteria..."
                            value="{{ request('search') }}" />
                        <!-- Search Button -->
                        <button type="submit"
                            class="bg-amber-700 hover:bg-amber-800 text-white rounded-full px-6 py-2.5 ml-3 transition-all duration-300 hover:scale-105 shadow-md hover:shadow-lg flex-shrink-0">
                            <span class="text-sm font-medium">Cari...</span>
                        </button>
                    </div>

                    <!-- Enhanced Filter Dropdown -->
                    <div id="filterDropdown"
                        class="hidden absolute top-full mt-3 w-full text-white rounded-3xl p-8 shadow-2xl z-20"
                        style="background-color: #7C6A46;">
                        <!-- Harga Menu -->
                        <div class="mb-4">
                            <h3 class="font-bold text-lg text-white mb-2">Harga menu</h3>
                            <div class="flex flex-wrap gap-3">
                                @foreach ($hargamenu as $menu)
                                    <label class="cursor-pointer">
                                        <input type="radio" name="harga_menu" value="{{ $menu->id }}"
                                            {{ request('harga_menu') == $menu->id ? 'checked' : '' }} class="hidden peer">
                                        <span
                                            class="pill-button inline-block bg-white text-amber-800 hover:bg-amber-50 peer-checked:bg-amber-200 peer-checked:text-amber-900 px-6 py-2 rounded-full text-sm font-medium transition-all duration-300 hover:scale-105 peer-checked:scale-105 peer-checked:shadow-md">
                                            {{ $menu->harga_menu }}
                                        </span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Kapasitas Ruang -->
                        <div class="mb-4">
                            <h3 class="font-bold text-lg text-white mb-2">Kapasitas ruang</h3>
                            <div class="flex flex-wrap gap-3">
                                @foreach ($kapasitasruang as $kapasitas)
                                    <label class="cursor-pointer">
                                        <input type="radio" name="kapasitas_ruang" value="{{ $kapasitas->id }}"
                                            {{ request('kapasitas_ruang') == $kapasitas->id ? 'checked' : '' }}
                                            class="hidden peer">
                                        <span
                                            class="pill-button inline-block bg-white text-amber-800 hover:bg-amber-50 peer-checked:bg-amber-200 peer-checked:text-amber-900 px-6 py-2 rounded-full text-sm font-medium transition-all duration-300 hover:scale-105 peer-checked:scale-105 peer-checked:shadow-md">
                                            {{ $kapasitas->kapasitas_ruang }}
                                        </span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Fasilitas -->
                        <div class="mb-4">
                            <h3 class="font-bold text-lg text-white mb-2">Fasilitas</h3>
                            <div class="flex flex-wrap gap-3">
                                @foreach ($fasilitas as $item)
                                    <label class="cursor-pointer">
                                        <input type="checkbox" name="fasilitas[]" value="{{ $item->id }}"
                                            {{ in_array($item->id, request('fasilitas', [])) ? 'checked' : '' }}
                                            class="hidden peer">
                                        <span
                                            class="pill-button inline-block bg-white text-amber-800 hover:bg-amber-50 peer-checked:bg-amber-200 peer-checked:text-amber-900 px-6 py-2 rounded-full text-sm font-medium transition-all duration-300 hover:scale-105 peer-checked:scale-105 peer-checked:shadow-md">
                                            {{ $item->nama_fasilitas }}
                                        </span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Tempat Parkir -->
                        <div class="mb-4">
                            <h3 class="font-bold text-lg text-white mb-2">Tempat parkir</h3>
                            <div class="flex flex-wrap gap-3">
                                @foreach ($tempatParkir as $parkir)
                                    <label class="cursor-pointer">
                                        <input type="radio" name="tempat_parkir" value="{{ $parkir->id }}"
                                            {{ request('tempat_parkir') == $parkir->id ? 'checked' : '' }}
                                            class="hidden peer">
                                        <span
                                            class="pill-button inline-block bg-white text-amber-800 hover:bg-amber-50 peer-checked:bg-amber-200 peer-checked:text-amber-900 px-6 py-2 rounded-full text-sm font-medium transition-all duration-300 hover:scale-105 peer-checked:scale-105 peer-checked:shadow-md">
                                            {{ $parkir->tempat_parkir }}
                                        </span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Divider Line -->
                        <div class="border-t border-white/50 mb-6"></div>

                        <!-- Reset Filter Button -->
                        <div class="flex justify-center">
                            <button type="button" id="clearFilters"
                                class="bg-white hover:bg-gray-100 px-8 py-3 rounded-full font-semibold transition-all duration-300 hover:scale-105 shadow-md hover:shadow-lg"
                                style="color: #7C6A46;">
                                Reset Filter
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Explore Cafe Section -->
    <div class="bg-gray-100 rounded-t-3xl px-4 sm:px-8 lg:px-16 xl:px-24 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900">Explore Our Cafe</h2>
            </div>
            @if (request()->has('search') ||
                    request()->has('harga_menu') ||
                    request()->has('kapasitas_ruang') ||
                    request()->has('tempat_parkir') ||
                    request()->has('fasilitas'))
                <form action="{{ route('cafe.search') }}" method="GET"
                    class="flex flex-wrap gap-2 mt-2 mb-8 justify-start">
                    {{-- Pertahankan filter lain --}}
                    <input type="hidden" name="search" value="{{ request('search') }}">
                    <input type="hidden" name="harga_menu" value="{{ request('harga_menu') }}">
                    <input type="hidden" name="kapasitas_ruang" value="{{ request('kapasitas_ruang') }}">
                    <input type="hidden" name="tempat_parkir" value="{{ request('tempat_parkir') }}">
                    @if (request()->has('fasilitas'))
                        @foreach (request('fasilitas') as $f)
                            <input type="hidden" name="fasilitas[]" value="{{ $f }}">
                        @endforeach
                    @endif
                    @php
                        $jamBukaOptions = [
                            '' => 'Semua',
                            'pagi' => 'Pagi',
                            'siang' => 'Siang',
                            'sore' => 'Sore',
                            '24' => '24 Jam', // Changed from '24_jam' to '24'
                        ];
                    @endphp
                    @foreach ($jamBukaOptions as $val => $label)
                        <button type="submit" name="jam_buka" value="{{ $val }}"
                            class="px-4 py-2 rounded-full border transition {{ request('jam_buka', '') === $val ? 'bg-amber-700 text-white border-amber-700' : '' }}">
                            {{ $label }}
                        </button>
                    @endforeach
                </form>
            @endif
            @if (request()->has('search') ||
                    request()->has('harga_menu') ||
                    request()->has('kapasitas_ruang') ||
                    request()->has('tempat_parkir') ||
                    request()->has('fasilitas'))
                <!-- Grid View for Search Results -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-4 gap-6">
                    @forelse($cafes as $cafe)
                        <div class="cafe-card bg-white rounded-lg overflow-hidden shadow-sm border border-gray-200 h-full flex flex-col transition-all hover:shadow-md p-2"
                            data-cafe-id="{{ $cafe->id }}" data-cafe='@json($cafe)'>
                            <!-- Gambar Cafe - Ratio 4:3 -->
                            <div class="relative p-5" style="padding-bottom: 133.33%;">
                                <img src="{{ asset('storage/' . $cafe->thumbnail) }}" alt="{{ $cafe->nama_cafe }}"
                                    class="absolute inset-0 w-full h-full object-cover rounded-md">
                                <div class="absolute top-2 right-2">
                                    <span class="bg-white/90 text-gray-700 px-2 py-1 rounded-full text-sm font-medium">
                                        ⭐ {{ $cafe->rating ?? '4.0' }}
                                    </span>
                                </div>
                            </div>

                            <!-- Info Cafe -->
                            <div class="p-4 flex flex-col gap-2">
                                <h3 class="font-semibold text-lg text-gray-900 line-clamp-1">{{ $cafe->nama_cafe }}</h3>
                                <p class="text-gray-500 text-sm flex items-start gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mt-0.5 flex-shrink-0">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                    </svg>
                                    <span class="line-clamp-2">{{ $cafe->alamat }}</span>
                                </p>

                                <!-- Label/Tag -->
                                @if ($cafe->labels && $cafe->labels->count() > 0)
                                    <div class="flex flex-wrap gap-1 mt-1">
                                        @foreach ($cafe->labels->take(2) as $label)
                                            <span class="bg-[#7C6A46] text-white px-2 py-1 rounded-full text-xs">
                                                {{ $label->nama_label }}
                                            </span>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-12">
                            <div class="text-gray-400 mb-4">
                                <i class="fas fa-search text-4xl"></i>
                            </div>
                            <p class="text-gray-500 text-lg">Tidak ada hasil ditemukan.</p>
                            <p class="text-gray-400 text-sm mt-2">Coba ubah kriteria pencarian Anda</p>
                        </div>
                    @endforelse
                </div>
                @else
                <!-- Carousel View - Auto Play Only -->
                <div class="relative">
                    <!-- Carousel Container -->
                    <div class="overflow-hidden py-6">
                        <div class="mx-auto max-w-7xl">
                            <div class="relative">
                                <div class="overflow-hidden">
                                    <div id="cafeCarousel" class="flex transition-transform duration-700 gap-6 pb-6">
                                        @foreach ($cafes as $cafe)
                                            <div class="cafe-card bg-white rounded-xl overflow-hidden shadow-sm border border-gray-200 h-full flex flex-col transition-all hover:shadow-md hover:-translate-y-1 p-2"
                                                data-cafe-id="{{ $cafe->id }}"
                                                data-cafe='@json($cafe)'>
                                                <!-- Gambar Cafe - Ratio 3:4 -->
                                                <div class="relative aspect-[3/4] rounded-lg overflow-hidden">
                                                    <img src="{{ asset('storage/' . $cafe->thumbnail) }}"
                                                        alt="{{ $cafe->nama_cafe }}"
                                                        class="absolute inset-0 w-full h-full object-cover transition-transform duration-300 hover:scale-105">
                                                    <div class="absolute top-2 right-2">
                                                        <span
                                                            class="bg-white/90 text-gray-700 px-2 py-1 rounded-full text-sm font-medium backdrop-blur-sm">
                                                            ⭐ {{ $cafe->rating ?? '4.0' }}
                                                        </span>
                                                    </div>
                                                </div>

                                                <!-- Info Cafe -->
                                                <div class="p-4 flex flex-col gap-2">
                                                    <h3 class="font-semibold text-lg text-gray-900 line-clamp-1">
                                                        {{ $cafe->nama_cafe }}</h3>
                                                    <p class="text-gray-500 text-sm flex items-start gap-1">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                            class="w-4 h-4 mt-0.5 flex-shrink-0">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                                        </svg>
                                                        <span class="line-clamp-2">{{ $cafe->alamat }}</span>
                                                    </p>
                                                    <!-- Label/Tag -->
                                                    @if ($cafe->labels && $cafe->labels->count() > 0)
                                                        <div class="flex flex-wrap gap-1 mt-1">
                                                            @foreach ($cafe->labels->take(2) as $label)
                                                                <span
                                                                    class="bg-[#7C6A46] text-white px-2 py-1 rounded-full text-xs">
                                                                    {{ $label->nama_label }}
                                                                </span>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Carousel Indicators - Centered -->
                {{-- <div id="carouselIndicators" class="flex justify-center mt-6 gap-2">
                        @foreach ($chunkedCafes as $slideIndex => $cafeGroup)
                            <button
                                class="indicator-dot w-3 h-3 rounded-full transition-all duration-300 {{ $slideIndex === 0 ? 'bg-amber-600 w-6' : 'bg-gray-300' }}"
                                data-index="{{ $slideIndex }}"></button>
                        @endforeach
                    </div> --}}

                {{-- <div class="indicator-container">
                    @foreach ($chunkedCafes as $slideIndex => $cafeGroup)
                        <div class="indicator-dot {{ $slideIndex === 0 ? 'active' : '' }}"
                            data-index="{{ $slideIndex }}"></div>
                    @endforeach
                </div> --}}
                <div class="indicator-container flex justify-center mt-6 gap-2">
                    @for ($i = 0; $i < max(1, $cafes->count() - 3); $i++)
                        <div class="indicator-dot w-2 h-2 rounded-full transition-all duration-300 {{ $i === 0 ? '' : 'bg-gray-300' }}" data-index="{{ $i }}"></div>
                    @endfor
                </div>
            @endif
        </div>
    </div>


    <!-- Modal Popup -->
    <div id="cafeModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background overlay -->
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>

            <!-- Modal content -->
            <div
                class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <!-- Ubah max-w-2xl menjadi max-w-lg -->
                <div class="bg-white px-4 pt-5 pb-4 sm:p-4 sm:pb-4"> <!-- Kurangi padding pada desktop -->
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 id="modalCafeName" class="text-xl leading-6 font-bold text-gray-900 sm:text-2xl">
                                    </h3> <!-- Ukuran teks lebih kecil -->
                                    <div class="mt-1 flex items-center text-gray-600 sm:mt-2"> <!-- Margin lebih ketat -->
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1 sm:w-5 sm:h-5">
                                            <!-- Icon lebih kecil -->
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                        </svg>
                                        <span id="modalCafeAddress" class="text-xs sm:text-sm"></span>
                                        <!-- Text lebih kecil -->
                                    </div>
                                </div>
                                <button type="button" id="closeModal" class="text-gray-400 hover:text-gray-500">
                                    <svg class="h-5 w-5 sm:h-6 sm:w-6" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor"> <!-- Close icon lebih kecil -->
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>

                            <div class="mt-3 sm:mt-4"> <!-- Margin lebih ketat -->
                                <div class="w-full aspect-[3/4] mx-auto max-w-xs"> <!-- Container gambar lebih kecil -->
                                    <img id="modalCafeImage" src="" alt=""
                                        class="w-full h-full object-cover rounded-lg">
                                </div>

                                <!-- Gallery Section -->
                                <div class="mt-3 sm:mt-4"> <!-- Margin lebih ketat -->
                                    <h4 class="font-semibold text-base sm:text-lg mb-1 sm:mb-2">Galeri</h4>
                                    <!-- Ukuran teks lebih kecil -->
                                    <div id="cafeGallery" class="grid grid-cols-3 gap-1 sm:gap-2">
                                        <!-- Gap lebih kecil -->
                                        <!-- Gallery images will be inserted here by JavaScript -->
                                    </div>
                                </div>

                                <div class="mt-3 grid grid-cols-2 gap-2 sm:gap-4 sm:mt-4">
                                    <!-- Gap dan margin lebih ketat -->
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor"
                                            class="w-4 h-4 mr-1 text-amber-600 sm:w-5 sm:h-5"> <!-- Icon lebih kecil -->
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>
                                        <div>
                                            <p class="text-xs text-gray-500 sm:text-sm">Jam Buka</p>
                                            <!-- Text lebih kecil -->
                                            <p id="modalCafeHours" class="font-medium text-sm sm:text-base"></p>
                                            <!-- Text lebih kecil -->
                                        </div>
                                    </div>
                                    <!-- Repeat similar size adjustments for other info items -->
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor"
                                            class="w-4 h-4 mr-1 text-amber-600 sm:w-5 sm:h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                                        </svg>
                                        <div>
                                            <p class="text-xs text-gray-500 sm:text-sm">Harga Menu</p>
                                            <p id="modalCafePrice" class="font-medium text-sm sm:text-base"></p>
                                        </div>
                                    </div>
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor"
                                            class="w-4 h-4 mr-1 text-amber-600 sm:w-5 sm:h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                        </svg>
                                        <div>
                                            <p class="text-xs text-gray-500 sm:text-sm">Kapasitas</p>
                                            <p id="modalCafeCapacity" class="font-medium text-sm sm:text-base"></p>
                                        </div>
                                    </div>
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor"
                                            class="w-4 h-4 mr-1 text-amber-600 sm:w-5 sm:h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 0 0-10.026 0 1.106 1.106 0 0 0-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                                        </svg>
                                        <div>
                                            <p class="text-xs text-gray-500 sm:text-sm">Parkir</p>
                                            <p id="modalCafeParking" class="font-medium text-sm sm:text-base"></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-4 sm:mt-6"> <!-- Margin lebih ketat -->
                                    <h4 class="font-semibold text-base sm:text-lg mb-1 sm:mb-2">Fasilitas</h4>
                                    <!-- Ukuran teks lebih kecil -->
                                    <div id="modalCafeFacilities" class="flex flex-wrap gap-1 sm:gap-2">
                                        <!-- Gap lebih kecil -->
                                        <!-- Fasilitas akan dimasukkan oleh JavaScript -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-4 sm:py-3 sm:flex sm:flex-row-reverse">
                    <!-- Padding lebih ketat -->
                    <a id="modalCafeMaps" href="#" target="_blank"
                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-3 py-1.5 bg-amber-600 text-sm font-medium text-white hover:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 sm:ml-2 sm:w-auto sm:px-4 sm:py-2">
                        <!-- Button lebih kecil -->
                        Lihat di Maps
                    </a>
                    <button type="button" id="closeModalBtn"
                        class="mt-2 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-3 py-1.5 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 sm:mt-0 sm:ml-2 sm:w-auto sm:px-4 sm:py-2">
                        <!-- Button lebih kecil -->
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
