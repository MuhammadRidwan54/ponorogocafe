<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Rekomendasi Cafe - Ponorogo')</title>
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
                            600: '#7C6A46',
                            700: '#b45309',
                            800: '#92400e',
                            900: '#78350f',
                        }
                    }
                }
            }
        }
    </script>
    <style style>
        :root {
            /* Color Variables - Enhanced */
            --primary: #7c6a46;
            --primary-light: #f5f2eb;
            --primary-dark: #5a4d33;
            --primary-border: #d4c9ac;
            --primary-hover: #6b5a3d;

            /* Gray Scale - More comprehensive */
            --gray-50: #f9fafb;
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-300: #d1d5db;
            --gray-400: #9ca3af;
            --gray-500: #6b7280;
            --gray-600: #4b5563;
            --gray-700: #374151;
            --gray-800: #1f2937;
            --gray-900: #111827;

            /* Status Colors */
            --success: #10b981;
            --warning: #f59e0b;
            --error: #ef4444;
            --info: #3b82f6;

            /* Typography Scale */
            --text-xs: 0.75rem;
            --text-sm: 0.875rem;
            --text-base: 1rem;
            --text-lg: 1.125rem;
            --text-xl: 1.25rem;
            --text-2xl: 1.5rem;

            /* Line Heights */
            --leading-tight: 1.25;
            --leading-normal: 1.5;
            --leading-relaxed: 1.625;

            /* Spacing Scale */
            --space-0: 0;
            --space-px: 1px;
            --space-0-5: 0.125rem;
            --space-1: 0.25rem;
            --space-2: 0.5rem;
            --space-3: 0.75rem;
            --space-4: 1rem;
            --space-5: 1.25rem;
            --space-6: 1.5rem;
            --space-8: 2rem;
            --space-10: 2.5rem;
            --space-12: 3rem;

            /* Border Radius */
            --radius-sm: 0.125rem;
            --radius-md: 0.375rem;
            --radius-lg: 0.5rem;
            --radius-xl: 0.75rem;
            --radius-2xl: 1rem;
            --radius-full: 9999px;

            /* Shadows - Enhanced */
            --shadow-xs: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-sm: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            --shadow-2xl: 0 25px 50px -12px rgba(0, 0, 0, 0.25);

            /* Transitions - More options */
            --transition-fast: all 0.15s cubic-bezier(0.4, 0, 0.2, 1);
            --transition-base: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            --transition-slow: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);

            /* Z-index Scale */
            --z-dropdown: 1000;
            --z-sticky: 1020;
            --z-fixed: 1030;
            --z-modal-backdrop: 1040;
            --z-modal: 1050;
            --z-popover: 1060;
            --z-tooltip: 1070;

            /* Breakpoints (for reference) */
            --bp-sm: 640px;
            --bp-md: 768px;
            --bp-lg: 1024px;
            --bp-xl: 1280px;
            --bp-2xl: 1536px;
        }

        /* Base Styles - Improved */
        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        * {
            transition: var(--transition-base);
        }

        /* Reduce motion for accessibility */
        @media (prefers-reduced-motion: reduce) {

            *,
            *::before,
            *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
                scroll-behavior: auto !important;
            }
        }

        /* Improved Focus Management */
        :focus {
            outline: none;
        }

        :focus-visible {
            outline: 2px solid var(--primary);
            outline-offset: 2px;
            border-radius: var(--radius-sm);
        }

        /* Skip to content link for accessibility */
        .skip-to-content {
            position: absolute;
            top: -40px;
            left: 6px;
            background: var(--primary);
            color: white;
            padding: 8px;
            text-decoration: none;
            border-radius: var(--radius-md);
            z-index: var(--z-tooltip);
        }

        .skip-to-content:focus {
            top: 6px;
        }

        /* Navbar - Enhanced */
        .navbar-custom {
            background-color: var(--primary);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(124, 106, 70, 0.1);
        }

        .navbar-link {
            color: white;
            transition: var(--transition-fast);
            position: relative;
        }

        .navbar-link::after {
            content: "";
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 0;
            height: 2px;
            background-color: white;
            transition: width var(--transition-fast);
        }

        .navbar-link:hover {
            color: rgba(255, 255, 255, 0.9);
        }

        .navbar-link:hover::after {
            width: 100%;
        }

        /* Search Container - Improved */
        .search-container {
            display: flex;
            align-items: center;
            gap: var(--space-2);
            padding: var(--space-3) var(--space-5);
            background: linear-gradient(135deg, var(--gray-100) 0%, var(--gray-200) 100%);
            border-radius: var(--radius-full);
            box-shadow: var(--shadow-md);
            border: 1px solid var(--gray-300);
            position: relative;
            overflow: hidden;
        }

        .search-container::before {
            content: "";
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.6s;
        }

        .search-container:hover::before {
            left: 100%;
        }

        .search-container:hover {
            background: linear-gradient(135deg, var(--gray-200) 0%, var(--gray-300) 100%);
            box-shadow: var(--shadow-lg);
            transform: translateY(-1px);
        }

        .search-container:focus-within {
            box-shadow: var(--shadow-lg), 0 0 0 3px rgba(124, 106, 70, 0.1);
            border-color: var(--primary);
        }

        /* Filter Dropdown - Enhanced */
        #filterDropdown {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            animation: slideDown 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        #filterDropdown.hidden {
            animation: slideUp 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        #filterDropdown h3 {
            font-weight: 600;
            font-size: var(--text-lg);
            color: white;
            text-align: left;
            margin-bottom: var(--space-4);
            position: relative;
            padding-bottom: var(--space-2);
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
            font-size: var(--text-base);
            color: var(--gray-700);
            padding: var(--space-2);
            text-align: left;
            min-width: 0;
            /* Prevent flex item from overflowing */
        }

        #searchInput::placeholder {
            color: var(--gray-400);
            text-align: left;
        }

        /* Filter Sections */
        .filter-section {
            margin-bottom: var(--space-6);
        }

        .filter-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: var(--space-2);
            justify-content: flex-start;
        }

        /* Selected Filters - Improved */
        #selectedFilters {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: var(--space-2);
            overflow-x: auto;
            scrollbar-width: none;
            -ms-overflow-style: none;
            max-height: 60px;
            overflow-y: hidden;
        }

        #selectedFilters::-webkit-scrollbar {
            display: none;
        }

        /* Filter Chips - Enhanced */
        .filter-chip {
            background-color: var(--primary-light) !important;
            color: var(--primary) !important;
            border: 1px solid var(--primary-border) !important;
            font-weight: 500;
            letter-spacing: 0.025em;
            display: inline-flex;
            align-items: center;
            gap: var(--space-2);
            padding: var(--space-2) var(--space-3);
            border-radius: var(--radius-full);
            font-size: var(--text-sm);
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
            box-shadow: var(--shadow-md);
        }

        .filter-chip-close {
            color: var(--primary);
            font-weight: 600;
            font-size: var(--text-base);
            line-height: 1;
            padding: var(--space-1);
            border-radius: var(--radius-full);
            transition: var(--transition-fast);
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

        /* Button Improvements */
        button[type="submit"] {
            background-color: var(--primary);
            color: white;
            border-radius: var(--radius-full);
            padding: var(--space-2) var(--space-6);
            font-weight: 500;
            flex-shrink: 0;
            border: 1px solid var(--primary);
            position: relative;
            overflow: hidden;
            cursor: pointer;
        }

        button[type="submit"]::before {
            content: "";
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        button[type="submit"]:hover::before {
            left: 100%;
        }

        button[type="submit"]:hover {
            background-color: var(--primary-hover);
            transform: translateY(-1px) scale(1.02);
            box-shadow: var(--shadow-md);
        }

        button[type="submit"]:active {
            transform: translateY(0) scale(0.98);
        }

        button[type="submit"]:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        /* Jam Buka Buttons - Enhanced */
        button[type="submit"][name="jam_buka"] {
            font-weight: 500;
            letter-spacing: 0.025em;
            position: relative;
            overflow: hidden;
            transition: var(--transition-base);
            border: 2px solid var(--primary);
            background-color: white;
            color: var(--primary);
        }

        button[type="submit"][name="jam_buka"].active,
        button[type="submit"][name="jam_buka"].selected,
        button[type="submit"][name="jam_buka"].bg-amber-700,
        button[type="submit"][name="jam_buka"][class*="bg-amber"] {
            background-color: var(--primary) !important;
            color: white !important;
            border-color: var(--primary) !important;
        }

        button[type="submit"][name="jam_buka"]:hover {
            background-color: var(--primary-hover) !important;
            color: white !important;
            box-shadow: var(--shadow-lg);
            transform: translateY(-2px) scale(1.05);
        }

        button[type="submit"][name="jam_buka"]:active {
            transform: translateY(0) scale(0.98);
        }

        /* Pill Buttons */
        .pill-button {
            border: 1px solid transparent;
            position: relative;
            overflow: hidden;
            transition: var(--transition-base);
        }

        .pill-button::before {
            content: "";
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .pill-button:hover::before {
            left: 100%;
        }

        .pill-button.selected {
            background-color: var(--primary-light) !important;
            color: var(--primary) !important;
            border-color: var(--primary) !important;
            transform: scale(1.05);
            box-shadow: var(--shadow-sm);
        }

        /* Cards - Enhanced */
        .cafe-card {
            cursor: pointer;
            transition: var(--transition-base);
            border-radius: var(--radius-lg);
            overflow: hidden;
            position: relative;
            min-width: 260px;
            max-width: 320px;
            width: 100%;
        }

        .cafe-card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, transparent 0%, rgba(124, 106, 70, 0.05) 100%);
            opacity: 0;
            transition: opacity var(--transition-base);
            pointer-events: none;
            z-index: 1;
        }

        .cafe-card:hover::before {
            opacity: 1;
        }

        .cafe-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: var(--shadow-xl);
        }

        .cafe-card:active {
            transform: translateY(-4px) scale(1.01);
        }

        /* Loading States */
        .search-loading {
            position: relative;
            pointer-events: none;
            opacity: 0.7;
        }

        .search-loading::after {
            content: "";
            position: absolute;
            top: 50%;
            left: 50%;
            width: 16px;
            height: 16px;
            margin: -8px 0 0 -8px;
            border: 2px solid currentColor;
            border-radius: 50%;
            border-top-color: transparent;
            animation: spin 1s linear infinite;
        }

        /* Indicator Dots */
        .indicator-container {
            display: flex;
            justify-content: center;
            gap: 8px;
            margin-top: 1.5rem;
        }
        
        .indicator-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background-color: #d1d5db; /* bg-gray-300 */
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
        }
        
        .indicator-dot.active {
            background-color: #7c6a46; /* bg-amber-600 */
            width: 32px;
            border-radius: 9999px;
        }
        
        .indicator-dot::before {
            content: '';
            position: absolute;
            top: -4px;
            left: -4px;
            right: -4px;
            bottom: -4px;
            border-radius: inherit;
            background-color: rgba(217, 119, 6, 0.1); /* amber-600 dengan opacity */
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .indicator-dot:hover::before {
            opacity: 1;
        }
        
        .indicator-dot.active::before {
            opacity: 0;
        }

        /* Backdrop Blur */
        .backdrop-blur-sm {
            backdrop-filter: blur(4px);
            -webkit-backdrop-filter: blur(4px);
        }

        #cafeModal {
            transition: opacity 0.3s ease;
        }

        #cafeModal .inline-block {
            transition: transform 0.3s ease, opacity 0.3s ease;
        }

        #cafeModal.hidden {
            opacity: 0;
            pointer-events: none;
        }

        #cafeModal.hidden .inline-block {
            transform: translateY(-20px);
            opacity: 0;
        }

        /* Animations - Enhanced */
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px) scale(0.95);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        @keyframes slideUp {
            from {
                opacity: 1;
                transform: translateY(0) scale(1);
            }

            to {
                opacity: 0;
                transform: translateY(-20px) scale(0.95);
            }
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.5;
            }
        }

        /* Skeleton Loading */
        .skeleton {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
            background-color: var(--gray-200);
            border-radius: var(--radius-md);
        }

        .skeleton-text {
            height: 1rem;
            background-color: var(--gray-200);
            border-radius: var(--radius-sm);
            width: 75%;
            margin-bottom: var(--space-2);
        }

        .skeleton-avatar {
            height: 3rem;
            width: 3rem;
            background-color: var(--gray-200);
            border-radius: var(--radius-full);
        }

        /* Utilities */
        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        .sr-only {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            white-space: nowrap;
            border: 0;
        }

        /* Responsive Design - Enhanced */
        @media (max-width: 640px) {
            :root {
                --text-base: 0.9375rem;
                --space-4: 0.875rem;
                --space-6: 1.25rem;
            }

            .search-container {
                flex-direction: column;
                align-items: stretch;
                padding: var(--space-3);
                gap: var(--space-3);
            }

            #selectedFilters {
                order: 2;
                /* width: 100%; */
                margin-top: var(--space-2);
                justify-content: flex-start;
            }

            .filter-chip {
                font-size: var(--text-xs);
                padding: var(--space-1) var(--space-2);
                max-width: 150px;
            }

            button[type="submit"] {
                justify-content: center;
            }

            .cafe-card:hover {
                transform: translateY(-4px) scale(1.01);
            }
        }

        @media (max-width: 480px) {
            .filter-chip {
                max-width: 120px;
                font-size: 0.7rem;
            }

            #filterDropdown {
                margin: var(--space-2);
                border-radius: var(--radius-xl);
            }
        }

        /* High contrast mode support */
        @media (prefers-contrast: high) {
            :root {
                --primary: #5a4d33;
                --primary-light: #f0f0f0;
                --primary-border: #333;
            }

            .filter-chip {
                border-width: 2px !important;
            }

            button[type="submit"] {
                border-width: 2px;
            }
        }

        /* Dark mode support (if needed) */
        @media (prefers-color-scheme: dark) {
            :root {
                --gray-50: #1f2937;
                --gray-100: #374151;
                --gray-200: #4b5563;
                --gray-300: #6b7280;
                --gray-400: #9ca3af;
                --gray-500: #d1d5db;
                --gray-600: #e5e7eb;
                --gray-700: #f3f4f6;
                --gray-800: #f9fafb;
                --gray-900: #ffffff;
            }
        }

        /* Print styles */
        @media print {

            .search-container,
            #filterDropdown,
            button {
                display: none !important;
            }

            .cafe-card {
                break-inside: avoid;
                box-shadow: none !important;
                border: 1px solid var(--gray-300);
            }
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
    <!-- JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // =============================================
            // FILTER AND SEARCH FUNCTIONALITY (EXISTING CODE)
            // =============================================
            // Element references
            const toggleBtn = document.getElementById('toggleFilter');
            const dropdown = document.getElementById('filterDropdown');
            const searchDropdown = document.getElementById('searchDropdown');
            const searchButton = document.getElementById('searchButton');
            const showFiltersBtn = document.getElementById('showFilters');
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
            if (toggleBtn) {
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

                // Update search input visibility
                const searchInput = document.getElementById('searchInput');
                if (activeFilters.length === 0) {
                    selectedFilters.classList.add('hidden');
                    searchInput?.classList.remove('hidden');
                    searchInput?.style.removeProperty('flex-grow');
                } else {
                    selectedFilters.classList.remove('hidden');
                    searchInput?.classList.add('hidden');
                    searchInput?.style.setProperty('flex-grow', '0');
                }

                // Create filter chips with animation
                activeFilters.forEach((filter, index) => {
                    const chip = document.createElement('div');
                    chip.className = 'filter-chip animate-fade-in';
                    chip.style.animationDelay = `${index * 50}ms`;
                    chip.innerHTML = `
                        <span>${filter.label}</span>
                        <button type="button" class="filter-chip-close" onclick="clearFilter('${filter.name}', '${filter.value}')">
                            ×
                        </button>
                    `;
                    selectedFilters.appendChild(chip);
                });

                // Add animation styles if not already present
                if (!document.getElementById('filter-chip-animations')) {
                    const style = document.createElement('style');
                    style.id = 'filter-chip-animations';
                    style.textContent = `
                        @keyframes fadeIn {
                            from { opacity: 0; transform: translateY(5px); }
                            to { opacity: 1; transform: translateY(0); }
                        }
                        .animate-fade-in {
                            animation: fadeIn 0.3s ease-out forwards;
                        }
                    `;
                    document.head.appendChild(style);
                }
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
                    const searchValue = searchForm.querySelector('input[name="search"]')?.value?.trim();
                    const radioChecked = searchForm.querySelector('input[type="radio"]:checked');
                    const checkboxChecked = searchForm.querySelector('input[type="checkbox"]:checked');

                    if (!searchValue && !radioChecked && !checkboxChecked) {
                        e.preventDefault();
                        alert('Silakan masukkan kata kunci pencarian atau pilih minimal satu filter.');
                        return false;
                    }

                    const submitBtn = searchForm.querySelector('button[type="submit"]');
                    if (submitBtn) {
                        const originalContent = submitBtn.innerHTML;
                        submitBtn.innerHTML = `
                            <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Mencari...
                        `;
                        submitBtn.disabled = true;
                    }
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

            // Auto-hide dropdowns after form submission
            document.addEventListener('beforeunload', function() {
                if (searchDropdown) searchDropdown.classList.add('hidden');
                if (dropdown) dropdown.classList.add('hidden');
            });

            if (clearFilters) {
                clearFilters.addEventListener('click', function(e) {
                    e.preventDefault();

                    // Reset all inputs
                    document.querySelectorAll('input[type="radio"]:checked, input[type="checkbox"]:checked')
                        .forEach(input => {
                            input.checked = false;
                            if (input.nextElementSibling) input.nextElementSibling.classList.remove(
                                'selected');
                        });

                    // Clear UI
                    if (selectedFilters) {
                        selectedFilters.innerHTML = '';
                        selectedFilters.classList.add('hidden');
                    }

                    [searchInput, advancedSearchInput].forEach(input => {
                        if (input) input.value = '';
                    });

                    [dropdown, searchDropdown].forEach(dropdown => {
                        if (dropdown) dropdown.classList.add('hidden');
                    });

                    // Redirect
                    window.location.href = window.location.origin + window.location.pathname;
                });
            }

            // =============================================
            // CAFE MODAL FUNCTIONALITY (ENHANCED)
            // =============================================
            const cafeModal = document.getElementById('cafeModal');
            const closeModal = document.getElementById('closeModal');
            const closeModalBtn = document.getElementById('closeModalBtn');

            // Function to open modal with animations
            window.openCafeModal = function(cafeData) {
                if (!cafeModal) return;
                
                // Fill modal with cafe data
                document.getElementById('modalCafeName').textContent = cafeData.nama_cafe || 'Nama Cafe';
                document.getElementById('modalCafeAddress').textContent = cafeData.alamat || 'Alamat tidak tersedia';
                
                const modalImage = document.getElementById('modalCafeImage');
                if (modalImage) {
                    modalImage.src = cafeData.thumbnail ? '{{ asset('storage') }}/' + cafeData.thumbnail : '';
                    modalImage.alt = cafeData.nama_cafe || 'Cafe Image';
                }

                // Handle relational data
                document.getElementById('modalCafeHours').textContent = cafeData.jambuka?.jam_buka || 'Tidak diketahui';
                document.getElementById('modalCafePrice').textContent = cafeData.hargamenu?.harga_menu || 'Tidak diketahui';
                document.getElementById('modalCafeCapacity').textContent = cafeData.kapasitasruang?.kapasitas_ruang || 'Tidak diketahui';
                document.getElementById('modalCafeParking').textContent = cafeData.tempatparkir?.tempat_parkir || 'Tidak diketahui';
                
                // Google Maps link
                const modalMaps = document.getElementById('modalCafeMaps');
                if (modalMaps) {
                    modalMaps.href = cafeData.alamat_url || 
                        `https://www.google.com/maps/search/?api=1&query=${encodeURIComponent((cafeData.nama_cafe || '') + ' ' + (cafeData.alamat || ''))}`;
                }
                
                // Facilities
                const facilitiesContainer = document.getElementById('modalCafeFacilities');
                if (facilitiesContainer) {
                    facilitiesContainer.innerHTML = '';
                    if (cafeData.fasilitas?.length > 0) {
                        cafeData.fasilitas.forEach(facility => {
                            const facilityBadge = document.createElement('span');
                            facilityBadge.className = 'bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-xs';
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

                // Gallery Images
                const galleryContainer = document.getElementById('cafeGallery');
                if (galleryContainer) {
                    galleryContainer.innerHTML = '';
                    
                    if (cafeData.gambar) {
                        let images = cafeData.gambar;
                        if (typeof cafeData.gambar === 'string') {
                            try {
                                images = JSON.parse(cafeData.gambar);
                            } catch (e) {
                                console.error('Error parsing gallery images:', e);
                                images = [];
                            }
                        }

                        if (images.length > 0) {
                            const mainImage = document.getElementById('modalCafeImage');
                            let activeIndex = -1;
                            
                            const changeMainImage = (imagePath, index) => {
                                if (activeIndex === index) {
                                    activeIndex = -1;
                                } else {
                                    activeIndex = index;
                                    mainImage.classList.add('opacity-0');
                                    setTimeout(() => {
                                        mainImage.src = '{{ asset('storage') }}/' + imagePath;
                                        mainImage.onload = () => {
                                            mainImage.classList.remove('opacity-0');
                                        };
                                    }, 150);
                                }

                                document.querySelectorAll('.gallery-thumbnail').forEach((thumb, i) => {
                                    thumb.classList.toggle('thumbnail-active', i === activeIndex);
                                    thumb.classList.toggle('thumbnail-inactive', i !== activeIndex);
                                });
                            };
                            
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
                            
                            images.forEach((image, index) => {
                                const thumbnail = document.createElement('img');
                                thumbnail.src = '{{ asset('storage') }}/' + image;
                                thumbnail.alt = `Thumbnail ${index + 1}`;
                                thumbnail.className = 'gallery-thumbnail w-full h-24 object-cover rounded-lg cursor-pointer transition-all thumbnail-inactive';
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
                }
                
                // Show modal with blur background
                cafeModal.classList.remove('hidden');
                document.body.classList.add('overflow-hidden');
                document.querySelector('#cafeModal .bg-gray-500').classList.add('backdrop-blur-sm');
            };

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
                document.querySelector('#cafeModal .bg-gray-500').classList.remove('backdrop-blur-sm');
            }

            // Close modal when clicking X button
            if (closeModal) {
                closeModal.addEventListener('click', function(e) {
                    e.stopPropagation();
                    closeCafeModal();
                });
            }

            // Close modal when clicking close button
            if (closeModalBtn) {
                closeModalBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    closeCafeModal();
                });
            }

            // Close modal when clicking outside
            cafeModal.addEventListener('click', function(e) {
                if (!modalContent.contains(e.target)) {
                    closeCafeModal();
                }
            });

            // Add click event to all cafe cards
            document.querySelectorAll('.cafe-card').forEach(card => {
                card.addEventListener('click', function(event) {
                    try {
                        const cafeData = JSON.parse(this.dataset.cafe);
                        openCafeModal(cafeData);
                    } catch (e) {
                        console.error('Error parsing cafe data:', e);
                    }
                });
            });

            // =============================================
            // CAROUSEL FUNCTIONALITY (ENHANCED 4 CARD DESKTOP)
            // =============================================
            const carousel = document.getElementById('cafeCarousel');
            const cards = carousel ? carousel.querySelectorAll('.cafe-card') : [];
            const indicators = document.querySelectorAll('.indicator-dot');
            let currentIndex = 0;
            let autoPlayInterval;

            function getVisibleCards() {
                if (window.innerWidth >= 1024) return 4;
                if (window.innerWidth >= 768) return 2;
                return 1;
            }

            function updateCarousel() {
                const visible = getVisibleCards();
                const cardWidth = cards[0]?.offsetWidth || 300;
                const gap = 24;
                const translateX = -(currentIndex * (cardWidth + gap));
                carousel.style.transform = `translateX(${translateX}px)`;
                indicators.forEach((indicator, idx) => {
                    indicator.classList.toggle('active', idx === currentIndex);
                });
            }

            function goToNextCard() {
                const visible = getVisibleCards();
                const maxIndex = cards.length - visible;
                currentIndex = currentIndex < maxIndex ? currentIndex + 1 : 0;
                updateCarousel();
            }

            function goToCard(idx) {
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

            indicators.forEach((indicator, idx) => {
                indicator.addEventListener('click', () => goToCard(idx));
            });

            carousel.addEventListener('mouseenter', stopAutoPlay);
            carousel.addEventListener('mouseleave', startAutoPlay);
            window.addEventListener('resize', updateCarousel);

            updateCarousel();
            startAutoPlay();

            document.addEventListener('visibilitychange', () => {
                if (document.hidden) stopAutoPlay();
                else startAutoPlay();
            });

            // =============================================
            // ADDITIONAL ENHANCEMENTS
            // =============================================
            // Handle filter chip selection
            document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    this.nextElementSibling.classList.toggle('bg-[#6e5832]', this.checked);
                    this.nextElementSibling.classList.toggle('text-white', this.checked);
                    this.nextElementSibling.classList.toggle('border-[#6e5832]', this.checked);
                });
            });

            // Handle chip removal
            document.querySelectorAll('.remove-chip').forEach(chip => {
                chip.addEventListener('click', function() {
                    const chipId = this.getAttribute('data-id');
                    document.querySelector(`input[value="${chipId}"]`).checked = false;
                    this.parentElement.remove();
                });
            });
        });
    </script>
    @stack('scripts')
</body>

</html>
