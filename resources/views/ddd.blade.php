<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekomendasi Cafe - Ponorogo</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

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
    
   
</div>
        </div>
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
                    <a href="#"
                        class="text-gray-600 hover:text-amber-700 transition-colors p-2 rounded-full hover:bg-amber-50">
                        <i class="fab fa-instagram text-xl"></i>
                    </a>
                    <a href="#"
                        class="text-gray-600 hover:text-amber-700 transition-colors p-2 rounded-full hover:bg-amber-50">
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
                    @foreach ($hargamenu as $menu)
                        '{{ $menu->id }}': '{{ $menu->harga_menu }}',
                    @endforeach
                },
                kapasitas_ruang: {
                    @foreach ($kapasitasruang as $kapasitas)
                        '{{ $kapasitas->id }}': '{{ $kapasitas->kapasitas_ruang }}',
                    @endforeach
                },
                tempat_parkir: {
                    @foreach ($tempatParkir as $parkir)
                        '{{ $parkir->id }}': '{{ $parkir->tempat_parkir }}',
                    @endforeach
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
                    chip.className =
                        'bg-amber-100 text-amber-800 border border-amber-200 px-3 py-1 rounded-full flex items-center gap-2 text-sm';
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

            // Validasi: harus ada kriteria dipilih sebelum submit
            const searchForm = document.querySelector('form[action="{{ route('cafe.search') }}"]');
            if (searchForm) {
                searchForm.addEventListener('submit', function(e) {
                    // Cek apakah ada filter radio/checkbox yang dipilih
                    const radioChecked = searchForm.querySelector('input[type="radio"]:checked');
                    const checkboxChecked = searchForm.querySelector('input[type="checkbox"]:checked');
                    if (!radioChecked && !checkboxChecked) {
                        e.preventDefault();
                        alert('Silakan pilih minimal satu kriteria pencarian (filter) terlebih dahulu.');
                        return false;
                    }
                });
            }

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

        const cafeModal = document.getElementById('cafeModal');
        const closeModal = document.getElementById('closeModal');
        const closeModalBtn = document.getElementById('closeModalBtn');

        // Function to open modal with cafe data
        function openCafeModal(cafeData) {
            // Fill modal with cafe data
            document.getElementById('modalCafeName').textContent = cafeData.nama_cafe;
            document.getElementById('modalCafeAddress').textContent = cafeData.alamat;
            document.getElementById('modalCafeImage').src = '{{ asset('storage') }}/' + cafeData.thumbnail;
            document.getElementById('modalCafeImage').alt = cafeData.nama_cafe;

            // Handle relational data with null checks
            document.getElementById('modalCafeHours').textContent = cafeData.jambuka?.jam_buka || 'Tidak diketahui';
            document.getElementById('modalCafePrice').textContent = cafeData.hargamenu?.harga_menu || 'Tidak diketahui';
            document.getElementById('modalCafeCapacity').textContent = cafeData.kapasitasruang?.kapasitas_ruang ||
                'Tidak diketahui';
            document.getElementById('modalCafeParking').textContent = cafeData.tempatparkir?.tempat_parkir ||
                'Tidak diketahui';

            // Google Maps link
            document.getElementById('modalCafeMaps').href = cafeData.alamat_url ||
                `https://www.google.com/maps/search/?api=1&query=${encodeURIComponent(cafeData.nama_cafe + ' ' + cafeData.alamat)}`;

            // Facilities
            const facilitiesContainer = document.getElementById('modalCafeFacilities');
            facilitiesContainer.innerHTML = '';

            if (cafeData.fasilitas?.length > 0) {
                cafeData.fasilitas.forEach(facility => {
                    const facilityBadge = document.createElement('span');
                    facilityBadge.className = 'bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-xs';
                    facilityBadge.textContent = facility.nama_fasilitas;
                    facilitiesContainer.appendChild(facilityBadge);
                });
            } else {
                const noFacility = document.createElement('span');
                noFacility.className = 'text-gray-500 text-sm';
                noFacility.textContent = 'Tidak ada fasilitas tersedia';
                facilitiesContainer.appendChild(noFacility);
            }

            // Gallery Images
            const galleryContainer = document.getElementById('cafeGallery');
            galleryContainer.innerHTML = '';

            // Di dalam fungsi openCafeModal, setelah bagian galleryContainer.innerHTML = '';
            // Di dalam fungsi openCafeModal
            if (cafeData.gambar && cafeData.gambar.length > 0) {
                let images = cafeData.gambar;
                if (typeof cafeData.gambar === 'string') {
                    try {
                        images = JSON.parse(cafeData.gambar);
                    } catch (e) {
                        console.error('Error parsing gambar JSON:', e);
                        images = [];
                    }
                }

                if (images.length > 0) {
                    const mainImage = document.getElementById('modalCafeImage');
                    let activeIndex = -1; // Awalnya tidak ada yang aktif

                    // Fungsi untuk mengubah gambar utama
                    const changeMainImage = (imagePath, index) => {
                        // Jika klik thumbnail yang sama, toggle outline
                        if (activeIndex === index) {
                            activeIndex = -1; // Nonaktifkan outline
                        } else {
                            activeIndex = index; // Aktifkan outline
                            mainImage.classList.add('opacity-0');

                            setTimeout(() => {
                                mainImage.src = '{{ asset('storage') }}/' + imagePath;
                                mainImage.onload = () => {
                                    mainImage.classList.remove('opacity-0');
                                };
                            }, 150);
                        }

                        // Update tampilan thumbnail
                        document.querySelectorAll('.gallery-thumbnail').forEach((thumb, i) => {
                            thumb.classList.toggle('thumbnail-active', i === activeIndex);
                            thumb.classList.toggle('thumbnail-inactive', i !== activeIndex);
                        });
                    };

                    // Style untuk thumbnail
                    const style = document.createElement('style');
                    style.textContent = `
            .thumbnail-active {
                outline: 2px solid #f59e0b;
                outline-offset: 2px;
                opacity: 1;
                transform: scale(1.02);
            }
            .thumbnail-inactive {
                opacity: 0.8;
            }
            .thumbnail-inactive:hover {
                opacity: 1;
            }
        `;
                    document.head.appendChild(style);

                    // Buat thumbnail
                    images.forEach((image, index) => {
                        const thumbnail = document.createElement('img');
                        thumbnail.src = '{{ asset('storage') }}/' + image;
                        thumbnail.alt = `Thumbnail ${index + 1}`;
                        thumbnail.className =
                            'gallery-thumbnail w-full h-24 object-cover rounded-lg cursor-pointer transition-all thumbnail-inactive';

                        thumbnail.addEventListener('click', (e) => {
                            e.stopPropagation();
                            changeMainImage(image, index);
                        });

                        galleryContainer.appendChild(thumbnail);
                    });
                } else {
                    showNoGalleryMessage(galleryContainer);
                }
            } else {
                showNoGalleryMessage(galleryContainer);
            }

            // Show modal
            cafeModal.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');

            // Add event listener for outside click
            setTimeout(() => {
                document.addEventListener('click', handleClickOutside);
            }, 0);
        }

        function showNoGalleryMessage(container) {
            const noImagesMsg = document.createElement('div');
            noImagesMsg.className = 'col-span-3 flex flex-col items-center justify-center py-4 text-gray-500';
            noImagesMsg.innerHTML = `
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
        </svg>
        <span class="text-sm">Tidak ada galeri tersedia</span>
    `;
            container.appendChild(noImagesMsg);
        }

        // Function to close modal
        function closeCafeModal() {
            cafeModal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
            document.removeEventListener('click', handleClickOutside);
        }

        // Handle click outside modal
        function handleClickOutside(event) {
            if (!event.target.closest('#cafeModal') && !event.target.closest('.cafe-card')) {
                closeCafeModal();
            }
        }

        // Event listeners for closing modal
        if (closeModal) closeModal.addEventListener('click', closeCafeModal);
        if (closeModalBtn) closeModalBtn.addEventListener('click', closeCafeModal);

        // Close modal with Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape' && !cafeModal.classList.contains('hidden')) {
                closeCafeModal();
            }
        });

        // Add click event to all cafe cards
        document.querySelectorAll('.cafe-card').forEach(card => {
            card.addEventListener('click', function(event) {
                event.stopPropagation();

                try {
                    const cafeData = JSON.parse(this.dataset.cafe);
                    console.log('Cafe Data:', cafeData); // For debugging
                    openCafeModal(cafeData);
                } catch (e) {
                    console.error('Error parsing cafe data:', e);
                }
            });
        });

        // Tutup modal jika klik di luar area modalContent
        cafeModal.addEventListener('mousedown', function(event) {
            if (!event.target.closest('.inline-block')) {
                closeCafeModal();
            }
        });

        // Prevent modal from closing when clicking inside it
        cafeModal.addEventListener('click', function(event) {
            event.stopPropagation();
        });
    </script>
</body>

</html>
