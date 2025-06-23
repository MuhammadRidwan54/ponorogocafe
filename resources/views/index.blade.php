<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekomendasi Cafe - Ponorogo</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'amber': {
                            50: '#fffbeb',
                            100: '#fef3c7',
                            200: '#fde68a',
                            300: '#fcd34d',
                            400: '#fbbf24',
                            500: '#f59e0b',
                            600: '#d97706',
                            700: '#b45309',
                            800: '#92400e',
                            900: '#78350f',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }
        .filter-chip {
            @apply bg-white/20 text-white px-3 py-2 rounded-full text-sm cursor-pointer transition-all duration-200 hover:bg-white/30;
        }
        .filter-chip.active {
            @apply bg-white text-amber-800;
        }
        .cafe-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .cafe-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
    </style>
</head>
<body class="bg-white min-h-screen">
    <!-- Hero Section -->
    <div class="text-center py-16 px-4">
        <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Rekomendasi Cafe untuk Anda</h1>
        <p class="text-gray-600 text-lg mb-8">Cari rekomendasi cafe sesuai kriteria</p>

        <!-- Search Form -->
        <form action="{{ route('cafe.search') }}" method="GET" class="relative mx-auto w-full max-w-2xl">
            <div class="bg-white rounded-full px-6 py-4 flex items-center shadow-lg border border-gray-200">
                <button type="button" id="toggleFilter" class="text-amber-700 hover:bg-amber-50 rounded-full p-2 mr-3 transition-colors">
                    <i class="fas fa-sliders-h text-lg"></i>
                </button>
                <!-- Chips -->
                <div id="selectedFilters" class="flex flex-wrap gap-2 justify-center mb-6 hidden"></div>
                <input 
                    type="text" 
                    name="search"
                    id="searchInput"
                    placeholder="Cari nama cafe..." 
                    value="{{ request('search') }}"
                    class="w-full flex-1 focus:outline-none text-lg bg-transparent"
                />
                <button type="submit" class="text-amber-700 hover:bg-amber-50 rounded-full p-2 ml-3 transition-colors">
                    <i class="fas fa-search text-lg"></i>
                </button>
            </div>

            <!-- Filter Dropdown -->
            <div id="filterDropdown" class="hidden absolute top-full mt-4 w-full bg-amber-800 text-white rounded-2xl p-6 shadow-xl z-10">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Harga Menu -->
                    <div>
                        <p class="font-bold mb-3 text-white">Harga menu</p>
                        <div class="space-y-2">
                            <label class="flex items-center space-x-2 cursor-pointer">
                                <input type="radio" name="harga_menu" value="1" {{ request('harga_menu') == '1' ? 'checked' : '' }} class="text-amber-600">
                                <span class="text-sm">>10.000k</span>
                            </label>
                            <label class="flex items-center space-x-2 cursor-pointer">
                                <input type="radio" name="harga_menu" value="2" {{ request('harga_menu') == '2' ? 'checked' : '' }} class="text-amber-600">
                                <span class="text-sm">>20.000k</span>
                            </label>
                            <label class="flex items-center space-x-2 cursor-pointer">
                                <input type="radio" name="harga_menu" value="3" {{ request('harga_menu') == '3' ? 'checked' : '' }} class="text-amber-600">
                                <span class="text-sm">>30.000k</span>
                            </label>
                        </div>
                    </div>

                    <!-- Kapasitas -->
                    <div>
                        <p class="font-bold mb-3 text-white">Kapasitas ruang</p>
                        <div class="space-y-2">
                            <label class="flex items-center space-x-2 cursor-pointer">
                                <input type="radio" name="kapasitas_ruang" value="1" {{ request('kapasitas_ruang') == '1' ? 'checked' : '' }} class="text-amber-600">
                                <span class="text-sm"><20 orang</span>
                            </label>
                            <label class="flex items-center space-x-2 cursor-pointer">
                                <input type="radio" name="kapasitas_ruang" value="2" {{ request('kapasitas_ruang') == '2' ? 'checked' : '' }} class="text-amber-600">
                                <span class="text-sm"><50 orang</span>
                            </label>
                            <label class="flex items-center space-x-2 cursor-pointer">
                                <input type="radio" name="kapasitas_ruang" value="3" {{ request('kapasitas_ruang') == '3' ? 'checked' : '' }} class="text-amber-600">
                                <span class="text-sm">>50 orang</span>
                            </label>
                        </div>
                    </div>

                    <!-- Fasilitas -->
                    <div>
                        <p class="font-bold mb-3 text-white">Fasilitas</p>
                        <div class="space-y-2">
                            @foreach ($fasilitas as $item)
                                <label class="flex items-center space-x-2 cursor-pointer">
                                    <input 
                                        type="checkbox" 
                                        name="fasilitas[]" 
                                        value="{{ $item->id }}" 
                                        {{ in_array($item->id, request('fasilitas', [])) ? 'checked' : '' }}
                                        class="text-amber-600"
                                    >
                                    <span class="text-sm">{{ $item->nama_fasilitas }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Tempat Parkir -->
                    <div>
                        <p class="font-bold mb-3 text-white">Tempat parkir</p>
                        <div class="space-y-2">
                            <label class="flex items-center space-x-2 cursor-pointer">
                                <input type="radio" name="tempat_parkir" value="1" {{ request('tempat_parkir') == '1' ? 'checked' : '' }} class="text-amber-600">
                                <span class="text-sm">Luas (motor & mobil)</span>
                            </label>
                            <label class="flex items-center space-x-2 cursor-pointer">
                                <input type="radio" name="tempat_parkir" value="2" {{ request('tempat_parkir') == '2' ? 'checked' : '' }} class="text-amber-600">
                                <span class="text-sm">Kurang Luas (motor)</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Explore Cafe Section -->
    <div class="bg-gray-50 rounded-t-3xl px-6 md:px-12 py-12">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-900">Explore Our Cafe</h2>
            <form action="{{ route('cafe.search') }}" method="GET" class="mt-4 md:mt-0">
                <div class="relative">
                    <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <input 
                        type="text" 
                        name="search" 
                        placeholder="🔍 Pencarian..." 
                        value="{{ request('search') }}"
                        class="pl-10 pr-4 py-2 w-full md:w-64 rounded-full border border-gray-300 focus:border-amber-500 focus:ring-2 focus:ring-amber-200 focus:outline-none transition-all"
                    >
                </div>
            </form>
        </div>

        @if(request()->has('search') || request()->has('harga_menu') || request()->has('kapasitas_ruang') || request()->has('tempat_parkir') || request()->has('fasilitas'))
            <!-- Grid View for Search Results -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
                @forelse($cafes as $cafe)
                    <div class="cafe-card bg-white rounded-xl overflow-hidden shadow-md border border-gray-100">
                        <div class="relative">
                            <img 
                                src="{{ $cafe->image ?? 'https://via.placeholder.com/300x200?text=Cafe+Image' }}" 
                                alt="{{ $cafe->nama }}" 
                                class="w-full h-48 object-cover"
                            >
                            <div class="absolute top-2 right-2">
                                <span class="bg-white/90 text-gray-700 px-2 py-1 rounded-full text-sm font-medium">
                                    ⭐ {{ $cafe->rating ?? '4.0' }}
                                </span>
                            </div>
                        </div>
                        <div class="p-4">
                            <h3 class="font-semibold text-lg text-gray-900 mb-1">{{ $cafe->nama }}</h3>
                            <p class="text-gray-600 text-sm mb-3">{{ $cafe->alamat }}</p>
                            <div class="flex flex-wrap gap-1">
                                @if($cafe->fasilitas)
                                    @foreach($cafe->fasilitas->take(3) as $fasilitas)
                                        <span class="bg-gray-50 text-gray-600 border border-gray-200 px-2 py-1 rounded-full text-xs">
                                            {{ $fasilitas->nama_fasilitas }}
                                        </span>
                                    @endforeach
                                @endif
                            </div>
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
            <!-- Carousel View for Default -->
            <div class="relative">
                <div class="flex overflow-x-auto gap-6 snap-x snap-mandatory pb-6 scrollbar-hide">
                    @foreach($cafes as $cafe)
                        <div class="min-w-[280px] sm:min-w-[300px] snap-center shrink-0">
                            <div class="cafe-card bg-white rounded-xl overflow-hidden shadow-md border border-gray-100">
                                <div class="relative">
                                    <img 
                                        src="{{ $cafe->image ?? 'https://via.placeholder.com/300x200?text=Cafe+Image' }}" 
                                        alt="{{ $cafe->nama }}" 
                                        class="w-full h-48 object-cover"
                                    >
                                    <div class="absolute top-2 right-2">
                                        <span class="bg-white/90 text-gray-700 px-2 py-1 rounded-full text-sm font-medium">
                                            ⭐ {{ $cafe->rating ?? '4.0' }}
                                        </span>
                                    </div>
                                </div>
                                <div class="p-4">
                                    <h3 class="font-semibold text-lg text-gray-900 mb-1">{{ $cafe->nama }}</h3>
                                    <p class="text-gray-600 text-sm mb-3">{{ $cafe->alamat }}</p>
                                    <div class="flex flex-wrap gap-1">
                                        @if($cafe->fasilitas)
                                            @foreach($cafe->fasilitas->take(3) as $fasilitas)
                                                <span class="bg-gray-50 text-gray-600 border border-gray-200 px-2 py-1 rounded-full text-xs">
                                                    {{ $fasilitas->nama_fasilitas }}
                                                </span>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    <!-- Footer -->
    <footer class="bg-white py-12 px-6 border-t border-gray-100">
        <div class="max-w-6xl mx-auto flex flex-col md:flex-row justify-between items-start">
            <div class="mb-6 md:mb-0">
                <h4 class="font-bold text-xl text-gray-900 mb-3">ponorogocafe.id</h4>
                <p class="max-w-xs text-gray-600 leading-relaxed">
                    Platform rekomendasi cafe di Ponorogo, cocok untuk hangout, workspace, dan kuliner.
                </p>
            </div>
            <div>
                <p class="font-semibold text-gray-900 mb-3">Follow Us</p>
                <div class="flex gap-4">
                    <a href="#" class="text-gray-600 hover:text-amber-700 transition-colors p-2 rounded-full hover:bg-amber-50">
                        <i class="fab fa-instagram text-xl"></i>
                    </a>
                    <a href="#" class="text-gray-600 hover:text-amber-700 transition-colors p-2 rounded-full hover:bg-amber-50">
                        <i class="fab fa-tiktok text-xl"></i>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <!-- JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleBtn = document.getElementById('toggleFilter');
            const dropdown = document.getElementById('filterDropdown');
            const selectedFilters = document.getElementById('selectedFilters');

            // Toggle filter dropdown
            if (toggleBtn && dropdown) {
                toggleBtn.addEventListener('click', (e) => {
                    e.preventDefault();
                    dropdown.classList.toggle('hidden');
                });

                // Close dropdown when clicking outside
                document.addEventListener('click', (e) => {
                    if (!toggleBtn.contains(e.target) && !dropdown.contains(e.target)) {
                        dropdown.classList.add('hidden');
                    }
                });
            }

            // Filter labels mapping
            const filterLabels = {
                harga_menu: {
                    '1': '>10.000k',
                    '2': '>20.000k',
                    '3': '>30.000k'
                },
                kapasitas_ruang: {
                    '1': '<20 orang',
                    '2': '<50 orang',
                    '3': '>50 orang'
                },
                tempat_parkir: {
                    '1': 'Luas (motor & mobil)',
                    '2': 'Kurang Luas (motor)'
                }
            };

            function updateSelectedFilters() {
                selectedFilters.innerHTML = '';
                const activeFilters = [];

                // Check radio buttons
                ['harga_menu', 'kapasitas_ruang', 'tempat_parkir'].forEach(name => {
                    const checked = document.querySelector(`input[name="${name}"]:checked`);
                    if (checked) {
                        activeFilters.push({
                            name: name,
                            value: checked.value,
                            label: filterLabels[name][checked.value],
                            element: checked
                        });
                    }
                });

                // Check checkboxes (fasilitas)
                const checkedFasilitas = document.querySelectorAll('input[name="fasilitas[]"]:checked');
                checkedFasilitas.forEach(checkbox => {
                    const label = checkbox.parentElement.querySelector('span').textContent;
                    activeFilters.push({
                        name: 'fasilitas',
                        value: checkbox.value,
                        label: label,
                        element: checkbox
                    });
                });

                // --- Tambahan: sembunyikan input search jika ada filter aktif ---
                const searchInput = document.getElementById('searchInput');
                if (activeFilters.length === 0) {
                    selectedFilters.classList.add('hidden');
                    if (searchInput) searchInput.classList.remove('hidden');
                    return;
                } else {
                    if (searchInput) searchInput.classList.add('hidden');
                }

                // Create filter chips
                activeFilters.forEach(filter => {
                    const chip = document.createElement('div');
                    chip.className = 'bg-amber-100 text-amber-800 border border-amber-200 px-3 py-1 rounded-full flex items-center gap-2 text-sm';
                    chip.innerHTML = `
                        <span>${filter.label}</span>
                        <button type="button" class="text-amber-600 hover:text-amber-800 font-bold text-lg leading-none" onclick="clearFilter('${filter.name}', '${filter.value}')">
                            ×
                        </button>
                    `;
                    selectedFilters.appendChild(chip);
                });

                selectedFilters.classList.remove('hidden');
            }

            // Clear filter function
            window.clearFilter = function(name, value) {
                if (name === 'fasilitas') {
                    const checkbox = document.querySelector(`input[name="fasilitas[]"][value="${value}"]`);
                    if (checkbox) checkbox.checked = false;
                } else {
                    const radio = document.querySelector(`input[name="${name}"][value="${value}"]`);
                    if (radio) radio.checked = false;
                }
                updateSelectedFilters();
            };

            // Listen for changes on all filter inputs
            document.querySelectorAll('input[type="radio"], input[type="checkbox"]').forEach(input => {
                input.addEventListener('change', updateSelectedFilters);
            });

            // // Listen for changes on all filter inputs (langsung otomatis submit)
            // document.querySelectorAll('input[type="radio"], input[type="checkbox"]').forEach(input => {
            //     input.addEventListener('change', function() {
            //         updateSelectedFilters();
            //         this.closest('form').submit();
            //     });
            // });

            // Initialize on page load
            updateSelectedFilters();

            // Smooth scroll for carousel
            const carousel = document.querySelector('.overflow-x-auto');
            if (carousel) {
                carousel.style.scrollBehavior = 'smooth';
            }

            // Add loading state to search forms
            document.querySelectorAll('form').forEach(form => {
                form.addEventListener('submit', function() {
                    const submitBtn = form.querySelector('button[type="submit"]');
                    if (submitBtn) {
                        const originalContent = submitBtn.innerHTML;
                        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
                        submitBtn.disabled = true;
                        
                        // Re-enable after 3 seconds (fallback)
                        setTimeout(() => {
                            submitBtn.innerHTML = originalContent;
                            submitBtn.disabled = false;
                        }, 3000);
                    }
                });
            });
        });
    </script>
</body>
</html>