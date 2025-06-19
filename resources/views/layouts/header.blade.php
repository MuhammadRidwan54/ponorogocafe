<header class="bg-white shadow-sm border-b border-gray-200 p-4 lg:p-6 ml-0 lg:ml-0">
    <div class="flex items-center justify-between">
        <div class="ml-12 lg:ml-0">
            <h2 class="text-lg lg:text-2xl font-bold text-gray-800">@yield('header-title', 'Dashboard Utama')</h2>
            <p class="text-gray-600 mt-1 text-sm lg:text-base hidden sm:block">@yield('header-description', 'Selamat datang di panel admin PonorogoCafe')</p>
        </div>
        
        <!-- User Dropdown -->
        <div class="relative">
            <button id="userDropdownButton" class="flex items-center space-x-1 focus:outline-none">
                <span class="bg-brown-600 text-white px-3 py-1 rounded-lg font-medium text-sm lg:text-base">
                    {{ Auth::user()->name ?? 'Admin' }}
                </span>
                <svg class="w-4 h-4 text-brown-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
            
            <!-- Dropdown Menu -->
            <div id="userDropdown" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-brown-50">
                        Keluar
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>

<script>
    // Dropdown functionality
    const dropdownButton = document.getElementById('userDropdownButton');
    const dropdownMenu = document.getElementById('userDropdown');
    
    dropdownButton.addEventListener('click', function() {
        dropdownMenu.classList.toggle('hidden');
    });
    
    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
            dropdownMenu.classList.add('hidden');
        }
    });
</script>