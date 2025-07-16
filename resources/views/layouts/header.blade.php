<header class="bg-white border-b border-gray-100 px-4 py-4 lg:px-6 lg:py-5 shadow-sm">
    <div class="flex items-center justify-between">
        <!-- Mobile menu button -->
        <button id="sidebarToggle" class="lg:hidden p-2 rounded-lg text-gray-500 hover:text-gray-700 hover:bg-gray-50 transition-colors duration-200 mr-3">
            <i class="fas fa-bars text-lg"></i>
        </button>
        
        <!-- Title Section -->
        <div class="flex-1 min-w-0">
            <h2 class="text-xl lg:text-2xl font-bold text-gray-900 truncate tracking-tight">
                @yield('header-title', 'Dashboard Utama')
            </h2>
            <p class="text-gray-500 mt-0.5 text-sm lg:text-base hidden sm:block font-medium">
                @yield('header-description', 'Selamat datang di panel admin PonorogoCafe')
            </p>
        </div>
        
        <!-- User Dropdown -->
        <div class="flex items-center ml-4">
            <div class="relative">
                <button id="userDropdownButton"
                     class="flex items-center space-x-3 p-2 hover:bg-gray-50 focus:bg-gray-50 focus:ring-2 focus:ring-gray-200 focus:ring-offset-1 rounded-xl transition-all duration-200 group">
                    <!-- User Avatar -->
                    <div class="h-9 w-9 rounded-xl flex items-center justify-center bg-cover bg-center text-white text-sm font-semibold shadow-sm border border-gray-100"
                        style="background-image: url('{{ asset('logo_pocaf.png') }}'); background-size: cover;">
                        {{-- Fallback jika gambar tidak ada --}}
                        @if(!file_exists(public_path('logo_pocaf.png')))
                            <div class="h-9 w-9 rounded-xl bg-gray-900 flex items-center justify-center text-white text-sm font-semibold">
                                {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                            </div>
                        @endif
                    </div>
                    
                    <!-- User Info (hidden on mobile) -->
                    <div class="hidden sm:flex flex-col items-start">
                        <span class="text-sm font-semibold text-gray-900">{{ Auth::user()->name ?? 'Admin' }}</span>
                        <span class="text-xs text-gray-500 font-medium">Administrator</span>
                    </div>
                    
                    <!-- Dropdown Arrow -->
                    <i class="fas fa-chevron-down text-gray-400 text-xs group-hover:text-gray-600 transition-colors duration-200"></i>
                </button>
                
                <!-- Dropdown Menu -->
                <div id="userDropdown"
                     class="hidden absolute right-0 mt-2 w-56 bg-white border border-gray-100 rounded-xl shadow-lg py-2 z-50 overflow-hidden">
                    <!-- User Info Header -->
                    <div class="px-4 py-3 border-b border-gray-50">
                        <p class="text-sm font-semibold text-gray-900">{{ Auth::user()->name ?? 'Admin' }}</p>
                        <p class="text-xs text-gray-500 font-medium mt-0.5">Administrator</p>
                    </div>
                    
                    <!-- Profile Link -->
                    <a href="#" class="flex items-center space-x-3 px-4 py-2.5 text-sm text-gray-600 hover:bg-gray-50 hover:text-gray-900 transition-colors duration-200 group">
                        <i class="fas fa-user text-sm text-gray-400 group-hover:text-gray-600"></i>
                        <span class="font-medium">Profil Saya</span>
                    </a>
                    
                    <!-- Settings Link -->
                    <a href="#" class="flex items-center space-x-3 px-4 py-2.5 text-sm text-gray-600 hover:bg-gray-50 hover:text-gray-900 transition-colors duration-200 group">
                        <i class="fas fa-cog text-sm text-gray-400 group-hover:text-gray-600"></i>
                        <span class="font-medium">Pengaturan</span>
                    </a>
                    
                    <!-- Separator -->
                    <div class="border-t border-gray-50 my-2"></div>
                    
                    <!-- Logout -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                             class="flex items-center space-x-3 w-full px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 hover:text-red-700 text-left transition-colors duration-200 group">
                            <i class="fas fa-sign-out-alt text-sm text-red-500 group-hover:text-red-600"></i>
                            <span class="font-medium">Keluar</span>
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