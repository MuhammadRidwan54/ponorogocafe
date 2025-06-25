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
    /* Custom navbar color */
    .navbar-custom {
        background-color: #7C6A46 !important;
    }

    /* Scrollbar hide utility */
    .scrollbar-hide {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }

    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }

    /* Enhanced search container styles */
    .search-container {
        background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
        transition: all 0.3s ease;
    }

    .search-container:hover {
        background: linear-gradient(135deg, #e5e7eb 0%, #d1d5db 100%);
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
    }

    /* UPDATED: Enhanced filter chip styles with custom color #7C6A46 */
    .filter-chip {
        background-color: #7C6A46 !important;
        color: white !important;
        border: 1px solid #5a4d33 !important;
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.875rem;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 2px 4px rgba(124, 106, 70, 0.2);
    }

    .filter-chip:hover {
        background-color: #5a4d33 !important;
        transform: scale(1.05);
        box-shadow: 0 4px 8px rgba(124, 106, 70, 0.3);
    }

    .filter-chip.active {
        background-color: #5a4d33 !important;
        color: white !important;
        border-color: #4a3f2a !important;
        transform: scale(1.05);
        box-shadow: 0 4px 6px -1px rgba(124, 106, 70, 0.4);
    }

    .filter-chip .remove-btn {
        color: white !important;
        transition: color 0.2s ease;
        font-weight: bold;
        font-size: 1.125rem;
        line-height: 1;
        padding: 0;
        margin: 0;
        background: none;
        border: none;
        cursor: pointer;
    }

    .filter-chip .remove-btn:hover {
        color: #f3f4f6 !important;
        transform: scale(1.2);
    }

    /* Enhanced cafe card styles */
    .cafe-card {
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        cursor: pointer;
    }

    .cafe-card:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15), 0 20px 25px -5px rgba(0, 0, 0, 0.1);
    }

    .cafe-card:active {
        transform: translateY(-4px) scale(1.01);
    }

    /* Enhanced pill button styles with navbar color */
    .pill-button {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid transparent;
        position: relative;
        overflow: hidden;
    }

    .pill-button::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s;
    }

    .pill-button:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    .pill-button:hover::before {
        left: 100%;
    }

    .pill-button.selected,
    .pill-button:has(input:checked) {
        background-color: #7C6A46 !important;
        color: white !important;
        transform: scale(1.05);
        box-shadow: 0 6px 10px -2px rgba(124, 106, 70, 0.4);
        border-color: #5a4d33;
    }

    /* Filter dropdown with navbar color theme - REMOVED BORDER/OUTLINE */
    #filterDropdown {
        background-color: #7C6A46 !important;
        border: none !important;
        outline: none !important;
        animation: slideDown 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        backdrop-filter: blur(10px);
    }

    /* ADDED: Filter dropdown section headings - aligned to left */
    #filterDropdown h3 {
        font-weight: bold;
        font-size: 1.125rem;
        color: white;
        margin-bottom: 1rem;
        text-align: left !important;
        padding-left: 0 !important;
        margin-left: 0 !important;
    }

    /* ADDED: Filter dropdown sections - aligned content */
    #filterDropdown .filter-section {
        margin-bottom: 2rem;
    }

    #filterDropdown .filter-section:last-of-type {
        margin-bottom: 2rem;
    }

    /* ADDED: Filter button containers - aligned to left */
    #filterDropdown .filter-buttons {
        display: flex;
        flex-wrap: wrap;
        gap: 0.75rem;
        justify-content: flex-start;
        align-items: flex-start;
    }

    /* Filter toggle button with navbar color */
    #toggleFilter {
        transition: all 0.3s ease;
        color: #7C6A46 !important;
    }

    #toggleFilter:hover {
        background-color: rgba(124, 106, 70, 0.1) !important;
        transform: scale(1.1);
    }

    #toggleFilter:active {
        transform: scale(0.95);
    }

    /* Search button with navbar color */
    button[type="submit"] {
        background-color: #7C6A46 !important;
        font-weight: 500;
        letter-spacing: 0.025em;
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    button[type="submit"]:hover {
        background-color: #5a4d33 !important;
        transform: scale(1.05);
        box-shadow: 0 10px 15px -3px rgba(124, 106, 70, 0.3);
    }

    button[type="submit"]::before {
        content: '';
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

    button[type="submit"]:active {
        transform: scale(0.98);
    }

    /* Reset filter button with navbar color */
    #clearFilters {
        background-color: white !important;
        color: #7C6A46 !important;
        border: 2px solid #7C6A46 !important;
    }

    #clearFilters:hover {
        background-color: #7C6A46 !important;
        color: white !important;
        transform: scale(1.05);
        box-shadow: 0 6px 10px -2px rgba(124, 106, 70, 0.3);
    }

    /* Carousel enhancements */
    .carousel-item {
        scroll-snap-align: center;
        transition: all 0.3s ease;
    }

    #cafeCarousel {
        scroll-behavior: smooth;
    }

    .indicator-dot {
        cursor: pointer;
        transition: all 0.3s ease;
        width: 12px;
        height: 12px;
        border-radius: 50%;
    }

    .indicator-dot:hover {
        opacity: 0.7;
        transform: scale(1.2);
    }

    .indicator-dot.active {
        background-color: #7C6A46 !important;
        transform: scale(1.3);
        box-shadow: 0 0 0 2px rgba(124, 106, 70, 0.3);
    }

    /* Search input enhancements */
    #searchInput {
        transition: all 0.3s ease;
    }

    #searchInput:focus {
        outline: none;
        transform: scale(1.01);
    }

    #searchInput::placeholder {
        color: #6b7280;
        font-weight: 400;
        transition: color 0.3s ease;
    }

    #searchInput:focus::placeholder {
        color: #9ca3af;
    }

    /* Filter dropdown animations */
    #filterDropdown.hidden {
        animation: slideUp 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

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

    /* Loading states */
    .loading {
        pointer-events: none;
        opacity: 0.7;
        position: relative;
    }

    .loading::after {
        content: '';
        width: 16px;
        height: 16px;
        margin-left: 8px;
        border: 2px solid transparent;
        border-top: 2px solid currentColor;
        border-radius: 50%;
        animation: spin 1s linear infinite;
        display: inline-block;
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }

    /* Pulse animation for active elements */
    @keyframes pulse {
        0%, 100% {
            opacity: 1;
        }
        50% {
            opacity: 0.7;
        }
    }

    .pulse {
        animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }

    /* Enhanced responsive design */
    @media (max-width: 768px) {
        .search-container {
            padding: 1rem;
            flex-direction: column;
            gap: 0.75rem;
            border-radius: 1.5rem;
        }
        
        #toggleFilter {
            align-self: flex-start;
        }
        
        button[type="submit"] {
            align-self: stretch;
            padding: 0.75rem 1.5rem;
            justify-content: center;
        }
        
        .pill-button {
            font-size: 0.875rem;
            padding: 0.5rem 1rem;
        }
        
        .cafe-card:hover {
            transform: translateY(-4px) scale(1.01);
        }
        
        .filter-chip {
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
            gap: 0.25rem;
        }
    }

    @media (max-width: 640px) {
        .min-w-[280px] {
            min-width: 250px;
        }
        
        #filterDropdown {
            margin-top: 1rem;
            padding: 1.5rem;
            border-radius: 1.5rem;
            border: none !important;
            outline: none !important;
        }
        
        .filter-chip {
            font-size: 0.75rem;
            padding: 0.25rem 0.75rem;
        }

        /* ADDED: Mobile responsive for filter sections */
        #filterDropdown h3 {
            font-size: 1rem;
            margin-bottom: 0.75rem;
        }
        
        #filterDropdown .filter-section {
            margin-bottom: 1.5rem;
        }
    }

    /* Focus visible for accessibility */
    .pill-button:focus-visible,
    button:focus-visible {
        outline: 2px solid #7C6A46;
        outline-offset: 2px;
    }

    /* Smooth transitions for all interactive elements */
    * {
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Custom scrollbar for filter dropdown */
    #filterDropdown::-webkit-scrollbar {
        width: 6px;
    }

    #filterDropdown::-webkit-scrollbar-track {
        background: rgba(255, 255, 255, 0.1);
        border-radius: 3px;
    }

    #filterDropdown::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, 0.3);
        border-radius: 3px;
    }

    #filterDropdown::-webkit-scrollbar-thumb:hover {
        background: rgba(255, 255, 255, 0.5);
    }

    /* Additional navbar-related styles */
    .navbar-link {
        color: white !important;
        transition: color 0.3s ease;
    }

    .navbar-link:hover {
        color: rgba(255, 255, 255, 0.8) !important;
    }

    .navbar-brand {
        color: white !important;
        font-weight: bold;
    }

    .navbar-button {
        background-color: white !important;
        color: #7C6A46 !important;
        border: 2px solid white !important;
    }

    .navbar-button:hover {
        background-color: transparent !important;
        color: white !important;
        border-color: white !important;
    }

    /* Footer custom styling with #7C6A46 color */
    .footer-custom {
        background-color: #7C6A46;
    }

    /* Footer links hover effect */
    .footer-link {
        color: #6b7280;
        transition: all 0.3s ease;
        position: relative;
    }

    .footer-link:hover {
        color: #7C6A46 !important;
        transform: translateX(4px);
    }

    .footer-link::before {
        content: '';
        position: absolute;
        width: 0;
        height: 2px;
        bottom: -2px;
        left: 0;
        background-color: #7C6A46;
        transition: width 0.3s ease;
    }

    .footer-link:hover::before {
        width: 100%;
    }

    /* Social media icons */
    .social-icon {
        background-color: #7C6A46 !important;
        color: white !important;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .social-icon::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s;
    }

    .social-icon:hover::before {
        left: 100%;
    }

    .social-icon:hover {
        background-color: #5a4d33 !important;
        transform: scale(1.1) rotate(5deg);
        box-shadow: 0 4px 8px rgba(124, 106, 70, 0.3);
    }

    /* Brand icon */
    .brand-icon {
        color: #7C6A46 !important;
        transition: all 0.3s ease;
    }

    .brand-icon:hover {
        transform: rotate(45deg) scale(1.2);
        color: #5a4d33 !important;
    }

    /* Bottom border */
    .footer-border {
        border-top: 1px solid #7C6A46 !important;
        position: relative;
    }

    .footer-border::before {
        content: '';
        position: absolute;
        top: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 100px;
        height: 2px;
        background: linear-gradient(90deg, transparent, #7C6A46, transparent);
    }

    /* Heart icon animation */
    .heart-icon {
        color: #7C6A46 !important;
        animation: heartbeat 2s ease-in-out infinite;
    }

    @keyframes heartbeat {
        0% {
            transform: scale(1);
        }
        14% {
            transform: scale(1.2);
        }
        28% {
            transform: scale(1);
        }
        42% {
            transform: scale(1.2);
        }
        70% {
            transform: scale(1);
        }
    }

    /* Enhanced responsive design */
    @media (max-width: 768px) {
        .footer-link {
            padding: 0.5rem 0;
            display: block;
        }
        
        .social-icon {
            margin: 0.25rem;
        }
        
        .footer-border::before {
            width: 50px;
        }
    }

    /* Smooth scroll behavior for footer links */
    html {
        scroll-behavior: smooth;
    }

    /* Footer section titles */
    .footer-title {
        color: #374151;
        position: relative;
        padding-bottom: 0.5rem;
    }

    .footer-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 30px;
        height: 2px;
        background-color: #7C6A46;
        border-radius: 1px;
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
                    
                    // Hide filter dropdown if open
                    if (dropdown) {
                        dropdown.classList.add('hidden');
                    }
                    
                    // Toggle search dropdown
                    searchDropdown.classList.toggle('hidden');
                    
                    // Focus on advanced search input when dropdown opens
                    if (!searchDropdown.classList.contains('hidden') && advancedSearchInput) {
                        setTimeout(() => {
                            advancedSearchInput.focus();
                        }, 100);
                    }
                });
            }

            // Show filter dropdown when "Filter Lanjutan" is clicked
            if (showFiltersBtn && dropdown) {
                showFiltersBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    
                    // Hide search dropdown
                    if (searchDropdown) {
                        searchDropdown.classList.add('hidden');
                    }
                    
                    // Show filter dropdown
                    dropdown.classList.toggle('hidden');
                });
            }

            // Legacy toggle filter button (if still exists)
            if (toggleBtn && dropdown) {
                toggleBtn.addEventListener('click', (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    
                    // Hide search dropdown
                    if (searchDropdown) {
                        searchDropdown.classList.add('hidden');
                    }
                    
                    dropdown.classList.toggle('hidden');
                });
            }

            // Sync search inputs
            if (searchInput && advancedSearchInput) {
                searchInput.addEventListener('input', function() {
                    advancedSearchInput.value = this.value;
                });

                advancedSearchInput.addEventListener('input', function() {
                    searchInput.value = this.value;
                });
            }

            // Quick search functionality
            quickSearchBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    const searchTerm = this.textContent.trim();
                    if (searchInput) searchInput.value = searchTerm;
                    if (advancedSearchInput) advancedSearchInput.value = searchTerm;
                    
                    // Add visual feedback
                    this.classList.add('bg-amber-200', 'text-amber-900');
                    setTimeout(() => {
                        this.classList.remove('bg-amber-200', 'text-amber-900');
                    }, 200);
                });
            });

            // Close dropdowns when clicking outside
            document.addEventListener('click', function(e) {
                const searchContainer = document.querySelector('.search-container');
                const isClickInsideSearch = searchContainer && searchContainer.contains(e.target);
                const isClickInsideSearchDropdown = searchDropdown && searchDropdown.contains(e.target);
                const isClickInsideFilterDropdown = dropdown && dropdown.contains(e.target);
                
                if (!isClickInsideSearch && !isClickInsideSearchDropdown && !isClickInsideFilterDropdown) {
                    if (searchDropdown) searchDropdown.classList.add('hidden');
                    if (dropdown) dropdown.classList.add('hidden');
                }
            });

            // Enhanced search with Enter key
            [searchInput, advancedSearchInput].forEach(input => {
                if (input) {
                    input.addEventListener('keypress', function(e) {
                        if (e.key === 'Enter') {
                            e.preventDefault();
                            // Submit the form or trigger search
                            const form = this.closest('form');
                            if (form) {
                                form.submit();
                            } else {
                                // Fallback: redirect with search parameter
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

            // FIXED: Clear all filters function with redirect to home
            if (clearFilters) {
                clearFilters.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    // Clear all radio buttons and checkboxes
                    const inputs = document.querySelectorAll('input[type="radio"], input[type="checkbox"]');
                    inputs.forEach(input => {
                        input.checked = false;
                        // Remove selected styling from pill buttons
                        const span = input.nextElementSibling;
                        if (span) {
                            span.classList.remove('selected');
                        }
                    });
                    
                    // Clear selected filters display
                    if (selectedFilters) {
                        selectedFilters.innerHTML = '';
                        selectedFilters.classList.add('hidden');
                    }
                    
                    // Reset search inputs
                    if (searchInput) {
                        searchInput.value = '';
                        searchInput.placeholder = 'Cari kafe favorit Anda...';
                    }
                    if (advancedSearchInput) {
                        advancedSearchInput.value = '';
                    }
                    
                    // Close dropdowns
                    if (dropdown) dropdown.classList.add('hidden');
                    if (searchDropdown) searchDropdown.classList.add('hidden');
                    
                    // Redirect to home page to clear URL parameters
                    window.location.href = window.location.origin + window.location.pathname;
                });
            }

            // Function to update selected filters display
            function updateSelectedFilters() {
                if (!selectedFilters) return;
                
                selectedFilters.innerHTML = '';
                const activeFilters = [];

                // Get all checked inputs
                const checkedInputs = document.querySelectorAll('input[type="radio"]:checked, input[type="checkbox"]:checked');
                
                checkedInputs.forEach(input => {
                    const label = input.nextElementSibling ? input.nextElementSibling.textContent.trim() : input.value;
                    activeFilters.push({
                        name: input.name,
                        value: input.value,
                        label: label,
                        element: input
                    });
                });

                // Show/hide selected filters based on active filters
                if (activeFilters.length === 0) {
                    selectedFilters.classList.add('hidden');
                    updateSearchPlaceholder();
                    return;
                } else {
                    selectedFilters.classList.remove('hidden');
                    updateSearchPlaceholder();
                }

                // Create filter chips with improved styling
                activeFilters.forEach(filter => {
                    const chip = document.createElement('div');
                    chip.className = 'filter-chip inline-flex items-center gap-2 text-sm';
                    chip.innerHTML = `
                        <span>${filter.label}</span>
                        <button type="button" class="remove-btn" onclick="clearFilter('${filter.name}', '${filter.value}')">
                            ×
                        </button>
                    `;
                    selectedFilters.appendChild(chip);
                });
            }

            // Function to update search placeholder
            function updateSearchPlaceholder() {
                const checkedInputs = document.querySelectorAll('input[type="radio"]:checked, input[type="checkbox"]:checked');
                const hasFilters = checkedInputs.length > 0;
                
                if (searchInput) {
                    searchInput.placeholder = hasFilters ? 'Cari nama cafe...' : 'Cari kafe favorit Anda...';
                }
                if (advancedSearchInput) {
                    advancedSearchInput.placeholder = hasFilters ? 
                        'Cari nama cafe dengan filter yang dipilih...' : 
                        'Masukkan nama kafe, lokasi, atau kata kunci...';
                }
            }

            // Clear individual filter function
            window.clearFilter = function(name, value) {
                const input = document.querySelector(`input[name="${name}"][value="${value}"]`);
                if (input) {
                    input.checked = false;
                    // Remove selected styling from pill button
                    const span = input.nextElementSibling;
                    if (span) {
                        span.classList.remove('selected');
                    }
                    updateSelectedFilters();
                    updateSearchPlaceholder();
                    
                    // If no filters remain, update URL to remove filter parameters
                    const remainingFilters = document.querySelectorAll('input[type="radio"]:checked, input[type="checkbox"]:checked');
                    if (remainingFilters.length === 0) {
                        setTimeout(() => {
                            const currentUrl = new URL(window.location);
                            // Remove filter parameters but keep search if exists
                            const searchParam = currentUrl.searchParams.get('search');
                            currentUrl.search = '';
                            if (searchParam) {
                                currentUrl.searchParams.set('search', searchParam);
                            }
                            window.location.href = currentUrl.toString();
                        }, 300);
                    }
                }
            };

            // Add event listeners to all filter inputs
            document.querySelectorAll('input[type="radio"], input[type="checkbox"]').forEach(input => {
                input.addEventListener('change', function() {
                    // Update pill button styling
                    const span = this.nextElementSibling;
                    if (span) {
                        if (this.checked) {
                            span.classList.add('selected');
                        } else {
                            span.classList.remove('selected');
                        }
                    }
                    
                    // For radio buttons, uncheck others in the same group
                    if (this.type === 'radio' && this.checked) {
                        const otherRadios = document.querySelectorAll(`input[name="${this.name}"]`);
                        otherRadios.forEach(radio => {
                            if (radio !== this) {
                                const otherSpan = radio.nextElementSibling;
                                if (otherSpan) {
                                    otherSpan.classList.remove('selected');
                                }
                            }
                        });
                    }
                    
                    updateSelectedFilters();
                    updateSearchPlaceholder();
                });
            });

            // Enhanced form validation
            const searchForms = document.querySelectorAll('form');
            searchForms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    const searchValue = form.querySelector('input[name="search"]')?.value?.trim();
                    const radioChecked = form.querySelector('input[type="radio"]:checked');
                    const checkboxChecked = form.querySelector('input[type="checkbox"]:checked');
                    
                    // Allow submission if there's a search term OR filters are selected
                    if (!searchValue && !radioChecked && !checkboxChecked) {
                        e.preventDefault();
                        alert('Silakan masukkan kata kunci pencarian atau pilih minimal satu filter.');
                        return false;
                    }
                    
                    // Add loading state
                    const submitBtn = form.querySelector('button[type="submit"]');
                    if (submitBtn) {
                        const originalContent = submitBtn.innerHTML;
                        submitBtn.classList.add('search-loading');
                        submitBtn.disabled = true;

                        // Re-enable after 5 seconds (fallback)
                        setTimeout(() => {
                            submitBtn.innerHTML = originalContent;
                            submitBtn.classList.remove('search-loading');
                            submitBtn.disabled = false;
                        }, 5000);
                    }
                });
            });

            // Initialize on page load
            updateSelectedFilters();
            updateSearchPlaceholder();

            // Initialize pill button states based on current selections
            document.querySelectorAll('input[type="radio"]:checked, input[type="checkbox"]:checked').forEach(input => {
                const span = input.nextElementSibling;
                if (span) {
                    span.classList.add('selected');
                }
            });

            // Enhanced browser back button handling
            window.addEventListener('popstate', function(event) {
                // Small delay to ensure proper state synchronization
                setTimeout(() => {
                    window.location.reload();
                }, 100);
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
        });

        // Modal functionality
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
            document.getElementById('modalCafeCapacity').textContent = cafeData.kapasitasruang?.kapasitas_ruang || 'Tidak diketahui';
            document.getElementById('modalCafeParking').textContent = cafeData.tempatparkir?.tempat_parkir || 'Tidak diketahui';

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
            if (cafeModal) {
                cafeModal.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
                document.removeEventListener('click', handleClickOutside);
            }
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
            if (event.key === 'Escape' && cafeModal && !cafeModal.classList.contains('hidden')) {
                closeCafeModal();
            }
        });

        // Add click event to all cafe cards
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.cafe-card').forEach(card => {
                card.addEventListener('click', function(event) {
                    event.stopPropagation();

                    try {
                        const cafeData = JSON.parse(this.dataset.cafe);
                        console.log('Cafe Data:', cafeData);
                        openCafeModal(cafeData);
                    } catch (e) {
                        console.error('Error parsing cafe data:', e);
                    }
                });
            });
        });

        // Carousel functionality
        document.addEventListener('DOMContentLoaded', function() {
            const carousel = document.getElementById('cafeCarousel');
            if (!carousel) return;

            const autoPlayToggle = document.getElementById('autoPlayToggle');
            const autoPlayText = document.getElementById('autoPlayText');
            const indicators = document.querySelectorAll('.indicator-dot');

            let currentIndex = 0;
            let isAutoPlaying = true;
            let autoPlayInterval = null;
            let totalItems = carousel.children.length;

            function getItemsToShow() {
                const containerWidth = carousel.parentElement.offsetWidth;
                const itemWidth = 300; // approximate item width including gap
                return Math.floor(containerWidth / itemWidth) || 1;
            }

            function updateCarousel() {
                const itemWidth = carousel.children[0].offsetWidth + 24; // item width + gap
                const translateX = -(currentIndex * itemWidth);
                carousel.style.transform = `translateX(${translateX}px)`;

                indicators.forEach((indicator, index) => {
                    if (index === currentIndex) {
                        indicator.classList.remove('bg-gray-300');
                        indicator.style.backgroundColor = '#7C6A46';
                    } else {
                        indicator.classList.remove('bg-amber-600');
                        indicator.style.backgroundColor = '#d1d5db';
                    }
                });
            }

            function nextSlide() {
                const itemsToShow = getItemsToShow();
                const maxIndex = Math.max(0, totalItems - itemsToShow);
                currentIndex = currentIndex >= maxIndex ? 0 : currentIndex + 1;
                updateCarousel();
            }

            function goToSlide(index) {
                currentIndex = index;
                updateCarousel();
                pauseAutoPlay();
                setTimeout(() => {
                    if (!isAutoPlaying) {
                        startAutoPlay();
                    }
                }, 5000);
            }

            function startAutoPlay() {
                if (totalItems <= 1) return;
                isAutoPlaying = true;
                if (autoPlayText) autoPlayText.textContent = '';
                if (autoPlayInterval) clearInterval(autoPlayInterval); // clear previous interval
                autoPlayInterval = setInterval(nextSlide, 3000); // 3000ms = 3s
            }

            function pauseAutoPlay() {
                isAutoPlaying = false;
                if (autoPlayText) autoPlayText.textContent = '';
                if (autoPlayInterval) {
                    clearInterval(autoPlayInterval);
                    autoPlayInterval = null;
                }
            }

            function toggleAutoPlay() {
                if (isAutoPlaying) {
                    pauseAutoPlay();
                } else {
                    startAutoPlay();
                }
            }

            if (autoPlayToggle) {
                autoPlayToggle.addEventListener('click', toggleAutoPlay);
            }

            indicators.forEach((indicator, index) => {
                indicator.addEventListener('click', () => goToSlide(index));
            });

            carousel.addEventListener('mouseenter', () => {
                if (isAutoPlaying && autoPlayInterval) {
                    clearInterval(autoPlayInterval);
                    autoPlayInterval = null;
                }
            });

            carousel.addEventListener('mouseleave', () => {
                if (isAutoPlaying && !autoPlayInterval) {
                    autoPlayInterval = setInterval(nextSlide, 3000);
                }
            });

            window.addEventListener('resize', updateCarousel);

            if (totalItems > 1) {
                startAutoPlay();
            }

            updateCarousel();
        });
    </script>
    @stack('scripts')
</body>

</html>