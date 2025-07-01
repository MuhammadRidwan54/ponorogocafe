<!-- Sidebar -->
<div id="sidebar"
    class="bg-white border-r border-gray-200 w-64 min-h-screen p-4 shadow-sm fixed lg:relative transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out z-40">
    <!-- Close button for mobile -->
    <div class="lg:hidden flex justify-end mb-4">
        <button id="closeSidebarBtn" class="text-gray-400 hover:text-gray-600">
            <i class="fas fa-times text-xl"></i>
        </button>
    </div>

    <!-- Sidebar Header -->
    <div class="border-b border-gray-100 pb-6 mb-6">
        <h1 class="text-xl font-bold text-gray-900">ponorogocafe.id</h1>
        <p class="text-sm text-gray-500 mt-1">Dashboard Admin</p>
    </div>

    <!-- Navigation Menu -->
    <nav class="space-y-1">
        <a href="{{ route('dashboard') }}"
            class="flex items-center space-x-3 px-3 py-3 rounded-lg text-sm font-medium transition-all duration-200
            {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-700' : 'text-gray-700 hover:bg-gray-50 hover:text-gray-900' }}">
            <i class="fas fa-home w-4 h-4"></i>
            <span>Dashboard</span>
        </a>

        <a href="{{ route('fasilitas.index') }}"
            class="flex items-center space-x-3 px-3 py-3 rounded-lg text-sm font-medium transition-all duration-200
            {{ request()->routeIs('fasilitas.*') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-700' : 'text-gray-700 hover:bg-gray-50 hover:text-gray-900' }}">
            <i class="fas fa-building w-4 h-4"></i>
            <span>Fasilitas</span>
        </a>

        <a href="{{ route('harga_menu.index') }}"
            class="flex items-center space-x-3 px-3 py-3 rounded-lg text-sm font-medium transition-all duration-200
            {{ request()->routeIs('harga_menu.*') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-700' : 'text-gray-700 hover:bg-gray-50 hover:text-gray-900' }}">
            <i class="fas fa-utensils w-4 h-4"></i>
            <span>Harga Menu</span>
        </a>

        <a href="{{ route('kapasitas_ruang.index') }}"
            class="flex items-center space-x-3 px-3 py-3 rounded-lg text-sm font-medium transition-all duration-200
            {{ request()->routeIs('kapasitas_ruang.*') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-700' : 'text-gray-700 hover:bg-gray-50 hover:text-gray-900' }}">
            <i class="fas fa-users w-4 h-4"></i>
            <span>Kapasitas Ruang</span>
        </a>

        <a href="{{ route('tempat_parkir.index') }}"
            class="flex items-center space-x-3 px-3 py-3 rounded-lg text-sm font-medium transition-all duration-200
            {{ request()->routeIs('tempat_parkir.*') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-700' : 'text-gray-700 hover:bg-gray-50 hover:text-gray-900' }}">
            <i class="fas fa-car w-4 h-4"></i>
            <span>Tempat Parkir</span>
        </a>

        <a href="{{ route('jam_buka.index') }}"
            class="flex items-center space-x-3 px-3 py-3 rounded-lg text-sm font-medium transition-all duration-200
            {{ request()->routeIs('jam_buka.*') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-700' : 'text-gray-700 hover:bg-gray-50 hover:text-gray-900' }}">
            <i class="fas fa-clock w-4 h-4"></i>
            <span>Jam Buka</span>
        </a>

        <a href="{{ route('label.index') }}"
            class="flex items-center space-x-3 px-3 py-3 rounded-lg text-sm font-medium transition-all duration-200
            {{ request()->routeIs('label.*') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-700' : 'text-gray-700 hover:bg-gray-50 hover:text-gray-900' }}">
            <i class="fas fa-tag w-4 h-4"></i>
            <span>Label</span>
        </a>

        <!-- Separator -->
        <div class="border-t border-gray-200 my-4"></div>

        <a href="{{ route('cafe.index') }}"
            class="flex items-center space-x-3 px-3 py-3 rounded-lg text-sm font-medium transition-all duration-200
            {{ request()->routeIs('cafe.*') ? 'bg-blue-50 text-blue-700 border-r-2 border-blue-700' : 'text-gray-700 hover:bg-gray-50 hover:text-gray-900' }}">
            <i class="fas fa-coffee w-4 h-4"></i>
            <span>Menu Cafe</span>
        </a>
    </nav>
</div>

<!-- Overlay for mobile -->
<div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 z-30 lg:hidden hidden"></div>