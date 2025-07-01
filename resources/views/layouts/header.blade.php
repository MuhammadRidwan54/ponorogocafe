<header class="bg-white shadow-sm border-b border-gray-200 px-4 py-4 lg:px-6 lg:py-6">
    <div class="flex items-center justify-between">
        <!-- Mobile menu button -->
        <button id="sidebarToggle" class="lg:hidden text-gray-600 hover:text-gray-900 mr-4">
            <i class="fas fa-bars text-xl"></i>
        </button>

        <!-- Title Section -->
        <div class="flex-1 min-w-0">
            <h2 class="text-lg lg:text-2xl font-bold text-gray-900 truncate">
                @yield('header-title', 'Dashboard Utama')
            </h2>
            <p class="text-gray-600 mt-1 text-sm lg:text-base hidden sm:block">
                @yield('header-description', 'Selamat datang di panel admin PonorogoCafe')
            </p>
        </div>

        <!-- User Dropdown -->
        <div class="flex items-center ml-4">
            <div class="relative">
                <button id="userDropdownButton" 
                    class="flex items-center space-x-2 p-2 hover:bg-gray-50 focus:bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 rounded-lg transition-colors">
                    <!-- User Avatar -->
                    <div class="h-8 w-8 bg-blue-600 rounded-full flex items-center justify-center">
                        <span class="text-white text-sm font-medium">
                            {{ substr(Auth::user()->name ?? 'Admin', 0, 1) }}
                        </span>
                    </div>
                    <!-- User Info (hidden on mobile) -->
                    <div class="hidden sm:flex flex-col items-start">
                        <span class="text-sm font-medium text-gray-900">{{ Auth::user()->name ?? 'Admin' }}</span>
                        <span class="text-xs text-gray-500">Administrator</span>
                    </div>
                    <!-- Dropdown Arrow -->
                    <i class="fas fa-chevron-down text-gray-500 text-sm"></i>
                </button>

                <!-- Dropdown Menu -->
                <div id="userDropdown" 
                    class="hidden absolute right-0 mt-2 w-56 bg-white border border-gray-200 rounded-lg shadow-lg py-1 z-50">
                    <!-- User Info Header -->
                    <div class="px-3 py-2 border-b border-gray-100">
                        <p class="text-sm font-medium text-gray-900">{{ Auth::user()->name ?? 'Admin' }}</p>
                        <p class="text-xs text-gray-500">Administrator</p>
                    </div>

                    <!-- Profile Link -->
                    <a href="#" class="flex items-center space-x-2 px-3 py-2 text-sm text-gray-700 hover:bg-gray-50">
                        <i class="fas fa-user w-4 h-4"></i>
                        <span>Profil Saya</span>
                    </a>

                    <!-- Separator -->
                    <div class="border-t border-gray-100 my-1"></div>

                    <!-- Logout -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" 
                            class="flex items-center space-x-2 w-full px-3 py-2 text-sm text-red-600 hover:bg-red-50 text-left">
                            <i class="fas fa-sign-out-alt w-4 h-4"></i>
                            <span>Keluar</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>

<script>
    // // Dropdown functionality
    // const dropdownButton = document.getElementById('userDropdownButton');
    // const dropdownMenu = document.getElementById('userDropdown');
    
    // dropdownButton.addEventListener('click', function() {
    //     dropdownMenu.classList.toggle('hidden');
    // });
    
    // // Close dropdown when clicking outside
    // document.addEventListener('click', function(event) {
    //     if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
    //         dropdownMenu.classList.add('hidden');
    //     }
    // });

    // Toggle user dropdown
    document.getElementById('userDropdownButton').addEventListener('click', function() {
        const dropdown = document.getElementById('userDropdown');
        dropdown.classList.toggle('hidden');
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        const button = document.getElementById('userDropdownButton');
        const dropdown = document.getElementById('userDropdown');
        
        if (!button.contains(event.target) && !dropdown.contains(event.target)) {
            dropdown.classList.add('hidden');
        }
    });

    // Toggle sidebar for mobile
    document.getElementById('sidebarToggle')?.addEventListener('click', function() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        
        sidebar.classList.toggle('-translate-x-full');
        overlay.classList.toggle('hidden');
    });

    // Close sidebar
    document.getElementById('closeSidebarBtn')?.addEventListener('click', function() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
    });

    // Close sidebar when clicking overlay
    document.getElementById('overlay')?.addEventListener('click', function() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
    });
</script>