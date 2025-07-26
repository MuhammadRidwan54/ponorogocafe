@extends('layouts-user.app')

@section('title', 'Rekomendasi Cafe - Ponorogo')

@section('content')
    <!-- Hero Section - Mobile Optimized -->
    <div class="bg-gradient-to-b from-amber-50 to-white">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center py-6 md:py-12">
                <h1 class="text-xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-3 md:mb-6 leading-tight">
                    Rekomendasi Cafe untuk Anda
                </h1>
                <p class="text-gray-600 text-sm md:text-lg mb-6 md:mb-10 max-w-2xl mx-auto">
                    Cari rekomendasi cafe sesuai kriteria
                </p>

                <!-- Modern Search Form -->
                <form action="{{ route('cafe.search') }}" method="GET" class="relative mx-auto w-full max-w-4xl">
                    <div
                        class="bg-white rounded-2xl p-3 md:p-4 flex items-center justify-between shadow-lg border border-gray-200">
                        <!-- Filter Toggle Button -->
                        <div class="flex items-center gap-2">
                            <button type="button" id="toggleFilter"
                                class="text-[#996207] hover:bg-gray-100 rounded-xl p-2 transition-all duration-300 flex-shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4" />
                                </svg>
                            </button>
                            <!-- Selected Filters Chips -->
                            <div id="selectedFilters" class="flex flex-wrap gap-1 hidden"></div>
                        </div>

                        <!-- Search Input -->
                        <input type="text" name="search" id="searchInput" placeholder="Cari cafe..."
                            value="{{ request('search') }}"
                            class="flex-1 bg-transparent border-none outline-none text-sm md:text-base px-2 text-gray-700" />

                        <!-- Search Button -->
                        <button type="submit"
                            class="bg-[#996207] hover:bg-[#996207] text-white rounded-xl px-4 py-2 transition-all duration-300 hover:scale-105 shadow-md flex-shrink-0">
                            <span class="text-sm font-medium">Cari</span>
                        </button>
                    </div>

                    <!-- Filter Dropdown -->
                    <div id="filterDropdown"
                        class="hidden absolute top-full mt-3 w-full bg-[#996207] text-white rounded-2xl p-4 md:p-6 shadow-2xl z-20">
                        <!-- Harga Menu -->
                        <div class="mb-4">
                            <h3 class="font-semibold text-sm md:text-base text-white mb-2">Harga menu</h3>
                            <div class="flex flex-wrap gap-2">
                                @foreach ($hargamenu as $menu)
                                    <label class="cursor-pointer">
                                        <input type="radio" name="harga_menu" value="{{ $menu->id }}"
                                            {{ request('harga_menu') == $menu->id ? 'checked' : '' }} class="hidden peer">
                                        <span
                                            class="inline-block bg-white text-[#996207] hover:bg-gray-50 peer-checked:bg-gray-200 peer-checked:text-[#6b5a3d] px-3 py-1.5 rounded-full text-xs md:text-sm font-medium transition-all duration-300 hover:scale-105 peer-checked:scale-105">
                                            {{ $menu->harga_menu }}
                                        </span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Kapasitas Ruang -->
                        <div class="mb-4">
                            <h3 class="font-semibold text-sm md:text-base text-white mb-2">Kapasitas ruang</h3>
                            <div class="flex flex-wrap gap-2">
                                @foreach ($kapasitasruang as $kapasitas)
                                    <label class="cursor-pointer">
                                        <input type="radio" name="kapasitas_ruang" value="{{ $kapasitas->id }}"
                                            {{ request('kapasitas_ruang') == $kapasitas->id ? 'checked' : '' }}
                                            class="hidden peer">
                                        <span
                                            class="inline-block bg-white text-[#996207] hover:bg-gray-50 peer-checked:bg-gray-200 peer-checked:text-[#6b5a3d] px-3 py-1.5 rounded-full text-xs md:text-sm font-medium transition-all duration-300 hover:scale-105 peer-checked:scale-105">
                                            {{ $kapasitas->kapasitas_ruang }}
                                        </span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Fasilitas -->
                        <div class="mb-4">
                            <h3 class="font-semibold text-sm md:text-base text-white mb-2">Fasilitas</h3>
                            <div class="flex flex-wrap gap-2">
                                @foreach ($fasilitas as $item)
                                    <label class="cursor-pointer">
                                        <input type="checkbox" name="fasilitas[]" value="{{ $item->id }}"
                                            {{ in_array($item->id, request('fasilitas', [])) ? 'checked' : '' }}
                                            class="hidden peer">
                                        <span
                                            class="inline-block bg-white text-[#996207] hover:bg-gray-50 peer-checked:bg-gray-200 peer-checked:text-[#6b5a3d] px-3 py-1.5 rounded-full text-xs md:text-sm font-medium transition-all duration-300 hover:scale-105 peer-checked:scale-105">
                                            {{ $item->nama_fasilitas }}
                                        </span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Tempat Parkir -->
                        <div class="mb-4">
                            <h3 class="font-semibold text-sm md:text-base text-white mb-2">Tempat parkir</h3>
                            <div class="flex flex-wrap gap-2">
                                @foreach ($tempatParkir as $parkir)
                                    <label class="cursor-pointer">
                                        <input type="radio" name="tempat_parkir" value="{{ $parkir->id }}"
                                            {{ request('tempat_parkir') == $parkir->id ? 'checked' : '' }}
                                            class="hidden peer">
                                        <span
                                            class="inline-block bg-white text-[#996207] hover:bg-gray-50 peer-checked:bg-gray-200 peer-checked:text-[#6b5a3d] px-3 py-1.5 rounded-full text-xs md:text-sm font-medium transition-all duration-300 hover:scale-105 peer-checked:scale-105">
                                            {{ $parkir->tempat_parkir }}
                                        </span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Reset Button -->
                        <div class="flex justify-center pt-2 border-t border-white/20">
                            <button type="button" id="clearFilters"
                                class="bg-white hover:bg-gray-100 text-[#996207] px-6 py-2 rounded-full text-sm font-semibold transition-all duration-300 hover:scale-105">
                                Reset Filter
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Cafe Section -->
    <div class="bg-gray-50 rounded-t-3xl px-6 py-6 md:py-10">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4 md:mb-6">
                <h2 class="text-lg md:text-2xl font-bold text-gray-900 mb-2 md:mb-0">Explore Our Cafe</h2>
            </div>

            @if (request()->has('search') ||
                    request()->has('harga_menu') ||
                    request()->has('kapasitas_ruang') ||
                    request()->has('fasilitas') ||
                    request()->has('tempat_parkir')
                )
                <!-- Time Filter Buttons -->
                <form action="{{ route('cafe.search') }}" method="GET" class="flex flex-wrap gap-2 mb-4 md:mb-6">
                    <input type="hidden" name="search" value="{{ request('search') }}">
                    <input type="hidden" name="harga_menu" value="{{ request('harga_menu') }}">
                    <input type="hidden" name="kapasitas_ruang" value="{{ request('kapasitas_ruang') }}">
                    
                    @if (request()->has('fasilitas'))
                        @foreach (request('fasilitas') as $f)
                            <input type="hidden" name="fasilitas[]" value="{{ $f }}">
                        @endforeach
                    @endif

                    <input type="hidden" name="tempat_parkir" value="{{ request('tempat_parkir') }}">

                    @php
                        $jamBukaOptions = [
                            '' => 'Semua',
                            'pagi' => 'Pagi',
                            'siang' => 'Siang',
                            'sore' => 'Sore',
                            '24' => '24 Jam',
                        ];
                    @endphp

                    @foreach ($jamBukaOptions as $val => $label)
                        <button type="submit" name="jam_buka" value="{{ $val }}"
                            class="px-3 py-1.5 rounded-full border text-xs md:text-sm transition-all duration-300 {{ request('jam_buka', '') == $val ? 'bg-[#996207] text-white border-[#996207]' : 'bg-white text-gray-700 border-gray-300 hover:border-[#996207] hover:text-[#996207]' }}">
                            {{ $label }}
                        </button>
                    @endforeach
                </form>
                <!-- Keterangan waktu buka -->
                @if (request('jam_buka') === 'pagi')
                    <div class="flex align-middle items-start text-xs text-gray-600 gap-1 mb-4">
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M13 16h-1v-4h-1m1-4h.01M12 20a8 8 0 100-16 8 8 0 000 16z" />
                        </svg>
                        <span>Jam buka mulai pagi hari, antara pukul <strong>07.00 - 10.59 WIB</strong></span>
                    </div>
                @elseif (request('jam_buka') === 'siang')
                    <div class="flex align-middle items-start text-xs text-gray-600 gap-1 mb-4">
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M13 16h-1v-4h-1m1-4h.01M12 20a8 8 0 100-16 8 8 0 000 16z" />
                        </svg>
                        <span>Jam buka mulai siang hari, antara pukul <strong>11.00 - 14.59 WIB</strong></span>
                    </div>
                @elseif (request('jam_buka') === 'sore')
                    <div class="flex align-middle items-start text-xs text-gray-600 gap-1 mb-4">
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M13 16h-1v-4h-1m1-4h.01M12 20a8 8 0 100-16 8 8 0 000 16z" />
                        </svg>
                        <span>Jam buka mulai sore hari, antara pukul <strong>15.00 - 18.00 WIB</strong></span>
                    </div>
                @elseif (request('jam_buka') === '24')
                    <div class="flex align-middle items-start text-xs text-gray-600 gap-1 mb-4">
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M13 16h-1v-4h-1m1-4h.01M12 20a8 8 0 100-16 8 8 0 000 16z" />
                        </svg>
                        <span>Jam buka <strong>24 jam nonstop</strong> setiap hari</span>
                    </div>
                @endif

                <!-- Grid View for Search Results -->
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-3 md:gap-4">
                    @forelse($cafes as $cafeIndex => $cafe)
                        <div class="cafe-card lazy-load bg-white rounded-xl overflow-hidden shadow-sm border border-gray-200 p-2 transition-all duration-300 hover:shadow-lg hover:-translate-y-1"
                            data-cafe-id="{{ $cafe->id }}"
                            data-cafe='@json($cafe)'
                            onclick="openCafeModal(@js($cafe))"
                            onclick="handleCardClick(event, @js($cafe))">
                            <!-- Cafe Image with Lazy Loading -->
                            <div class="relative aspect-[3/4] rounded-md overflow-hidden progressive-image">
                                <!-- Shimmer Placeholder -->
                                <div
                                    class="placeholder absolute inset-0 bg-gradient-to-r from-gray-200 via-gray-300 to-gray-200 animate-pulse">
                                    <div class="flex items-center justify-center h-full">
                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                </div>

                                <!-- Lazy Loaded Image -->
                                <img data-src="{{ asset('storage/' . $cafe->thumbnail) }}" alt="{{ $cafe->nama_cafe }}"
                                    class="lazy-image w-full h-full object-cover opacity-0 transition-opacity duration-500"
                                    loading="lazy">

                                <!-- SAW Score and Ranking Badge -->
                                <div class="absolute bottom-2 left-2 z-10 flex flex-col gap-1">
                                    <span class="bg-white text-[#996207] px-2 py-1 rounded-full text-xs font-bold shadow-sm">
                                        Ranking #{{ $cafeIndex + 1 }}
                                    </span>
                                </div>

                                <!-- Resize Icon Badge -->
                                <div class="absolute top-2 right-2 z-10">
                                    <span
                                        class="bg-black bg-opacity-50 backdrop-blur-sm text-white px-1 py-1 rounded-full text-xs font-medium shadow-sm flex items-center">
                                        <!-- Heroicons: Arrows Pointing Out (resize/maximize) -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 8V4h4M20 16v4h-4M4 16v4h4M20 8V4h-4" />
                                        </svg>
                                    </span>
                                </div>
                            </div>

                            <!-- Cafe Info -->
                            <div class="p-2 md:p-3">
                                <h3 class="font-semibold text-sm md:text-base text-gray-900 line-clamp-1 mb-1">
                                    {{ $cafe->nama_cafe }}</h3>
                                <p class="text-gray-500 text-xs md:text-sm flex items-start gap-1 mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mt-0.5 flex-shrink-0">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                    </svg>
                                    <span class="line-clamp-2">{{ $cafe->alamat }}</span>
                                </p>

                                <!-- Labels Section -->
                                @if ($cafe->labels && $cafe->labels->count() > 0)
                                    <div class="flex flex-wrap gap-1">
                                        @foreach ($cafe->labels->take(3) as $label)
                                            <span class="bg-[#996207] text-white px-2 py-0.5 rounded-full text-[10px]">
                                                {{ $label->nama_label }}
                                            </span>
                                        @endforeach
                                        
                                        @if ($cafe->labels->count() > 3)
                                            <span class="bg-gray-200 text-gray-700 px-2 py-0.5 rounded-full text-[10px]">
                                                +{{ $cafe->labels->count() - 3 }}
                                            </span>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-8">
                            <div class="text-gray-400 mb-3">
                                <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                            <p class="text-gray-500 text-sm md:text-base">Tidak ada hasil ditemukan.</p>
                            <p class="text-gray-400 text-xs md:text-sm mt-1">Coba ubah kriteria pencarian Anda</p>
                        </div>
                    @endforelse
                </div>
            @else
                <!-- Carousel View -->
                <div class="relative">
                    <div class="overflow-hidden">
                        <div id="cafeCarousel" class="flex transition-transform duration-700 gap-3 md:gap-4 pb-4">
                            @foreach ($cafes as $index => $cafe)
                                <div class="cafe-card lazy-load bg-white rounded-xl overflow-hidden shadow-sm border border-gray-200 p-2 transition-all duration-300 hover:shadow-lg hover:-translate-y-1 min-w-[160px] md:min-w-[240px]"
                                    data-cafe-id="{{ $cafe->id }}"
                                    data-cafe='@json($cafe)'
                                    onclick="openCafeModal(@js($cafe))"
                                    onclick="handleCardClick(event, @js($cafe))
                                    style="animation-delay: {{ $index * 0.1 }}s">
                                    <!-- Cafe Image with Lazy Loading -->
                                    <div class="relative aspect-[3/4] rounded-md overflow-hidden progressive-image">
                                        <!-- Shimmer Placeholder -->
                                        <div
                                            class="placeholder absolute inset-0 bg-gradient-to-r from-gray-200 via-gray-300 to-gray-200 animate-pulse">
                                            <div class="flex items-center justify-center h-full">
                                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                        </div>

                                        <!-- Lazy Loaded Image -->
                                        <img data-src="{{ asset('storage/' . $cafe->thumbnail) }}"
                                            alt="{{ $cafe->nama_cafe }}"
                                            class="lazy-image w-full h-full object-cover opacity-0 transition-all duration-500 hover:scale-105"
                                            loading="lazy">

                                        <!-- Resize Icon Badge -->
                                        <div class="absolute top-2 right-2 z-10">
                                            <span
                                                class="bg-black bg-opacity-50 backdrop-blur-sm text-white px-1 py-1 rounded-full text-xs font-medium shadow-sm flex items-center">
                                                <!-- Heroicons: Arrows Pointing Out (resize/maximize) -->
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M4 8V4h4M20 16v4h-4M4 16v4h4M20 8V4h-4" />
                                                </svg>
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Cafe Info -->
                                    <div class="p-2 md:p-3">
                                        <h3 class="font-semibold text-sm md:text-base text-gray-900 line-clamp-1 mb-1">
                                            {{ $cafe->nama_cafe }}</h3>
                                        <p class="text-gray-500 text-xs md:text-sm flex items-start gap-1 mb-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor"
                                                class="w-4 h-4 mt-0.5 flex-shrink-0">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                            </svg>
                                            <span class="line-clamp-2">{{ $cafe->alamat }}</span>
                                        </p>

                                        <!-- Labels Section -->
                                        @if ($cafe->labels && $cafe->labels->count() > 0)
                                            <div class="flex flex-wrap gap-1">
                                                @foreach ($cafe->labels->take(3) as $label)
                                                    <span class="bg-[#996207] text-white px-2 py-0.5 rounded-full text-[10px]">
                                                        {{ $label->nama_label }}
                                                    </span>
                                                @endforeach
                                                
                                                @if ($cafe->labels->count() > 3)
                                                    <span class="bg-gray-200 text-gray-700 px-2 py-0.5 rounded-full text-[10px]">
                                                        +{{ $cafe->labels->count() - 3 }}
                                                    </span>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Spring Elastic Indicator (New Addition) -->
                <div class="flex justify-center mb-8">
                    <div class="relative flex items-center gap-2 px-8 py-4 bg-gray-50 rounded-full">
                        <!-- Left indicators -->
                        @for ($i = 0; $i < 2; $i++)
                            <div class="w-2 h-2 rounded-full bg-gray-300 transition-all duration-500"></div>
                        @endfor

                        <!-- Spring elastic center -->
                        <div class="relative mx-2">
                            <div id="spring-indicator"
                                class="w-8 h-2 bg-[#996207] rounded-full transition-all duration-500 relative spring-indicator">
                                <!-- Spring coil effect -->
                                <div id="spring-coil"
                                    class="absolute inset-0 bg-gradient-to-r from-[#996207] via-[#A0916D] via-[#996207] via-[#A0916D] to-[#996207] rounded-full opacity-0 transition-opacity duration-300">
                                </div>
                            </div>
                        </div>

                        <!-- Right indicators -->
                        @for ($i = 0; $i < 2; $i++)
                            <div class="w-2 h-2 rounded-full bg-gray-300 transition-all duration-500"></div>
                        @endfor
                    </div>
                </div>
            @endif

        @if (session('success'))
            <!-- Modern Success Notification Popup -->
            <!-- Modern Success Notification Popup -->
            <div id="notification" class="fixed top-4 sm:top-[70px] left-1/2 transform -translate-x-1/2 -translate-y-full bg-white bg-opacity-70 backdrop-blur-md border border-white border-opacity-20 text-black p-3 rounded-lg shadow-lg z-50 transition-all duration-300 flex items-start w-[calc(100%-2rem)] sm:max-w-md sm:w-full">
                <div class="flex-shrink-0">
                    <img src="{{ asset('logo_pocaf.png') }}" alt="Admin" class="h-8 w-8 rounded-full object-cover">
                </div>
                <div class="ml-3 flex-1 overflow-hidden">
                    <div class="flex items-center justify-between w-full">
                        <p class="text-sm font-semibold truncate">Admin</p>
                        <span class="text-xs text-right text-gray-500 whitespace-nowrap">{{ now()->format('h:i A') }}</span>
                    </div>
                    <p class="text-sm text-gray-800 mt-1 break-words">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <!-- Modal Popup -->
        <!-- Modal Popup -->
        @foreach($cafes as $cafe)
            <div id="cafeModal-{{ $cafe->id }}" class="fixed inset-0 z-50 hidden overflow-y-auto">
                <!-- Backdrop - Only this area should close the modal when clicked -->
                <div class="fixed inset-0 transition-opacity backdrop-blur-sm" aria-hidden="true">
                    <div class="absolute inset-0 opacity-75"></div>
                </div>

                <!-- Modal Content - Wrapped in modal-content class -->
                <div class="modal-content flex items-center justify-center min-h-screen pt-4 px-4 pb-4 text-center sm:block sm:p-0">
                    <div class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-md md:max-w-4xl lg:max-w-5xl sm:w-full mx-2 sm:mx-0">
                        <!-- Rest of your modal content remains exactly the same -->
                        <div class="bg-white px-4 pt-4 pb-4 sm:p-6 sm:pb-4">
                            <div class="sm:flex sm:items-start">
                                <div class="text-center sm:mt-0 sm:ml-0 sm:text-left w-full">

                                    <!-- Main Content Area - Horizontal on Desktop, Vertical on Mobile -->
                                    <div class="flex flex-col md:flex-row md:gap-6">
                                        <!-- Image Section -->
                                        <div class="md:w-1/2 md:flex-shrink-0">
                                            <div class="w-full aspect-[3/4] mx-auto max-w-sm md:max-w-none relative">
                                                <img id="modalCafeImage" src="/placeholder.svg" alt=""
                                                    class="w-full h-full object-cover rounded-lg">

                                                <!-- Close Button - Top Left on Image -->
                                                <button type="button" onclick="closeModal('cafeModal-{{ $cafe->id }}')"
                                                    class="absolute top-2 left-2 bg-black bg-opacity-50 text-white hover:bg-opacity-70 rounded-full p-2 transition-all duration-200 md:hidden">
                                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                                        stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M15 19l-7-7 7-7" />
                                                    </svg>
                                                </button>

                                                <!-- Overlay for both Mobile and Desktop -->
                                                <div
                                                    class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/100 via-black/60 to-transparent text-white px-4 pb-4 pt-10 rounded-b-lg">
                                                    <h3 id="modalCafeName" class="text-lg md:text-xl text-left font-bold mb-1">
                                                    </h3>
                                                    <div class="flex items-start text-sm md:text-base">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                            class="w-4 h-4 md:w-5 md:h-5 mr-1 flex-shrink-0">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                                        </svg>
                                                        <span id="modalCafeAddress" class="text-left line-clamp-2"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Content Section -->
                                        <div class="mt-4 md:mt-0 md:w-1/2 md:flex-shrink-0 md:pr-6">
                                            <!-- Information Title -->
                                            <div class="mb-2">
                                                <h4 class="text-lg font-semibold text-left text-gray-900">Information</h4>
                                            </div>

                                            <div class="grid grid-cols-2 gap-3">
                                                <div class="flex items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                        stroke-width="1.5" stroke="currentColor"
                                                        class="w-4 h-4 mr-1 text-[#996207] flex-shrink-0">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                    </svg>
                                                    <div>
                                                        <p class="text-xs text-left text-gray-500">Jam Buka</p>
                                                        <p id="modalCafeHours" class="font-medium text-sm"></p>
                                                    </div>
                                                </div>
                                                <div class="flex items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                        stroke-width="1.5" stroke="currentColor"
                                                        class="w-4 h-4 mr-1 text-[#996207] flex-shrink-0">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                                                    </svg>
                                                    <div>
                                                        <p class="text-xs text-left text-gray-500">Kapasitas Motor</p>
                                                        <p id="modalCafeMotor" class="text-left font-medium text-sm"></p>
                                                    </div>
                                                </div>
                                                <div class="flex items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                        stroke-width="1.5" stroke="currentColor"
                                                        class="w-4 h-4 mr-1 text-[#996207] flex-shrink-0">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                                    </svg>
                                                    <div>
                                                        <p class="text-xs text-left text-gray-500">Kapasitas Mobil</p>
                                                        <p id="modalCafeMobil" class="text-left font-medium text-sm"></p>
                                                    </div>
                                                </div>
                                                <div class="flex items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                        stroke-width="1.5" stroke="currentColor"
                                                        class="w-4 h-4 mr-1 text-[#996207] flex-shrink-0">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 0 0-10.026 0 1.106 1.106 0 0 0-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                                                    </svg>
                                                    <div>
                                                        <p class="text-xs text-left text-gray-500">Mushola</p>
                                                        <p id="modalCafeMushola" class="text-left font-medium text-sm"></p>
                                                    </div>
                                                </div>
                                                <div class="flex items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                        stroke-width="1.5" stroke="currentColor"
                                                        class="w-4 h-4 mr-1 text-[#996207] flex-shrink-0">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 0 0-10.026 0 1.106 1.106 0 0 0-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                                                    </svg>
                                                    <div>
                                                        <p class="text-xs text-left text-gray-500">Toilet</p>
                                                        <p id="modalCafeToilet" class="text-left font-medium text-sm"></p>
                                                    </div>
                                                </div>
                                                <!-- Instagram Link -->
                                                <div id="modalCafeInstagram" class="hidden mt-3 cursor-pointer inline-flex items-center">
                                                    <i class="fab fa-instagram mr-2 w-4 h-4 text-[#996207]"></i>
                                                    <span class="text-[#996207] text-sm font-medium">Instagram</span>
                                                </div>
                                            </div>

                                            <div class="mt-4">
                                                <h4 class="font-semibold text-left text-base mb-2">Fasilitas</h4>
                                                <div id="modalCafeFacilities" class="flex flex-wrap gap-2">
                                                    <!-- Fasilitas akan dimasukkan oleh JavaScript -->
                                                </div>
                                            </div>

                                            <!-- Gallery Section -->
                                            <div class="mt-4">
                                                <h4 class="font-semibold text-left text-base mb-2">Galeri</h4>
                                                <div id="cafeGallery" class="flex gap-2 overflow-x-auto pb-2">
                                                    <!-- Gallery images will be inserted here by JavaScript -->
                                                </div>
                                            </div>

                                            {{-- Komentar --}}
                                            <div class="mt-6">
                                                <div class="flex items-center gap-2 mb-4">
                                                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                                    </svg>
                                                    <h4 class="font-semibold text-lg text-gray-800">Komentar</h4>
                                                    <span class="text-sm text-gray-500 bg-gray-100 px-2 py-1 rounded-full">
                                                        {{ $cafe->komentar->where('disetujui', true)->count() }}
                                                    </span>
                                                </div>

                                                <!-- Comments List -->
                                                <div class="space-y-3 mb-6">
                                                    @if ($cafe->komentar->where('disetujui', true)->count())
                                                        @foreach ($cafe->komentar->where('disetujui', true) as $komen)
                                                            <div class="bg-white border border-gray-100 rounded-lg p-4 shadow-sm hover:shadow-md transition-shadow duration-200">
                                                                <div class="flex items-start justify-between gap-3">
                                                                    <div class="flex-1 min-w-0">
                                                                        <div class="flex items-center gap-2 mb-2">
                                                                            <div class="w-8 h-8 bg-gradient-to-br from-[#996207] to-[#8B7355] rounded-full flex items-center justify-center text-white text-sm font-medium">
                                                                                {{ strtoupper(substr($komen->nama, 0, 1)) }}
                                                                            </div>
                                                                            <div class="flex-1 min-w-0">
                                                                                <p class="font-medium text-left text-gray-900 text-sm truncate">{{ $komen->nama }}</p>
                                                                                <p class="text-xs text-left text-gray-500">{{ $komen->created_at->diffForHumans() }}</p>
                                                                            </div>
                                                                        </div>
                                                                        <p class="text-gray-700 text-left text-sm leading-relaxed">{{ $komen->isi_komentar }}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        <div class="text-center py-8 bg-gray-50 rounded-lg border-2 border-dashed border-gray-200">
                                                            <svg class="w-12 h-12 text-gray-400 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                                            </svg>
                                                            <p class="text-gray-500 text-sm">Belum ada komentar</p>
                                                            <p class="text-gray-400 text-xs mt-1">Jadilah yang pertama memberikan komentar</p>
                                                        </div>
                                                    @endif
                                                </div>

                                                <!-- Comment Form -->
                                                <div class="comment-form comment-section no-modal-trigger ignore-modal bg-gray-50 rounded-lg p-4 border border-gray-200">
                                                    <form action="{{ route('komentar.store') }}" method="POST" class="comment-form" id="commentForm-{{ $cafe->id }}" onsubmit="submitComment(event, {{ $cafe->id }})">
                                                        @csrf
                                                        <input type="hidden" name="cafe_id" value="{{ $cafe->id }}">

                                                        <div class="flex items-center gap-2 mb-3">
                                                            <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                                            </svg>
                                                            <label class="text-sm font-medium text-gray-700">Tambah Komentar</label>
                                                        </div>

                                                        <div class="space-y-3">
                                                            <div>
                                                                <textarea 
                                                                    name="isi_komentar" 
                                                                    rows="3"
                                                                    placeholder="Tulis komentar Anda tentang cafe ini..."
                                                                    class=" no-modal-trigger w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#996207] focus:border-transparent transition-colors resize-none"
                                                                    required
                                                                ></textarea>
                                                            </div>
                                                        </div>

                                                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 pt-2">
                                                            <p class="text-xs text-gray-500">
                                                                <svg class="w-3 h-3 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                                </svg>
                                                                Komentar akan ditampilkan setelah disetujui
                                                            </p>
                                                            <button 
                                                                type="submit" 
                                                                class="bg-[#996207] hover:bg-[#996207] text-white px-4 py-2 rounded-md text-sm font-medium transition-colors duration-200 flex items-center gap-2 justify-center sm:justify-start"
                                                            >
                                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                                                </svg>
                                                                Kirim Komentar
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse gap-2">
                            <a id="modalCafeMaps-{{ $cafe->id }}" href="{{ $cafe->alamat_url ?? '#' }}" 
                                target="_blank" rel="noopener noreferrer"
                                class="w-full inline-flex justify-center rounded-xl border border-transparent shadow-sm px-4 py-2 bg-[#996207] text-sm font-medium text-white hover:bg-[#996207] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#996207] sm:w-auto">
                                Lihat di Maps
                            </a>
                            <button type="button" onclick="closeModal('cafeModal-{{ $cafe->id }}')"
                                class="mt-2 sm:mt-0 w-full inline-flex justify-center rounded-xl border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#996207] sm:w-auto">
                                Tutup
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        </div>
    </div>
@endsection
