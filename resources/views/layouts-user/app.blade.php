<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Rekomendasi Cafe - Ponorogo')</title>
    <link rel="icon" href="{{ asset('logo_pocaf.png') }}" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        /* Modern Mobile-First Styles */
        * {
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            line-height: 1.6;
        }

        /* Lazy Loading Styles */
        .progressive-image {
            position: relative;
            overflow: hidden;
        }

        .placeholder {
            position: absolute;
            inset: 0;
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: shimmer 1.5s infinite;
        }

        .lazy-image {
            transition: opacity 0.5s ease-in-out;
        }

        .lazy-image.loaded {
            opacity: 1 !important;
        }

        @keyframes shimmer {
            0% {
                background-position: -200% 0;
            }

            100% {
                background-position: 200% 0;
            }
        }

        /* Card Animations */
        .cafe-card {
            transform: translateY(20px);
            opacity: 0;
            transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .cafe-card.in-view {
            transform: translateY(0);
            border-radius: 6px;
            opacity: 1;
        }

        .cafe-card.loading {
            pointer-events: none;
        }

        /* Image Error State */
        .image-error {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background-color: #f3f4f6;
            color: #6b7280;
            padding: 1rem;
            text-align: center;
        }

        .image-error svg {
            width: 2rem;
            height: 2rem;
            margin-bottom: 0.5rem;
        }

        .image-error span {
            font-size: 0.75rem;
            margin-bottom: 0.5rem;
        }

        .retry-btn {
            background-color: #996207;
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 0.5rem;
            font-size: 0.75rem;
            border: none;
            cursor: pointer;
            transition: all 0.3s;
        }

        .retry-btn:hover {
            background-color: #996207;
            transform: scale(1.05);
        }

        /* Filter Dropdown Animation */
        #filterDropdown {
            animation: slideDown 0.3s ease-out;
        }

        #filterDropdown.hidden {
            animation: slideUp 0.3s ease-in;
        }

        #filterDropdown h3 {
            color: white;
            text-align: left;
        }

        #filterDropdown h3::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            width: 30px;
            height: 2px;
            background-color: rgba(255, 255, 255, 0.3);
            border-radius: var(--radius-full);
        }

        /* Input Improvements */
        #searchInput {
            width: 100%;
            flex: 1;
            background: transparent;
            border: none;
            outline: none;
            font-size: 1rem;
            /* Gunakan 1rem agar konsisten dengan Tailwind text-base */
            color: #374151;
            /* Tailwind gray-700 */
            padding: 0.5rem 0.75rem;
            text-align: left;
            min-width: 0;
        }

        #searchInput::placeholder {
            color: #9ca3af;
            /* Tailwind gray-400 */
            text-align: left;
        }

        /* Filter Sections */
        .filter-section {
            margin-bottom: 1.5rem;
            /* 24px, sama dengan Tailwind space-6 */
        }

        /* Filter Buttons */
        .filter-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            /* 8px, sama dengan Tailwind space-2 */
            justify-content: flex-start;
        }

        /* Selected Filters - Improved */
        #selectedFilters {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 0.5rem;
            overflow-x: auto;
            scrollbar-width: none;
            -ms-overflow-style: none;
            /* max-height: 60px;
            overflow-y: hidden; */
        }

        #selectedFilters::-webkit-scrollbar {
            display: none;
        }

        /* Filter Chips - Enhanced */
        .filter-chip {
            background-color: #f5efe4 !important;
            /* Soft brown, bisa sesuaikan */
            color: #996207 !important;
            border: 1px solid #e5dcc3 !important;
            font-weight: 200;
            letter-spacing: 0.025em;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            /* text-xs */
            flex-shrink: 0;
            max-width: 200px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            position: relative;
            cursor: pointer;
        }

        .filter-chip::before {
            content: "";
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(124, 106, 70, 0.1), transparent);
            transition: left 0.5s;
        }

        .filter-chip:hover::before {
            left: 100%;
        }

        .filter-chip:hover {
            background-color: #e8e0d1 !important;
            transform: translateY(-1px) scale(1.02);
            box-shadow: 0 2px 8px 0 rgba(124, 106, 70, 0.08);
        }

        .filter-chip-close {
            color: #996207;
            font-weight: 600;
            font-size: 1rem;
            line-height: 1;
            padding: 0.125rem;
            border-radius: 9999px;
            transition: background 0.2s, transform 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 18px;
            height: 18px;
        }

        .filter-chip-close:hover {
            background-color: rgba(124, 106, 70, 0.1);
            transform: scale(1.1);
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideUp {
            from {
                opacity: 1;
                transform: translateY(0);
            }

            to {
                opacity: 0;
                transform: translateY(-10px);
            }
        }

        /* Indicator Dots
        .indicator-dot {
            transition: all 0.3s ease;
        }

        .indicator-dot:hover {
            transform: scale(1.2);
        } */

        /* Indicator Dots Elastic Style */
        .indicator-container {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .indicator-dot {
            transition: all 0.3s ease;
        }

        .indicator-dot:hover {
            transform: scale(1.2);
        }

        .indicator-active {
            transition: all 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            transform-origin: center;
        }

        .indicator-container:hover .indicator-active {
            transform: scaleY(1.2);
        }

        .indicator-click {
            transition: all 0.2s ease;
        }

        .indicator-click:hover {
            transform: scaleY(1.5);
            background-color: rgba(124, 106, 70, 0.2);
            border-radius: 9999px;
        }

        /* Alternative elastic effect */
        .indicator-elastic {
            position: relative;
            overflow: hidden;
        }

        .indicator-elastic::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(90deg,
                    transparent 0%,
                    rgba(124, 106, 70, 0.1) 20%,
                    rgba(124, 106, 70, 0.2) 50%,
                    rgba(124, 106, 70, 0.1) 80%,
                    transparent 100%);
            transform: translateX(-100%);
            transition: transform 0.6s ease;
        }

        .indicator-elastic.active::before {
            transform: translateX(100%);
        }

        /* Spring Elastic Indicator Styles - SMOOTH VERSION */
        .spring-indicator {
            transition: all 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            transform-origin: center;
        }

        .spring-indicator.moving {
            width: 4rem;
            /* w-16 */
            height: 0.5rem;
            /* h-2 */
            transform: scaleX(1.6) scaleY(1.1);
            /* Removed bounce animation - now just smooth elastic stretch */
        }

        .spring-indicator.moving #spring-coil {
            opacity: 0.8 !important;
        }

        /* Smooth wave effect inside indicator */
        .spring-indicator.moving::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(90deg,
                    transparent 0%,
                    rgba(255, 255, 255, 0.3) 50%,
                    transparent 100%);
            border-radius: 9999px;
            animation: smooth-wave 0.8s ease-in-out;
        }

        /* Smooth wave animation */
        @keyframes smooth-wave {
            0% {
                transform: translateX(-100%);
                opacity: 0;
            }

            50% {
                opacity: 1;
            }

            100% {
                transform: translateX(100%);
                opacity: 0;
            }
        }

        /* Subtle glow effect when moving */
        .spring-indicator.moving::before {
            content: '';
            position: absolute;
            top: -1px;
            left: -1px;
            right: -1px;
            bottom: -1px;
            background: rgba(124, 106, 70, 0.2);
            border-radius: 9999px;
            animation: smooth-glow 0.8s ease-out;
        }

        @keyframes smooth-glow {
            0% {
                transform: scale(1);
                opacity: 0;
            }

            50% {
                transform: scale(1.1);
                opacity: 0.6;
            }

            100% {
                transform: scale(1);
                opacity: 0;
            }
        }

        /* Smooth carousel transition */
        #cafeCarousel {
            transition: transform 0.7s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        /* Button hover effects */
        button:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        button:active {
            transform: translateY(0);
        }

        /* Status text animations */
        .status-moving {
            color: #ea580c;
            /* orange-600 */
            animation: smooth-text-pulse 1s ease-in-out infinite alternate;
        }

        @keyframes smooth-text-pulse {
            0% {
                opacity: 0.8;
            }

            100% {
                opacity: 1;
            }
        }

        /* Enhanced smooth gradient for coil effect */
        #spring-coil {
            background: linear-gradient(90deg,
                    #996207 0%,
                    #A0916D 25%,
                    #996207 50%,
                    #A0916D 75%,
                    #996207 100%) !important;
            transition: opacity 0.4s ease-in-out;
        }

        /* Smooth scale transition */
        .spring-indicator:not(.moving) {
            transform: scaleX(1) scaleY(1);
        }

        @keyframes pulse-ring {
            0% {
                transform: scale(1);
                opacity: 0.7;
            }

            100% {
                transform: scale(1.3);
                opacity: 0;
            }
        }

        /* Smooth carousel transition */
        #carousel {
            transition: transform 0.7s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        /* Button hover effects */
        button:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        button:active {
            transform: translateY(0);
        }

        /* Status text animations */
        .status-moving {
            color: #ea580c;
            /* orange-600 */
            animation: text-pulse 0.5s ease-in-out infinite alternate;
        }

        @keyframes text-pulse {
            0% {
                opacity: 0.7;
            }

            100% {
                opacity: 1;
            }
        }

        /* Modal Animations */
        #cafeModal {
            backdrop-filter: blur(4px);
        }

        #cafeModal .inline-block {
            animation: modalSlideIn 0.3s ease-out;
        }

        /* Tambahkan ini di style Anda */
        #cafeModal>.inline-block {
            position: relative;
            z-index: 60;
        }

        #cafeModal>.fixed,
        #cafeModal>.absolute {
            z-index: 50;
        }

        #cafeGallery {
            -webkit-overflow-scrolling: touch;
            scrollbar-width: thin;
        }

        #cafeGallery::-webkit-scrollbar {
            height: 6px;
        }

        @keyframes modalSlideIn {
            from {
                opacity: 0;
                transform: translateY(-20px) scale(0.95);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        /* Line Clamp Utility */
        .line-clamp-1 {
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Touch Improvements for Mobile */
        @media (max-width: 768px) {
            #cafeGallery {
                -webkit-overflow-scrolling: touch;
                scrollbar-width: none;
            }

            #cafeGallery::-webkit-scrollbar {
                display: none;
            }

            .cafe-card {
                touch-action: manipulation;
            }

            button,
            .cafe-card {
                -webkit-tap-highlight-color: transparent;
            }

            .filter-chip {
                font-size: 0.875rem;
                /* text-sm */
            }

            /* Scrollable Comments Container */
            .comment-card {
                padding: 12px;
            }

            .comment-avatar {
                width: 32px;
                height: 32px;
                font-size: 12px;
            }

            .comment-form {
                padding: 16px;
            }

        }

        /* Pointer Events for Modals */
        .comment-form input,
        .comment-form textarea,
        .comment-form button {
            pointer-events: auto !important;
        }

        .modal-content {
            pointer-events: auto;
        }

        .modal-overlay {
            pointer-events: none;
        }

        /* Comment Highlight Animation */
        .comment-highlight {
            animation: highlight 2s ease;
        }

        @keyframes highlight {
            0% {
                background-color: rgba(124, 106, 70, 0.3);
            }

            100% {
                background-color: transparent;
            }
        }

        .loading-spinner {
            display: inline-flex;
            align-items: center;
        }

        .hidden {
            display: none;
        }

        @media (min-width: 768px) {
            #selectedFilters {
                max-height: 60px;
                overflow-y: hidden;
            }

            /* Scrollable Comments Container */
            .comments-container {
                max-height: 400px;
                overflow-y: auto;
            }

            .comments-container::-webkit-scrollbar {
                width: 4px;
            }

            .comments-container::-webkit-scrollbar-track {
                background: #f1f1f1;
                border-radius: 2px;
            }

            .comments-container::-webkit-scrollbar-thumb {
                background: #c1c1c1;
                border-radius: 2px;
            }

            .comments-container::-webkit-scrollbar-thumb:hover {
                background: #a8a8a8;
            }
        }

        /* Smooth Scrolling */
        html {
            scroll-behavior: smooth;
        }

        /* Focus States */
        button:focus-visible,
        input:focus-visible {
            outline: 2px solid #996207;
            outline-offset: 2px;
        }
    </style>

    @stack('styles')
</head>

<body class="bg-white min-h-screen">
    <!-- Navbar -->
    @include('layouts-user.navbar')

    <!-- Main Content -->
    @yield('content')

    <!-- Footer -->
    @include('layouts-user.footer')

    <!-- Enhanced JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // =============================================
            // ENHANCED LAZY LOADING IMPLEMENTATION
            // =============================================
            class ModernLazyLoader {
                constructor() {
                    this.imageObserver = null;
                    this.cardObserver = null;
                    this.loadedImages = new Set();
                    this.init();
                }

                init() {
                    this.setupImageObserver();
                    this.setupCardObserver();
                    this.loadInitialImages();
                    this.setupRetryHandlers();
                }

                setupImageObserver() {
                    const options = {
                        root: null,
                        rootMargin: '50px',
                        threshold: 0.1
                    };

                    this.imageObserver = new IntersectionObserver((entries) => {
                        entries.forEach(entry => {
                            if (entry.isIntersecting) {
                                this.loadImage(entry.target);
                                this.imageObserver.unobserve(entry.target);
                            }
                        });
                    }, options);
                }

                setupCardObserver() {
                    const options = {
                        root: null,
                        rootMargin: '100px',
                        threshold: 0.1
                    };

                    this.cardObserver = new IntersectionObserver((entries) => {
                        entries.forEach((entry, index) => {
                            if (entry.isIntersecting) {
                                setTimeout(() => {
                                    entry.target.classList.add('in-view');
                                }, index * 100);
                                this.cardObserver.unobserve(entry.target);
                            }
                        });
                    }, options);
                }

                loadInitialImages() {
                    document.querySelectorAll('.lazy-image').forEach(img => {
                        this.imageObserver.observe(img);
                    });

                    document.querySelectorAll('.lazy-load').forEach(card => {
                        this.cardObserver.observe(card);
                    });
                }

                loadImage(img) {
                    if (this.loadedImages.has(img)) return;

                    const card = img.closest('.cafe-card');
                    const placeholder = img.parentElement.querySelector('.placeholder');

                    if (card) card.classList.add('loading');

                    const imageLoader = new Image();

                    imageLoader.onload = () => {
                        img.src = img.dataset.src;
                        img.classList.add('loaded');

                        if (placeholder) {
                            placeholder.style.opacity = '0';
                            setTimeout(() => placeholder.remove(), 300);
                        }

                        if (card) card.classList.remove('loading');
                        this.loadedImages.add(img);
                        delete img.dataset.src;
                    };

                    imageLoader.onerror = () => {
                        this.handleImageError(img, card, placeholder);
                    };

                    imageLoader.src = img.dataset.src;
                }

                handleImageError(img, card, placeholder) {
                    if (card) card.classList.remove('loading');

                    const errorDiv = document.createElement('div');
                    errorDiv.className = 'image-error w-full h-full';
                    errorDiv.innerHTML = `
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span>Gambar tidak dapat dimuat</span>
                        <button class="retry-btn" data-retry-src="${img.dataset.src}">Coba Lagi</button>
                    `;

                    img.parentElement.replaceChild(errorDiv, img);

                    if (placeholder) {
                        placeholder.style.opacity = '0';
                        setTimeout(() => placeholder.remove(), 300);
                    }
                }

                setupRetryHandlers() {
                    document.addEventListener('click', (e) => {
                        if (e.target.classList.contains('retry-btn')) {
                            const retrySrc = e.target.dataset.retrySrc;
                            const errorDiv = e.target.closest('.image-error');
                            const container = errorDiv.parentElement;

                            const newImg = document.createElement('img');
                            newImg.className =
                                'lazy-image w-full h-full object-cover opacity-0 transition-opacity duration-500';
                            newImg.dataset.src = retrySrc;
                            newImg.alt = 'Cafe Image';

                            container.replaceChild(newImg, errorDiv);
                            this.loadImage(newImg);
                        }
                    });
                }

                refresh() {
                    this.loadInitialImages();
                }
            }

            // Initialize lazy loader
            window.lazyLoader = new ModernLazyLoader();

            // =============================================
            // FILTER AND SEARCH FUNCTIONALITY (UPDATED)
            // =============================================
            // Element references
            const toggleBtn = document.getElementById('toggleFilter');
            const dropdown = document.getElementById('filterDropdown');
            const searchDropdown = document.getElementById('searchDropdown');
            const searchButton = document.getElementById('searchButton');
            const selectedFilters = document.getElementById('selectedFilters');
            const clearFilters = document.getElementById('clearFilters');
            const searchInput = document.getElementById('searchInput');
            const advancedSearchInput = document.getElementById('advancedSearch');
            const quickSearchBtns = document.querySelectorAll('.quick-search-btn');

            // Search dropdown functionality
            if (searchButton && searchDropdown) {
                searchButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    if (dropdown) dropdown.classList.add('hidden');
                    searchDropdown.classList.toggle('hidden');
                    if (!searchDropdown.classList.contains('hidden') && advancedSearchInput) {
                        setTimeout(() => advancedSearchInput.focus(), 100);
                    }
                });
            }

            // Show filter dropdown when clicking search input
            if (searchInput && dropdown) {
                searchInput.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    if (searchDropdown) searchDropdown.classList.add('hidden');
                    dropdown.classList.remove('hidden');
                    dropdown.scrollIntoView({
                        behavior: 'smooth',
                        block: 'nearest'
                    });
                });
            }

            // Toggle filter dropdown
            if (toggleBtn && dropdown) {
                toggleBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    if (searchDropdown) searchDropdown.classList.add('hidden');
                    dropdown.classList.toggle('hidden');
                });
            }

            // Close dropdowns when clicking outside
            document.addEventListener('click', function(e) {
                const isClickInsideDropdown = dropdown?.contains(e.target);
                const isClickOnSearchInput = searchInput?.contains(e.target);
                const isClickOnToggleButton = toggleBtn?.contains(e.target);
                const isClickOnFilterChip = selectedFilters?.contains(e.target);

                if (searchDropdown && !searchDropdown.contains(e.target) &&
                    !searchButton.contains(e.target)) {
                    searchDropdown.classList.add('hidden');
                }

                if (!isClickInsideDropdown &&
                    !isClickOnSearchInput &&
                    !isClickOnToggleButton &&
                    !isClickOnFilterChip) {
                    dropdown?.classList.add('hidden');
                }
            });

            // Quick search functionality
            if (quickSearchBtns.length > 0) {
                quickSearchBtns.forEach(btn => {
                    btn.addEventListener('click', function() {
                        const searchTerm = this.textContent.trim();
                        if (searchInput) searchInput.value = searchTerm;
                        if (advancedSearchInput) advancedSearchInput.value = searchTerm;
                        this.classList.add('bg-amber-200', 'text-amber-900');
                        setTimeout(() => {
                            this.classList.remove('bg-amber-200', 'text-amber-900');
                        }, 200);
                    });
                });
            }

            // Enhanced search with Enter key
            [searchInput, advancedSearchInput].forEach(input => {
                if (input) {
                    input.addEventListener('keypress', function(e) {
                        if (e.key === 'Enter') {
                            e.preventDefault();
                            const form = this.closest('form');
                            if (form) {
                                form.submit();
                            } else {
                                const searchTerm = this.value.trim();
                                if (searchTerm) {
                                    const currentUrl = new URL(window.location);
                                    currentUrl.searchParams.set('search', searchTerm);
                                    window.location.href = currentUrl.toString();
                                }
                            }
                        }
                    });
                }
            });

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
                if (!selectedFilters) return;

                selectedFilters.innerHTML = '';
                const activeFilters = [];

                // Check radio buttons
                ['harga_menu', 'kapasitas_ruang'].forEach(name => {
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

                // Fasilitas di tengah
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

                // Tempat parkir di akhir
                ['tempat_parkir'].forEach(name => {
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

                // Update search input visibility
                if (activeFilters.length === 0) {
                    selectedFilters.classList.add('hidden');
                    searchInput?.classList.remove('hidden');
                    searchInput?.style.removeProperty('flex-grow');
                } else {
                    selectedFilters.classList.remove('hidden');
                    searchInput?.classList.add('hidden');
                    searchInput?.style.setProperty('flex-grow', '0');
                }

                // Create filter chips with animation (simplified from first code)
                activeFilters.forEach((filter, index) => {
                    const chip = document.createElement('div');
                    chip.className =
                        'filter-chip bg-gray-200 text-[#996207] px-2 py-1 rounded-full text-xs md:text-sm flex items-center gap-1 animate-fade-in';
                    chip.style.animationDelay = `${index * 50}ms`;
                    chip.innerHTML = `
                        <span>${filter.label}</span>
                        <button type="button" class="text-gray-500 hover:text-gray-700 ml-1" onclick="clearFilter('${filter.name}', '${filter.value}')">
                            ×
                        </button>
                    `;
                    selectedFilters.appendChild(chip);
                });

                updateSearchPlaceholder();
            }

            // Function to update search placeholder
            function updateSearchPlaceholder() {
                const checkedInputs = document.querySelectorAll(
                    'input[type="radio"]:checked, input[type="checkbox"]:checked');
                const hasFilters = checkedInputs.length > 0;

                if (searchInput) {
                    searchInput.placeholder = hasFilters ? 'Cari nama cafe...' : 'Pilih kriteria...';
                }

                if (advancedSearchInput) {
                    advancedSearchInput.placeholder = hasFilters ?
                        'Cari nama cafe dengan filter yang dipilih...' :
                        'Masukkan nama kafe, lokasi, atau kata kunci...';
                }
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
                const form = document.querySelector('form[action="{{ route('cafe.search') }}"]');
                if (form) form.submit();

                // Update URL when clearing filters
                const remainingFilters = document.querySelectorAll(
                    'input[type="radio"]:checked, input[type="checkbox"]:checked');
                if (remainingFilters.length === 0) {
                    setTimeout(() => {
                        const currentUrl = new URL(window.location);
                        const searchParam = currentUrl.searchParams.get('search');
                        currentUrl.search = '';
                        if (searchParam) {
                            currentUrl.searchParams.set('search', searchParam);
                        }
                        window.location.href = currentUrl.toString();
                    }, 300);
                }
            };

            // Listen for changes on all filter inputs
            document.querySelectorAll('input[type="radio"], input[type="checkbox"]').forEach(input => {
                input.addEventListener('change', function() {
                    const span = this.nextElementSibling;
                    if (span) {
                        span.classList.toggle('selected', this.checked);
                    }

                    if (this.type === 'radio' && this.checked) {
                        const otherRadios = document.querySelectorAll(`input[name="${this.name}"]`);
                        otherRadios.forEach(radio => {
                            if (radio !== this) {
                                const otherSpan = radio.nextElementSibling;
                                if (otherSpan) otherSpan.classList.remove('selected');
                            }
                        });
                    }

                    updateSelectedFilters();
                });
            });

            // Form validation
            const searchForm = document.querySelector('form[action="{{ route('cafe.search') }}"]');
            if (searchForm) {
                searchForm.addEventListener('submit', function(e) {
                    const searchValue = searchInput?.value.trim();
                    const radioChecked = document.querySelector('input[type="radio"]:checked');
                    const checkboxChecked = document.querySelector('input[type="checkbox"]:checked');
                    const submitBtn = searchForm.querySelector('button[type="submit"]');

                    // Validasi
                    if (!searchValue && !radioChecked && !checkboxChecked) {
                        e.preventDefault();
                        alert('Silakan masukkan kata kunci pencarian atau pilih minimal satu filter.');
                        return false;
                    }

                    // Tampilkan loading state
                    if (submitBtn) {
                        const originalHtml = submitBtn.innerHTML;
                        submitBtn.innerHTML = `
                            <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Mencari...
                        `;
                        submitBtn.disabled = true;

                        // Kembalikan state setelah form selesai diproses
                        setTimeout(() => {
                            submitBtn.innerHTML = originalHtml;
                            submitBtn.disabled = false;
                        }, 3000); // Timeout 3 detik sebagai fallback
                    }
                });
            }

            // Clear all filters
            if (clearFilters) {
                clearFilters.addEventListener('click', function(e) {
                    e.preventDefault();
                    document.querySelectorAll('input[type="radio"]:checked, input[type="checkbox"]:checked')
                        .forEach(input => input.checked = false);

                    if (selectedFilters) {
                        selectedFilters.innerHTML = '';
                        selectedFilters.classList.add('hidden');
                    }

                    if (searchInput) searchInput.value = '';
                    if (advancedSearchInput) advancedSearchInput.value = '';
                    if (dropdown) dropdown.classList.add('hidden');
                    if (searchDropdown) searchDropdown.classList.add('hidden');

                    window.location.href = window.location.origin + window.location.pathname;
                });
            }

            // Initialize on page load
            updateSelectedFilters();
            updateSearchPlaceholder();

            // Initialize pill button states
            document.querySelectorAll('input[type="radio"]:checked, input[type="checkbox"]:checked').forEach(
                input => {
                    const span = input.nextElementSibling;
                    if (span) span.classList.add('selected');
                });

            // Enhanced browser back button handling
            window.addEventListener('popstate', function() {
                setTimeout(() => window.location.reload(), 100);
            });

            // Keyboard navigation for dropdowns
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    if (searchDropdown && !searchDropdown.classList.contains('hidden')) {
                        searchDropdown.classList.add('hidden');
                    }
                    if (dropdown && !dropdown.classList.contains('hidden')) {
                        dropdown.classList.add('hidden');
                    }
                }
            });

            // === NOTIFIKASI KOMENTAR ===

            const notification = document.getElementById('notification');

            if (notification) {
                // Tampilkan notifikasi dengan animasi
                setTimeout(() => {
                    notification.classList.remove('-translate-y-full');
                    notification.classList.add('translate-y-0');

                    // Sembunyikan otomatis setelah 5 detik
                    setTimeout(() => {
                        notification.classList.remove('translate-y-0');
                        notification.classList.add('-translate-y-full');

                        // Hapus element setelah animasi selesai (300ms)
                        setTimeout(() => {
                            notification.remove();
                        }, 300);
                    }, 5000); // 5 detik
                }, 50); // Delay kecil untuk memastikan DOM siap
            }

            // === VIEW ALL BUTTON TOGGLE FUNCTIONALITY ===
            const viewAllButton = document.getElementById('viewAllButton');
            const carouselView = document.querySelector('#cafeCarousel').parentElement.parentElement;
            const gridView = document.getElementById('gridView');
            const defaultTitle = document.getElementById('defaultTitle');
            const searchFormViewAll = document.getElementById('searchFormViewAll');
            const instantSearchInput = document.getElementById('instantSearchInput');
            
            // Debounce function untuk optimasi performa
            function debounce(func, timeout = 500) {
                let timer;
                return (...args) => {
                    clearTimeout(timer);
                    timer = setTimeout(() => { func.apply(this, args); }, timeout);
                };
            }
            
            // Fungsi pencarian
            const performSearch = debounce(function(searchTerm) {
                if (searchTerm.length > 0) {
                    // Filter cafe cards secara client-side
                    const cafeCards = document.querySelectorAll('#gridView .cafe-card');
                    cafeCards.forEach(card => {
                        const cafeName = card.querySelector('h3').textContent.toLowerCase();
                        const cafeAddress = card.querySelector('p span').textContent.toLowerCase();
                        const searchText = searchTerm.toLowerCase();
                        
                        if (cafeName.includes(searchText) || cafeAddress.includes(searchText)) {
                            card.style.display = 'block';
                        } else {
                            card.style.display = 'none';
                        }
                    });
                } else {
                    // Tampilkan semua jika search kosong
                    const cafeCards = document.querySelectorAll('#gridView .cafe-card');
                    cafeCards.forEach(card => {
                        card.style.display = 'block';
                    });
                }
            });
            
            // Event listener untuk input pencarian
            if (instantSearchInput) {
                instantSearchInput.addEventListener('input', (e) => {
                    performSearch(e.target.value);
                });
            }
            
            if (viewAllButton && carouselView && gridView) {
                // Function to switch to grid view
                function showGridView() {
                    carouselView.classList.add('hidden');
                    gridView.classList.remove('hidden');
                    
                    // Update UI
                    defaultTitle.classList.add('hidden');
                    searchFormViewAll.classList.remove('hidden');
                    searchFormViewAll.classList.add('flex');
                    
                    viewAllButton.innerHTML = `
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                        Back to Home
                    `;
                    viewAllButton.onclick = showCarouselView;
                    
                    // Fokus ke input search saat beralih ke grid view
                    setTimeout(() => {
                        instantSearchInput.focus();
                    }, 100);
                }

                // Function to switch to carousel view
                function showCarouselView() {
                    carouselView.classList.remove('hidden');
                    gridView.classList.add('hidden');
                    
                    // Update UI
                    defaultTitle.classList.remove('hidden');
                    searchFormViewAll.classList.add('hidden');
                    searchFormViewAll.classList.remove('flex');
                    
                    // Reset pencarian saat kembali ke carousel
                    instantSearchInput.value = '';
                    performSearch('');
                    
                    viewAllButton.innerHTML = `
                        View All
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    `;
                    viewAllButton.onclick = showGridView;
                }

                // Initial setup
                viewAllButton.onclick = showGridView;
            }

            // =============================================
            // ENHANCED CAFE MODAL FUNCTIONALITY
            // =============================================
            let currentOpenModal = null;
            // Fungsi untuk menangani klik card
            function handleCardClick(event, cafeData) {
                // Cegah event bubbling jika diklik elemen tertentu
                const forbiddenElements = ['A', 'BUTTON', 'INPUT', 'TEXTAREA', 'SELECT', 'LABEL'];
                let target = event.target;
                
                while (target !== this) {
                    if (forbiddenElements.includes(target.tagName) || 
                        target.isContentEditable || 
                        target.hasAttribute('onclick')) {
                        return;
                    }
                    target = target.parentElement;
                }
                
                // Buka modal
                openCafeModal(cafeData);
            }

            // Function to open modal for specific cafe
            window.openCafeModal = function(cafeData) {
                // Close any currently open modal first
                if (currentOpenModal) {
                    closeModal(currentOpenModal);
                }

                // Convert cafeData to object if it's a string
                if (typeof cafeData === 'string') {
                    try {
                        cafeData = JSON.parse(cafeData);
                    } catch (e) {
                        console.error('Error parsing cafe data:', e);
                        return;
                    }
                }

                // Ensure cafeData has an id
                if (!cafeData || !cafeData.id) {
                    console.error('Invalid cafe data:', cafeData);
                    return;
                }

                const modalId = `cafeModal-${cafeData.id}`;
                const modal = document.getElementById(modalId);

                if (!modal) {
                    console.error(`Modal with ID ${modalId} not found`);
                    return;
                }

                // Fill modal with cafe data
                fillModalData(modal, cafeData);

                // Show modal with animation
                modal.classList.remove('hidden');
                document.body.classList.add('overflow-hidden');
                currentOpenModal = modalId;

                // Add event listener for close button inside modal
                const closeBtn = modal.querySelector('[onclick*="closeModal"]');
                if (closeBtn) {
                    closeBtn.onclick = () => closeModal(modalId);
                }
            };

            // Function to fill modal data
            function fillModalData(modal, cafeData) {
                // Basic info
                if (modal.querySelector('#modalCafeName')) {
                    modal.querySelector('#modalCafeName').textContent = cafeData.nama_cafe || 'Nama Cafe';
                }
                if (modal.querySelector('#modalCafeAddress')) {
                    modal.querySelector('#modalCafeAddress').textContent = cafeData.alamat ||
                        'Alamat tidak tersedia';
                }

                // Image
                const modalImage = modal.querySelector('#modalCafeImage');
                if (modalImage) {
                    modalImage.src = cafeData.thumbnail ? '{{ asset('storage') }}/' + cafeData.thumbnail : '';
                    modalImage.alt = cafeData.nama_cafe || 'Cafe Image';
                }

                // Relations data
                if (modal.querySelector('#modalCafeHours')) {
                    modal.querySelector('#modalCafeHours').textContent = cafeData.jambuka?.jam_buka ||
                        'Tidak diketahui';
                }
                if (modal.querySelector('#modalCafePrice')) {
                    modal.querySelector('#modalCafePrice').textContent = cafeData.hargamenu?.harga_menu ||
                        'Tidak diketahui';
                }
                if (modal.querySelector('#modalCafeCapacity')) {
                    modal.querySelector('#modalCafeCapacity').textContent = cafeData.kapasitasruang
                        ?.kapasitas_ruang || 'Tidak diketahui';
                }
                if (modal.querySelector('#modalCafeParking')) {
                    modal.querySelector('#modalCafeParking').textContent = cafeData.tempatparkir?.tempat_parkir ||
                        'Tidak diketahui';
                }

                // Facilities
                const facilitiesContainer = modal.querySelector('#modalCafeFacilities');
                if (facilitiesContainer) {
                    facilitiesContainer.innerHTML = '';
                    if (cafeData.fasilitas?.length > 0) {
                        cafeData.fasilitas.forEach(facility => {
                            const facilityBadge = document.createElement('span');
                            facilityBadge.className =
                                'bg-gray-100 text-gray-800 px-2 py-1 rounded-full text-xs';
                            facilityBadge.textContent = facility.nama_fasilitas || 'Fasilitas';
                            facilitiesContainer.appendChild(facilityBadge);
                        });
                    } else {
                        const noFacility = document.createElement('span');
                        noFacility.className = 'text-gray-500 text-sm';
                        noFacility.textContent = 'Tidak ada fasilitas tersedia';
                        facilitiesContainer.appendChild(noFacility);
                    }
                }

                // Additional information
                if (modal.querySelector('#modalCafeMotor')) {
                    modal.querySelector('#modalCafeMotor').textContent = cafeData.keterangan_motor ||
                        'Tidak diketahui';
                }
                if (modal.querySelector('#modalCafeMobil')) {
                    modal.querySelector('#modalCafeMobil').textContent = cafeData.keterangan_mobil ||
                        'Tidak diketahui';
                }
                if (modal.querySelector('#modalCafeMushola')) {
                    modal.querySelector('#modalCafeMushola').textContent = cafeData.keterangan_mushola ||
                        'Tidak diketahui';
                }
                if (modal.querySelector('#modalCafeToilet')) {
                    modal.querySelector('#modalCafeToilet').textContent = cafeData.keterangan_toilet ||
                        'Tidak diketahui';
                }

                // Instagram link - versi lebih robust
                const instagramElement = modal.querySelector('#modalCafeInstagram');
                if (instagramElement) {
                    const formatInstagramUrl = (url) => {
                        if (!url) return null;

                        try {
                            // Handle berbagai format:
                            // 1. URL lengkap (https://www.instagram.com/p/xxx/)
                            // 2. @username
                            // 3. username saja
                            // 4. ID post (DFfIMU9TSRj)

                            url = url.trim();

                            // Jika sudah berupa URL valid
                            if (/^https?:\/\/(www\.)?instagram\.com/.test(url)) {
                                return url;
                            }

                            // Jika berupa @username
                            if (url.startsWith('@')) {
                                return `https://instagram.com/${url.substring(1)}`;
                            }

                            // Jika berupa ID post (contoh: DFfIMU9TSRj)
                            if (/^[A-Za-z0-9_-]+$/.test(url)) {
                                return `https://www.instagram.com/p/${url}/`;
                            }

                            // Default anggap sebagai username
                            return `https://instagram.com/${url}`;
                        } catch (e) {
                            console.error('Error formatting Instagram URL:', e);
                            return null;
                        }
                    };

                    const igUrl = formatInstagramUrl(cafeData.instagram_url);

                    if (igUrl) {
                        instagramElement.innerHTML = `
                            <div class="instagram-link inline-flex items-center text-[#996207] text-sm font-medium cursor-pointer hover:opacity-80 transition-opacity">
                                <i class="fab fa-instagram mr-2 w-4 h-4 text-center"></i>
                                <span>${cafeData.instagram_url.includes('/p/') ? 'Lihat Postingan' : 'Kunjungi Instagram'}</span>
                            </div>
                        `;

                        instagramElement.querySelector('.instagram-link').addEventListener('click', (e) => {
                            e.preventDefault();
                            window.open(igUrl, '_blank', 'noopener,noreferrer');
                        });

                        instagramElement.classList.remove('hidden');
                    } else {
                        instagramElement.classList.add('hidden');
                    }
                }

                // Gallery Images
                const galleryContainer = modal.querySelector('#cafeGallery');
                if (galleryContainer) {
                    galleryContainer.innerHTML = '';

                    if (cafeData.gambar) {
                        let images = cafeData.gambar;
                        if (typeof cafeData.gambar === 'string') {
                            try {
                                images = JSON.parse(cafeData.gambar);
                                if (!Array.isArray(images)) images = [];
                            } catch (e) {
                                console.error('Error parsing gallery images:', e);
                                images = [];
                            }
                        }

                        if (images.length > 0) {
                            images.forEach((image, index) => {
                                const aspectContainer = document.createElement('div');
                                aspectContainer.className =
                                    'aspect-[3/4] min-w-[96px] w-24 relative rounded-lg overflow-hidden flex-shrink-0';

                                const thumbnail = document.createElement('img');
                                thumbnail.src = '{{ asset('storage') }}/' + image;
                                thumbnail.alt = `Thumbnail ${index + 1}`;
                                thumbnail.className =
                                    'absolute inset-0 w-full h-full object-cover rounded-lg cursor-pointer transition-all hover:opacity-80';
                                // Tambahkan event listener untuk preview gambar
                                thumbnail.addEventListener('click', (e) => {
                                    e.stopPropagation(); // Mencegah event bubbling ke card
                                    if (modalImage) {
                                        modalImage.src = '{{ asset('storage') }}/' + image;
                                    }
                                });

                                aspectContainer.appendChild(thumbnail);
                                galleryContainer.appendChild(aspectContainer);
                            });
                        } else {
                            showNoGalleryMessage(galleryContainer);
                        }
                    } else {
                        showNoGalleryMessage(galleryContainer);
                    }
                }
            }

            // Function to close modal
            window.closeModal = function(modalId) {
                const modal = document.getElementById(modalId);
                if (modal) {
                    modal.classList.add('hidden');
                    document.body.classList.remove('overflow-hidden');
                    currentOpenModal = null;
                }
            };

            // Update the modal closing logic
            document.addEventListener('click', function(e) {
                if (!currentOpenModal) return;

                const modal = document.getElementById(currentOpenModal);
                if (!modal) return;

                // Get the backdrop element
                const backdrop = modal.querySelector('.fixed.inset-0.transition-opacity');

                // Only close if clicking directly on backdrop or its child
                if (e.target === backdrop || e.target === backdrop.firstElementChild) {
                    closeModal(currentOpenModal);
                }
            });

            // Close modal with Escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && currentOpenModal) {
                    closeModal(currentOpenModal);
                }
            });

            function showNoGalleryMessage(container) {
                const noImagesMsg = document.createElement('div');
                noImagesMsg.className = 'col-span-3 flex flex-col items-center justify-center py-4 text-gray-500';
                noImagesMsg.innerHTML = `
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span class="text-xs">Tidak ada galeri tersedia</span>
                `;
                container.appendChild(noImagesMsg);
            }

            // Initialize modal functionality for all cafe cards
            document.querySelectorAll('.cafe-card').forEach(card => {
                card.addEventListener('click', function(event) {
                    // Daftar elemen yang tidak boleh memicu modal
                    const nonTriggerElements = ['A', 'BUTTON', 'INPUT', 'TEXTAREA', 'SELECT',
                        'LABEL'
                    ];
                    const clickedElement = event.target;

                    // Cek hierarki elemen yang diklik
                    let currentElement = clickedElement;
                    let shouldOpenModal = true;

                    while (currentElement !== this) {
                        if (nonTriggerElements.includes(currentElement.tagName) ||
                            currentElement.isContentEditable ||
                            currentElement.hasAttribute('onclick')) {
                            shouldOpenModal = false;
                            break;
                        }
                        currentElement = currentElement.parentElement;
                    }

                    if (!shouldOpenModal) return;

                    try {
                        const cafeData = this.dataset.cafe;
                        if (cafeData) {
                            openCafeModal(cafeData);
                        }
                    } catch (e) {
                        console.error('Error opening cafe modal:', e);
                    }
                });
            });


            // =============================================
            // COMMENT SYSTEM IMPLEMENTATION - FIXED VERSION
            // =============================================

            function submitComment(event, cafeId) {
                event.preventDefault();
                const form = event.target;
                const formData = new FormData(form);
                const submitBtn = form.querySelector('button[type="submit"]');

                // Tampilkan loading
                submitBtn.disabled = true;
                submitBtn.innerHTML = `
                    <svg class="animate-spin h-4 w-4 mr-2 inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg> Mengirim...
                `;

                fetch(form.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Kosongkan form
                            form.reset();

                            // Tampilkan notifikasi
                            showSuccessNotification(data.message);

                            // Optional: Tambahkan komentar ke daftar tanpa reload
                            if (data.comment) {
                                addCommentToUI(data.comment, cafeId);
                            }
                        } else {
                            throw new Error(data.message || 'Gagal mengirim komentar');
                        }
                    })
                    .catch(error => {
                        alert(error.message);
                    })
                    .finally(() => {
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = 'Kirim Komentar';
                    });
            }

            function showSuccessNotification(message) {
                // Implementasi notifikasi Anda
                const notification = document.getElementById('notification');
                notification.querySelector('p').textContent = message;
                notification.classList.remove('hidden');

                setTimeout(() => {
                    notification.classList.add('hidden');
                }, 5000);
            }

            // =============================================
            // CAROUSEL FUNCTIONALITY
            // =============================================
            // Carousel elements
            // Carousel elements
            const carousel = document.getElementById('cafeCarousel');
            const cards = carousel ? carousel.querySelectorAll('.cafe-card') : [];
            const indicators = document.querySelectorAll('.indicator-dot');
            const springIndicator = document.getElementById('spring-indicator');
            const springCoil = document.getElementById('spring-coil');
            const statusText = document.getElementById('status-text');
            const autoPlayToggle = document.getElementById('auto-play-toggle');
            const prevBtn = document.getElementById('prev-btn');
            const nextBtn = document.getElementById('next-btn');

            // Carousel state
            let currentIndex = 0;
            let autoPlayInterval = null;
            let isMoving = false;
            let movingTimeout = null;

            function getVisibleCards() {
                if (window.innerWidth >= 1024) return 4;
                if (window.innerWidth >= 768) return 2;
                return 1;
            }

            // Update carousel position
            function updateCarousel() {
                if (!carousel || cards.length === 0) return;

                const visible = getVisibleCards();
                const cardWidth = cards[0]?.offsetWidth || 200;
                const gap = window.innerWidth >= 768 ? 16 : 12;
                const translateX = -(currentIndex * (cardWidth + gap));

                // Start smooth spring animation before moving carousel
                startSmoothSpringAnimation();

                carousel.style.transform = `translateX(${translateX}px)`;

                // Update original indicators (keep your existing functionality)
                indicators.forEach((indicator, idx) => {
                    indicator.classList.toggle('bg-[#996207]', idx === currentIndex);
                    indicator.classList.toggle('w-6', idx === currentIndex);
                    indicator.classList.toggle('bg-gray-300', idx !== currentIndex);
                    indicator.classList.toggle('w-2', idx !== currentIndex);
                });
            }

            // Start smooth spring animation (no bounce)
            function startSmoothSpringAnimation() {
                if (isMoving || !springIndicator) return;

                isMoving = true;

                // Add moving class for smooth elastic effect
                springIndicator.classList.add('moving');
                if (springCoil) springCoil.style.opacity = '0.8';

                // Update status with smooth animation
                if (statusText) {
                    statusText.textContent = 'Moving...';
                    statusText.className = 'text-xs font-medium status-moving transition-all duration-300';
                }

                // Clear existing timeout
                if (movingTimeout) {
                    clearTimeout(movingTimeout);
                }

                // Stop spring animation after smooth transition
                movingTimeout = setTimeout(() => {
                    stopSmoothSpringAnimation();
                }, 700); // Slightly shorter for smoother feel
            }

            // Stop smooth spring animation
            function stopSmoothSpringAnimation() {
                if (!springIndicator) return;

                isMoving = false;

                // Remove moving class with smooth transition
                springIndicator.classList.remove('moving');
                if (springCoil) {
                    // Smooth fade out
                    springCoil.style.transition = 'opacity 0.3s ease-out';
                    springCoil.style.opacity = '0';
                }

                // Update status with smooth transition
                if (statusText) {
                    statusText.textContent = 'Ready';
                    statusText.className = 'text-xs font-medium text-green-600 transition-all duration-300';
                }
            }

            function goToNextCard() {
                if (isMoving) return; // Prevent rapid clicking during animation

                const visible = getVisibleCards();
                const maxIndex = Math.max(0, cards.length - visible);
                currentIndex = currentIndex < maxIndex ? currentIndex + 1 : 0;
                updateCarousel();
            }

            function goToCard(idx) {
                if (isMoving) return; // Prevent rapid clicking during animation

                currentIndex = idx;
                updateCarousel();
                stopAutoPlay();
                setTimeout(startAutoPlay, 5000);
            }

            function startAutoPlay() {
                stopAutoPlay();
                autoPlayInterval = setInterval(goToNextCard, 3000);
            }

            function stopAutoPlay() {
                if (autoPlayInterval) clearInterval(autoPlayInterval);
            }

            // Carousel event listeners
            indicators.forEach((indicator, idx) => {
                indicator.addEventListener('click', () => goToCard(idx));
            });

            if (carousel) {
                carousel.addEventListener('mouseenter', stopAutoPlay);
                carousel.addEventListener('mouseleave', startAutoPlay);
            }

            window.addEventListener('resize', updateCarousel);

            // Initialize carousel
            updateCarousel();
            startAutoPlay();

            // Handle visibility change
            document.addEventListener('visibilitychange', () => {
                if (document.hidden) {
                    stopAutoPlay();
                } else {
                    startAutoPlay();
                }
            });

            // Cleanup on page unload
            window.addEventListener('beforeunload', () => {
                stopAutoPlay();
                if (movingTimeout) {
                    clearTimeout(movingTimeout);
                }
            });

            // Optional: Manual control buttons (if they exist)
            if (autoPlayToggle) {
                let isAutoPlayEnabled = true;

                autoPlayToggle.addEventListener('click', () => {
                    isAutoPlayEnabled = !isAutoPlayEnabled;

                    if (isAutoPlayEnabled) {
                        startAutoPlay();
                        autoPlayToggle.textContent = 'Auto Play ON';
                        autoPlayToggle.className =
                            'px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-all font-medium';
                    } else {
                        stopAutoPlay();
                        autoPlayToggle.textContent = 'Auto Play OFF';
                        autoPlayToggle.className =
                            'px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-all font-medium';
                    }
                });
            }

            // =============================================
            // ADDITIONAL ENHANCEMENTS
            // =============================================

            // Smooth scroll for anchor links, only if href is still "#" or "#id"
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    // Hanya preventDefault jika href adalah "#" atau id di halaman
                    const href = this.getAttribute('href');
                    if (href === '#' || document.querySelector(href)) {
                        e.preventDefault();
                        const target = document.querySelector(href);
                        if (target) {
                            target.scrollIntoView({
                                behavior: 'smooth',
                                block: 'start'
                            });
                        }
                    }
                    // Jika href sudah berubah ke URL Maps, biarkan default (buka link)
                });
            });

            // Di bagian akhir DOMContentLoaded, tambahkan ini:
            document.querySelectorAll('#gridView .cafe-card').forEach(card => {
                card.addEventListener('click', function(event) {
                    // Cegah event bubbling jika diklik elemen tertentu
                    const forbiddenElements = ['A', 'BUTTON', 'INPUT', 'TEXTAREA', 'SELECT', 'LABEL'];
                    let target = event.target;
                    
                    while (target !== this) {
                        if (forbiddenElements.includes(target.tagName) || 
                            target.isContentEditable || 
                            target.hasAttribute('onclick')) {
                            return;
                        }
                        target = target.parentElement;
                    }
                    
                    // Buka modal
                    const cafeData = JSON.parse(this.dataset.cafe);
                    openCafeModal(cafeData);
                });
            });

            
            // Add fade-in animation CSS
            const style = document.createElement('style');
            style.textContent = `
                @keyframes fadeIn {
                    from { opacity: 0; transform: translateY(10px); }
                    to { opacity: 1; transform: translateY(0); }
                }
                .animate-fade-in {
                    animation: fadeIn 0.3s ease-out forwards;
                }
            `;
            document.head.appendChild(style);
        });

        // Add fade-in animation CSS
        const style = document.createElement('style');
        style.textContent = `
            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(10px); }
                to { opacity: 1; transform: translateY(0); }
            }
            .animate-fade-in {
                animation: fadeIn 0.3s ease-out forwards;
            }
        `;
        document.head.appendChild(style);
    </script>

    @stack('scripts')
</body>

</html>