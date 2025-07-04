@extends('layouts.app')

@section('title', 'Daftar Cafe - PonorogoCafe')
@section('header-title', 'Daftar Cafe')
@section('header-description', 'Kelola daftar cafe yang tersedia di PonorogoCafe')

@section('content')
    <div class="bg-white rounded-xl shadow-md">
        <div class="p-4 lg:p-6">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-6">
                <h1 class="text-xl lg:text-2xl font-bold text-gray-900">Daftar Cafe</h1>
                <button onclick="openModal('create')"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-lg flex items-center justify-center space-x-2 shadow-sm transition-all duration-200 text-sm font-medium">
                    <i class="fas fa-plus"></i>
                    <span>Tambah Cafe</span>
                </button>
            </div>

            <!-- Search Input -->
            <div class="mb-6">
                <div class="relative max-w-md">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                    <input type="text" id="searchInput" placeholder="Cari berdasarkan nama cafe..."
                        class="pl-10 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        value="{{ request('search') }}">
                    @if(request('search'))
                        <button type="button" onclick="clearSearch()" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <i class="fas fa-times text-gray-400 hover:text-gray-600"></i>
                        </button>
                    @endif
                </div>
            </div>

            <!-- Success Message -->
            @if (session('success'))
                <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg mb-6" role="alert">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle mr-2"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-3 lg:px-6 py-3 lg:py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <div class="flex items-center space-x-2">
                                    <span>No</span>
                                    <span class="text-gray-400">•</span>
                                    <span>Thumbnail</span>
                                </div>
                            </th>
                            <th class="px-3 lg:px-6 py-3 lg:py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <div class="flex items-center space-x-1">
                                    <i class="fas fa-store text-gray-400"></i>
                                    <span>Informasi Cafe</span>
                                </div>
                                <div class="text-xs text-gray-400 normal-case mt-1">Nama, Alamat & Maps</div>
                            </th>
                            <th class="px-3 lg:px-6 py-3 lg:py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <div class="flex items-center space-x-1">
                                    <i class="fas fa-tags text-gray-400"></i>
                                    <span>Fasilitas & Label</span>
                                </div>
                                <div class="text-xs text-gray-400 normal-case mt-1">Kategori & Fitur</div>
                            </th>
                            <th class="px-3 lg:px-6 py-3 lg:py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <div class="flex items-center space-x-1">
                                    <i class="fas fa-info-circle text-gray-400"></i>
                                    <span>Detail Cafe</span>
                                </div>
                                <div class="text-xs text-gray-400 normal-case mt-1">Harga, Kapasitas, Parkir, Jam</div>
                            </th>
                            <th class="px-3 lg:px-6 py-3 lg:py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                <div class="flex items-center space-x-1">
                                    <i class="fas fa-cog text-gray-400"></i>
                                    <span>Aksi</span>
                                </div>
                                <div class="text-xs text-gray-400 normal-case mt-1">Edit & Hapus</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200" id="cafeTableBody">
                         @include('cafe._table', ['cafe' => $cafe])
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Cafe Detail Modal -->
    <div id="cafeDetailModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-hidden flex flex-col">
            <!-- Header -->
            <div class="bg-[#7C6A46] px-4 sm:px-6 py-4 sm:py-6 text-white relative flex-shrink-0">
                <button onclick="closeCafeDetail()" class="absolute top-4 right-4 text-white hover:text-amber-100 transition-colors duration-200 p-1 rounded-lg hover:bg-white hover:bg-opacity-20">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
                <div class="flex items-center space-x-3 sm:space-x-4">
                    <div class="w-12 h-12 sm:w-14 sm:h-14 bg-white bg-opacity-20 rounded-xl flex items-center justify-center backdrop-blur-sm">
                        <svg class="w-6 h-6 sm:w-7 sm:h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 id="detailCafeName" class="text-xl sm:text-2xl font-bold">Nama Cafe</h2>
                        <p class="text-amber-100 text-sm sm:text-base">Detail Informasi Cafe</p>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="flex-1 overflow-y-auto max-h-[calc(100vh-140px)] scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-gray-100">
                <div class="p-4 sm:p-6 pb-8 space-y-6">
                    <!-- Image Gallery -->
                    <div class="bg-white rounded-2xl p-4 sm:p-6 shadow-sm border border-gray-100">
                        <h3 class="text-lg sm:text-xl font-semibold mb-4 flex items-center text-gray-900">
                            <svg class="w-5 h-5 mr-3 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            Galeri Foto
                        </h3>
                        <div id="detailImageGallery" class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-4">
                            <!-- Images will be inserted here -->
                        </div>
                    </div>

                    <!-- Basic Information -->
                    <div class="grid gap-4 sm:gap-6 lg:grid-cols-2">
                        <!-- Location Info -->
                        <div class="bg-white rounded-2xl p-4 sm:p-6 shadow-sm border border-gray-100">
                            <h3 class="text-lg sm:text-xl font-semibold mb-4 flex items-center text-gray-900">
                                <svg class="w-5 h-5 mr-3 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                Lokasi
                            </h3>
                            <div class="space-y-3">
                                <p id="detailAddress" class="text-gray-600 text-sm sm:text-base leading-relaxed"></p>
                                <div id="detailMapLink" class="hidden">
                                    <a id="detailMapUrl" href="#" target="_blank" 
                                    class="inline-flex items-center text-primary-600 hover:text-primary-700 text-sm font-medium transition-colors duration-200">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                        </svg>
                                        Buka di Google Maps
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Operating Details -->
                        <div class="bg-white rounded-2xl p-4 sm:p-6 shadow-sm border border-gray-100">
                            <h3 class="text-lg sm:text-xl font-semibold mb-4 flex items-center text-gray-900">
                                <svg class="w-5 h-5 mr-3 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Detail Operasional
                            </h3>
                            <div class="space-y-4">
                                <div class="flex items-center justify-between py-2 border-b border-gray-100 last:border-b-0">
                                    <span class="text-sm sm:text-base text-gray-600 flex items-center">
                                        <svg class="w-4 h-4 mr-3 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                        </svg>
                                        Harga Menu
                                    </span>
                                    <span id="detailPrice" class="text-sm sm:text-base font-semibold text-gray-900">-</span>
                                </div>
                                <div class="flex items-center justify-between py-2 border-b border-gray-100 last:border-b-0">
                                    <span class="text-sm sm:text-base text-gray-600 flex items-center">
                                        <svg class="w-4 h-4 mr-3 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                        </svg>
                                        Kapasitas
                                    </span>
                                    <span id="detailCapacity" class="text-sm sm:text-base font-semibold text-gray-900">-</span>
                                </div>
                                <div class="flex items-center justify-between py-2 border-b border-gray-100 last:border-b-0">
                                    <span class="text-sm sm:text-base text-gray-600 flex items-center">
                                        <svg class="w-4 h-4 mr-3 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                        </svg>
                                        Parkir
                                    </span>
                                    <span id="detailParking" class="text-sm sm:text-base font-semibold text-gray-900">-</span>
                                </div>
                                <div class="flex items-center justify-between py-2 border-b border-gray-100 last:border-b-0">
                                    <span class="text-sm sm:text-base text-gray-600 flex items-center">
                                        <svg class="w-4 h-4 mr-3 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Jam Buka
                                    </span>
                                    <span id="detailHours" class="text-sm sm:text-base font-semibold text-gray-900">-</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Facilities & Labels -->
                    <div class="grid gap-4 sm:gap-6 lg:grid-cols-2">
                        <!-- Facilities -->
                        <div class="bg-white rounded-2xl p-4 sm:p-6 shadow-sm border border-gray-100">
                            <h3 class="text-lg sm:text-xl font-semibold mb-4 flex items-center text-gray-900">
                                <svg class="w-5 h-5 mr-3 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0"></path>
                                </svg>
                                Fasilitas
                            </h3>
                            <div id="detailFacilities" class="flex flex-wrap gap-2">
                                <!-- Facilities will be inserted here -->
                            </div>
                        </div>

                        <!-- Labels -->
                        <div class="bg-white rounded-2xl p-4 sm:p-6 shadow-sm border border-gray-100">
                            <h3 class="text-lg sm:text-xl font-semibold mb-4 flex items-center text-gray-900">
                                <svg class="w-5 h-5 mr-3 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                                Label
                            </h3>
                            <div id="detailLabels" class="flex flex-wrap gap-2">
                                <!-- Labels will be inserted here -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Image Preview Modal -->
    <div id="imagePreviewModal" class="fixed inset-0 bg-black bg-opacity-75 hidden z-50 flex items-center justify-center p-4">
        <div class="relative max-w-4xl max-h-full">
            <button onclick="closeImagePreview()" class="absolute top-4 right-4 text-white hover:text-gray-300 z-10">
                <i class="fas fa-times text-2xl"></i>
            </button>
            <img id="previewImage" src="/placeholder.svg" alt="" class="max-w-full max-h-full object-contain rounded-lg">
            <div id="previewTitle" class="absolute bottom-4 left-4 text-white bg-black bg-opacity-50 px-3 py-1 rounded"></div>
        </div>
    </div>

    <!-- Gallery Modal -->
    <div id="galleryModal" class="fixed inset-0 bg-black bg-opacity-75 hidden z-50 flex items-center justify-center p-4">
        <div class="relative max-w-6xl max-h-full w-full">
            <div class="bg-white rounded-lg p-4">
                <div class="flex justify-between items-center mb-4">
                    <h3 id="galleryTitle" class="text-lg font-semibold"></h3>
                    <button onclick="closeGallery()" class="text-gray-500 hover:text-gray-700">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                <div id="galleryImages" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 max-h-96 overflow-y-auto">
                    <!-- Images will be inserted here -->
                </div>
            </div>
        </div>
    </div>


    <!-- Create/Edit Modal -->
    <div id="cafeModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50 p-4">
        <div class="relative top-10 lg:top-20 mx-auto border w-full max-w-4xl shadow-xl rounded-xl bg-white">
            <div class="p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-gray-900" id="modalTitle">Tambah Cafe</h3>
                    <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600 p-1 rounded-lg hover:bg-gray-100">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                
                <form id="cafeForm" method="POST" enctype="multipart/form-data">
                    <div id="modalContent">
                        <!-- Content will be loaded here -->
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Global data for dropdowns and facilities
        const globalData = {
            fasilitas: @json($fasilitas),
            jambuka: @json($jambuka),
            hargamenu: @json($hargamenu),
            kapasitasruang: @json($kapasitasruang),
            tempatparkir: @json($tempatparkir),
            labels: @json($labels),
        };

        // Search functionality
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            let searchTimer;
            
            // Real-time search with debounce
            searchInput.addEventListener('input', function() {
                clearTimeout(searchTimer);
                searchTimer = setTimeout(function() {
                    performSearch(searchInput.value.trim());
                }, 500); // 500ms delay after typing stops
            });

            // Clear search
            window.clearSearch = function() {
                searchInput.value = '';
                performSearch('');
            };
        });

        function performSearch(searchTerm) {
            const url = new URL(window.location.href);
            if (searchTerm) {
                url.searchParams.set('search', searchTerm);
            } else {
                url.searchParams.delete('search');
            }

            fetch(url.pathname + '?' + url.searchParams.toString(), {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.text())
            .then(html => {
                document.getElementById('cafeTableBody').innerHTML = html; // <-- Ganti di sini
            })
            .catch(error => console.error('Error:', error));
        }

        let currentCafeData = null;

        function showCafeDetail(cafeData) {
            currentCafeData = cafeData;
            
            // Set basic info
            document.getElementById('detailCafeName').textContent = cafeData.nama_cafe;
            document.getElementById('detailAddress').textContent = cafeData.alamat;
            
            // Set map link
            const mapLinkDiv = document.getElementById('detailMapLink');
            const mapUrl = document.getElementById('detailMapUrl');
            if (cafeData.alamat_url) {
                mapUrl.href = cafeData.alamat_url;
                mapLinkDiv.classList.remove('hidden');
            } else {
                mapLinkDiv.classList.add('hidden');
            }
            
            // Set operational details
            document.getElementById('detailPrice').textContent = cafeData.harga_menu || 'Tidak ada data';
            document.getElementById('detailCapacity').textContent = cafeData.kapasitas_ruang || 'Tidak ada data';
            document.getElementById('detailParking').textContent = cafeData.tempat_parkir || 'Tidak ada data';
            document.getElementById('detailHours').textContent = cafeData.jam_buka || 'Tidak ada data';
            
            // Set image gallery
            const galleryContainer = document.getElementById('detailImageGallery');
            galleryContainer.innerHTML = '';
            
            // Add thumbnail first
            const thumbnailImg = document.createElement('img');
            thumbnailImg.src = `{{ asset('storage/') }}/${cafeData.thumbnail}`;
            thumbnailImg.alt = cafeData.nama_cafe;
            thumbnailImg.className = 'w-full h-24 object-cover rounded-lg cursor-pointer hover:opacity-75 transition-opacity border-2 border-amber-300';
            thumbnailImg.onclick = () => showImagePreview(thumbnailImg.src, cafeData.nama_cafe);
            galleryContainer.appendChild(thumbnailImg);
            
            // Add other images
            if (cafeData.gambar && cafeData.gambar.length > 0) {
                cafeData.gambar.forEach(image => {
                    const img = document.createElement('img');
                    img.src = `{{ asset('storage/') }}/${image}`;
                    img.alt = cafeData.nama_cafe;
                    img.className = 'w-full h-24 object-cover rounded-lg cursor-pointer hover:opacity-75 transition-opacity';
                    img.onclick = () => showImagePreview(img.src, cafeData.nama_cafe);
                    galleryContainer.appendChild(img);
                });
            }
            
            // Set facilities
            const facilitiesContainer = document.getElementById('detailFacilities');
            facilitiesContainer.innerHTML = '';
            if (cafeData.fasilitas && cafeData.fasilitas.length > 0) {
                cafeData.fasilitas.forEach(facility => {
                    const span = document.createElement('span');
                    span.className = 'inline-flex items-center px-3 py-1 rounded-full text-sm bg-purple-100 text-purple-800 border border-purple-200';
                    span.innerHTML = `<i class="fas fa-wifi mr-2"></i>${facility.nama}`;
                    facilitiesContainer.appendChild(span);
                });
            } else {
                facilitiesContainer.innerHTML = '<span class="text-gray-500 text-sm">Tidak ada fasilitas</span>';
            }
            
            // Set labels
            const labelsContainer = document.getElementById('detailLabels');
            labelsContainer.innerHTML = '';
            if (cafeData.labels && cafeData.labels.length > 0) {
                cafeData.labels.forEach(label => {
                    const span = document.createElement('span');
                    span.className = 'inline-flex items-center px-3 py-1 rounded-full text-sm bg-amber-100 text-amber-800 border border-amber-200';
                    span.innerHTML = `<i class="fas fa-tag mr-2"></i>${label.nama}`;
                    labelsContainer.appendChild(span);
                });
            } else {
                labelsContainer.innerHTML = '<span class="text-gray-500 text-sm">Tidak ada label</span>';
            }
            
            // Show modal
            document.getElementById('cafeDetailModal').classList.remove('hidden');
        }

        function closeCafeDetail() {
            document.getElementById('cafeDetailModal').classList.add('hidden');
            currentCafeData = null;
        }

        function editFromDetail() {
            if (currentCafeData) {
                closeCafeDetail();
                openModal('', currentCafeData.id);
            }
        }

        function showImagePreview(src, title) {
            document.getElementById('previewImage').src = src;
            document.getElementById('previewTitle').textContent = title;
            document.getElementById('imagePreviewModal').classList.remove('hidden');
        }

        function closeImagePreview() {
            document.getElementById('imagePreviewModal').classList.add('hidden');
        }

        function showGallery(images, title) {
            document.getElementById('galleryTitle').textContent = `Galeri - ${title}`;
            const container = document.getElementById('galleryImages');
            container.innerHTML = '';
            
            images.forEach(image => {
                const img = document.createElement('img');
                img.src = `{{ asset('storage/') }}/${image}`;
                img.alt = title;
                img.className = 'w-full h-32 object-cover rounded-lg cursor-pointer hover:opacity-75 transition-opacity';
                img.onclick = () => showImagePreview(img.src, title);
                container.appendChild(img);
            });
            
            document.getElementById('galleryModal').classList.remove('hidden');
        }

        function closeGallery() {
            document.getElementById('galleryModal').classList.add('hidden');
        }

        // Close modals when clicking outside
        document.getElementById('cafeDetailModal').addEventListener('click', function(e) {
            if (e.target === this) closeCafeDetail();
        });

        document.getElementById('imagePreviewModal').addEventListener('click', function(e) {
            if (e.target === this) closeImagePreview();
        });

        document.getElementById('galleryModal').addEventListener('click', function(e) {
            if (e.target === this) closeGallery();
        });

        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                if (!document.getElementById('cafeDetailModal').classList.contains('hidden')) {
                    closeCafeDetail();
                } else if (!document.getElementById('imagePreviewModal').classList.contains('hidden')) {
                    closeImagePreview();
                } else if (!document.getElementById('galleryModal').classList.contains('hidden')) {
                    closeGallery();
                }
            }
        });

        function openModal(action, id = null, button = null) {
            const modal = document.getElementById('cafeModal');
            const title = document.getElementById('modalTitle');
            const form = document.getElementById('cafeForm');
            const modalContent = document.getElementById('modalContent');

            if (action === 'create') {
                title.textContent = 'Tambah Cafe';
                form.action = "{{ route('cafe.store') }}";
                modalContent.innerHTML = `
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">Nama Cafe *</label>
                            <input type="text" name="nama_cafe" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                        </div>
                        
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">Alamat URL</label>
                            <input type="url" name="alamat_url"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="https://maps.google.com/...">
                        </div>

                        <div class="md:col-span-2 space-y-2">
                            <label class="block text-sm font-medium text-gray-700">Alamat *</label>
                            <textarea name="alamat" rows="3" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required></textarea>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">Jam Buka *</label>
                            <select name="jambuka_id" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                                <option value="">Pilih Jam Buka</option>
                                ${globalData.jambuka.map(jb => `<option value="${jb.id}">${jb.jam_buka}</option>`).join('')}
                            </select>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">Harga Menu *</label>
                            <select name="hargamenu_id" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                                <option value="">Pilih Harga Menu</option>
                                ${globalData.hargamenu.map(hm => `<option value="${hm.id}">${hm.harga_menu}</option>`).join('')}
                            </select>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">Kapasitas Ruang *</label>
                            <select name="kapasitasruang_id" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                                <option value="">Pilih Kapasitas Ruang</option>
                                ${globalData.kapasitasruang.map(kr => `<option value="${kr.id}">${kr.kapasitas_ruang}</option>`).join('')}
                            </select>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">Tempat Parkir *</label>
                            <select name="tempatparkir_id" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                                <option value="">Pilih Tempat Parkir</option>
                                ${globalData.tempatparkir.map(tp => `<option value="${tp.id}">${tp.tempat_parkir}</option>`).join('')}
                            </select>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">Thumbnail *</label>
                            <input type="file" name="thumbnail" accept="image/*" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                            <div id="thumbnailPreview" class="mt-2 flex space-x-2"></div>
                        </div>
                        
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">Gambar</label>
                            <div id="imageInputs">
                                <div class="image-input-group flex items-center space-x-2 mb-2">
                                    <input type="file" name="gambar[]" accept="image/*" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <button type="button" onclick="removeImageInput(this)" class="text-red-600 hover:text-red-800 p-2 rounded-lg hover:bg-red-50">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                            <div id="imagesPreview" class="mt-2 flex space-x-2 overflow-x-auto"></div>
                            <button type="button" onclick="addImageInput()" 
                                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg mt-2 text-sm font-medium">
                                Tambah Gambar Lain
                            </button>
                            <p class="text-sm text-gray-500 mt-1">Dapat memilih lebih dari satu gambar</p>
                        </div>
                    </div>

                    <div class="mt-6 space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-3">Fasilitas</label>
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                                ${globalData.fasilitas.map(f => `
                                    <div class="flex items-center">
                                        <input type="checkbox" name="fasilitas_id[]" value="${f.id}" id="fasilitas${f.id}" 
                                            class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                        <label for="fasilitas${f.id}" class="ml-2 text-sm text-gray-700">${f.nama_fasilitas}</label>
                                    </div>
                                `).join('')}
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-3">Label</label>
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                                ${globalData.labels.map(l => `
                                    <div class="flex items-center">
                                        <input type="checkbox" name="label_id[]" value="${l.id}" id="label${l.id}" 
                                            class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                        <label for="label${l.id}" class="ml-2 text-sm text-gray-700">${l.nama_label}</label>
                                    </div>
                                `).join('')}
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end space-x-3 pt-6 border-t border-gray-200 mt-6">
                        <button type="button" onclick="closeModal()" 
                            class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-6 py-2.5 rounded-lg transition-colors text-sm font-medium">
                            Batal
                        </button>
                        <button type="submit" 
                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-lg transition-colors text-sm font-medium">
                            Simpan
                        </button>
                    </div>
                `;
            } else if (action === 'edit') {
                let cafe = null;
                if (button) {
                    cafe = JSON.parse(button.getAttribute('data-cafe'));
                } else if (typeof currentCafeData === 'object' && currentCafeData && currentCafeData.id == id) {
                    cafe = currentCafeData;
                } else {
                    alert('Data cafe tidak ditemukan.');
                    return;
                }
                title.textContent = 'Edit Cafe';
                form.action = `/cafe/${cafe.id}`;
                modalContent.innerHTML = `
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">Nama Cafe *</label>
                            <input type="text" name="nama_cafe" value="${cafe.nama_cafe.replace(/"/g, '&quot;')}" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                        </div>
                        
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">Alamat URL</label>
                            <input type="url" name="alamat_url" value="${cafe.alamat_url ? cafe.alamat_url : ''}" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="https://maps.google.com/...">
                        </div>

                        <div class="md:col-span-2 space-y-2">
                            <label class="block text-sm font-medium text-gray-700">Alamat *</label>
                            <textarea name="alamat" rows="3" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>${cafe.alamat.replace(/"/g, '&quot;')}</textarea>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">Jam Buka *</label>
                            <select name="jambuka_id" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                                <option value="">Pilih Jam Buka</option>
                                ${globalData.jambuka.map(jb => `<option value="${jb.id}" ${cafe.jambuka_id == jb.id ? 'selected' : ''}>${jb.jam_buka}</option>`).join('')}
                            </select>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">Harga Menu *</label>
                            <select name="hargamenu_id" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                                <option value="">Pilih Harga Menu</option>
                                ${globalData.hargamenu.map(hm => `<option value="${hm.id}" ${cafe.hargamenu_id == hm.id ? 'selected' : ''}>${hm.harga_menu}</option>`).join('')}
                            </select>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">Kapasitas Ruang *</label>
                            <select name="kapasitasruang_id" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                                <option value="">Pilih Kapasitas Ruang</option>
                                ${globalData.kapasitasruang.map(kr => `<option value="${kr.id}" ${cafe.kapasitasruang_id == kr.id ? 'selected' : ''}>${kr.kapasitas_ruang}</option>`).join('')}
                            </select>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">Tempat Parkir *</label>
                            <select name="tempatparkir_id" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                                <option value="">Pilih Tempat Parkir</option>
                                ${globalData.tempatparkir.map(tp => `<option value="${tp.id}" ${cafe.tempatparkir_id == tp.id ? 'selected' : ''}>${tp.tempat_parkir}</option>`).join('')}
                            </select>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">Thumbnail</label>
                            <input type="file" name="thumbnail" accept="image/*" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <div id="thumbnailPreview" class="mt-2 flex space-x-2">
                                ${cafe.thumbnail ? `
                                    <div class="relative">
                                        <img src="{{ asset('storage/') }}/${cafe.thumbnail}" class="h-16 w-16 object-cover rounded-lg border border-gray-200">
                                        <p class="text-sm text-gray-500 mt-1">Thumbnail saat ini</p>
                                    </div>
                                ` : ''}
                            </div>
                        </div>
                        
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">Gambar</label>
                            <div id="imageInputs">
                                <div class="image-input-group flex items-center space-x-2 mb-2">
                                    <input type="file" name="gambar[]" accept="image/*" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <button type="button" onclick="removeImageInput(this)" class="text-red-600 hover:text-red-800 p-2 rounded-lg hover:bg-red-50">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                            <div id="imagesPreview" class="mt-2 flex space-x-2 overflow-x-auto">
                                ${cafe.gambar && JSON.parse(cafe.gambar).length > 0 ? 
                                    JSON.parse(cafe.gambar).map(gambar => `
                                        <div class="relative">
                                            <img src="{{ asset('storage/') }}/${gambar}" class="h-16 w-16 object-cover rounded-lg border border-gray-200">
                                            <p class="text-sm text-gray-500 mt-1">Gambar saat ini</p>
                                        </div>
                                    `).join('')
                                : ''}
                            </div>
                            <button type="button" onclick="addImageInput()" 
                                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg mt-2 text-sm font-medium">
                                Tambah Gambar Lain
                            </button>
                            <p class="text-sm text-gray-500 mt-1">Dapat memilih lebih dari satu gambar</p>
                        </div>
                    </div>

                    <div class="mt-6 space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-3">Fasilitas</label>
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                                ${globalData.fasilitas.map(f => `
                                    <div class="flex items-center">
                                        <input type="checkbox" name="fasilitas_id[]" value="${f.id}" id="fasilitas${f.id}" 
                                            class="rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                                            ${cafe.fasilitas.includes(f.id) ? 'checked' : ''}>
                                        <label for="fasilitas${f.id}" class="ml-2 text-sm text-gray-700">${f.nama_fasilitas}</label>
                                    </div>
                                `).join('')}
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-3">Label</label>
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                                ${globalData.labels.map(l => `
                                    <div class="flex items-center">
                                        <input type="checkbox" name="label_id[]" value="${l.id}" id="label${l.id}" 
                                            class="rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                                            ${cafe.labels && cafe.labels.includes(l.id) ? 'checked' : ''}>
                                        <label for="label${l.id}" class="ml-2 text-sm text-gray-700">${l.nama_label}</label>
                                    </div>
                                `).join('')}
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end space-x-3 pt-6 border-t border-gray-200 mt-6">
                        <button type="button" onclick="closeModal()" 
                            class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-6 py-2.5 rounded-lg transition-colors text-sm font-medium">
                            Batal
                        </button>
                        <button type="submit" 
                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-lg transition-colors text-sm font-medium">
                            Simpan
                        </button>
                    </div>
                `;
            }

            modal.classList.remove('hidden');
            initializeImageInputs();
            initializeImagePreviews();
        }

        function closeModal() {
            const modal = document.getElementById('cafeModal');
            modal.classList.add('hidden');
            // Clear previews when closing modal
            const thumbnailPreview = document.getElementById('thumbnailPreview');
            const imagesPreview = document.getElementById('imagesPreview');
            if (thumbnailPreview) thumbnailPreview.innerHTML = '';
            if (imagesPreview) imagesPreview.innerHTML = '';
        }

        function addImageInput() {
            const imageInputs = document.getElementById('imageInputs');
            const newInputGroup = document.createElement('div');
            newInputGroup.className = 'image-input-group flex items-center space-x-2 mb-2';
            newInputGroup.innerHTML = `
            <input type="file" name="gambar[]" accept="image/*" 
                class="w-full px-3 lg:px-4 py-2 lg:py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-brown-500 focus:border-transparent">
            <button type="button" onclick="removeImageInput(this)" class="text-red-600 hover:text-red-900">
                <i class="fas fa-trash"></i>
            </button>
        `;
            imageInputs.appendChild(newInputGroup);
            initializeImagePreviews(); // Reinitialize previews for new input
        }

        function removeImageInput(button) {
            const imageInputs = document.getElementById('imageInputs');
            if (imageInputs.children.length > 1) {
                const inputGroup = button.parentElement;
                const input = inputGroup.querySelector('input[type="file"]');
                if (input && input.dataset.previewId) {
                    const preview = document.getElementById(input.dataset.previewId);
                    if (preview) preview.remove();
                }
                inputGroup.remove();
            } else {
                alert('Minimal satu input gambar harus ada.');
            }
        }

        function initializeImageInputs() {
            const imageInputs = document.getElementById('imageInputs');
            if (imageInputs) {
                const inputs = imageInputs.getElementsByClassName('image-input-group');
                if (inputs.length === 0) {
                    addImageInput();
                }
            }
        }

        function initializeImagePreviews() {
            const thumbnailInput = document.querySelector('input[name="thumbnail"]');
            const imageInputs = document.querySelectorAll('input[name="gambar[]"]');

            // Thumbnail preview
            if (thumbnailInput) {
                thumbnailInput.removeEventListener('change', handleThumbnailPreview); // Prevent multiple listeners
                thumbnailInput.addEventListener('change', handleThumbnailPreview);
            }

            // Multiple images preview
            imageInputs.forEach((input, index) => {
                input.removeEventListener('change', handleImagePreview); // Prevent multiple listeners
                input.dataset.previewId = `preview-${index}-${Date.now()}`; // Unique ID for each input
                input.addEventListener('change', handleImagePreview);
            });
        }

        function handleThumbnailPreview(event) {
            const input = event.target;
            const previewContainer = document.getElementById('thumbnailPreview');
            // Clear previous previews, keeping existing thumbnail if in edit mode
            previewContainer.innerHTML = previewContainer.querySelector('div.relative') ? previewContainer.innerHTML : '';

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('div');
                    img.innerHTML = `
                    <img src="${e.target.result}" class="h-16 w-16 object-cover rounded-lg">
                    <p class="text-sm text-gray-500 mt-1">Pratinjau</p>
                `;
                    previewContainer.appendChild(img);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function handleImagePreview(event) {
            const input = event.target;
            const previewContainer = document.getElementById('imagesPreview');
            const previewId = input.dataset.previewId;

            // Remove existing preview for this input
            const existingPreview = document.getElementById(previewId);
            if (existingPreview) existingPreview.remove();

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('div');
                    img.id = previewId;
                    img.innerHTML = `
                    <img src="${e.target.result}" class="h-16 w-16 object-cover rounded-lg">
                    <p class="text-sm text-gray-500 mt-1">Pratinjau</p>
                `;
                    previewContainer.appendChild(img);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('cafeModal');
            const modalContent = document.querySelector('#cafeModal .relative');

            if (modal && modalContent) {
                modal.addEventListener('mousedown', function(e) {
                    if (!modalContent.contains(e.target)) {
                        closeModal();
                    }
                });
            }
        });
    </script>

@endsection
