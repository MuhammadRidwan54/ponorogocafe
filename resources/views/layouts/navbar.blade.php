<!-- Sidebar -->
<div id="sidebar"
    class="bg-white border-r border-gray-100 w-64 min-h-screen fixed lg:relative transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out z-40 shadow-lg lg:shadow-none">
    
    <!-- Close button for mobile -->
    <div class="lg:hidden flex justify-end p-4 border-b border-gray-50">
        <button id="closeSidebarBtn" class="p-2 rounded-lg text-gray-400 hover:text-gray-600 hover:bg-gray-50 transition-colors duration-200">
            <i class="fas fa-times text-lg"></i>
        </button>
    </div>
    
    <!-- Sidebar Header -->
    <div class="p-6 border-b border-gray-50">
        <div class="flex items-center space-x-3">
            <div class="w-8 h-8 bg-gray-900 rounded-lg flex items-center justify-center">
                <i class="fas fa-coffee text-white text-sm"></i>
            </div>
            <div>
                <h1 class="text-lg font-semibold text-gray-900 tracking-tight">ponorogocafe.id</h1>
                <p class="text-xs text-gray-500 font-medium">Dashboard Admin</p>
            </div>
        </div>
    </div>
    
    <!-- Navigation Menu -->
    <nav class="p-4 space-y-1">
        <a href="{{ route('dashboard') }}"
            class="group flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200
            {{ request()->routeIs('dashboard') ? 'bg-gray-900 text-white shadow-sm' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
            <i class="fas fa-home text-sm {{ request()->routeIs('dashboard') ? 'text-white' : 'text-gray-400 group-hover:text-gray-600' }}"></i>
            <span>Dashboard</span>
        </a>
        
        <a href="{{ route('fasilitas.index') }}"
            class="group flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200
            {{ request()->routeIs('fasilitas.*') ? 'bg-gray-900 text-white shadow-sm' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
            <i class="fas fa-building text-sm {{ request()->routeIs('fasilitas.*') ? 'text-white' : 'text-gray-400 group-hover:text-gray-600' }}"></i>
            <span>Fasilitas</span>
        </a>
        
        <a href="{{ route('harga_menu.index') }}"
            class="group flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200
            {{ request()->routeIs('harga_menu.*') ? 'bg-gray-900 text-white shadow-sm' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
            <i class="fas fa-utensils text-sm {{ request()->routeIs('harga_menu.*') ? 'text-white' : 'text-gray-400 group-hover:text-gray-600' }}"></i>
            <span>Harga Menu</span>
        </a>
        
        <a href="{{ route('kapasitas_ruang.index') }}"
            class="group flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200
            {{ request()->routeIs('kapasitas_ruang.*') ? 'bg-gray-900 text-white shadow-sm' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
            <i class="fas fa-users text-sm {{ request()->routeIs('kapasitas_ruang.*') ? 'text-white' : 'text-gray-400 group-hover:text-gray-600' }}"></i>
            <span>Kapasitas Ruang</span>
        </a>
        
        <a href="{{ route('tempat_parkir.index') }}"
            class="group flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200
            {{ request()->routeIs('tempat_parkir.*') ? 'bg-gray-900 text-white shadow-sm' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
            <i class="fas fa-car text-sm {{ request()->routeIs('tempat_parkir.*') ? 'text-white' : 'text-gray-400 group-hover:text-gray-600' }}"></i>
            <span>Tempat Parkir</span>
        </a>
        
        <a href="{{ route('jam_buka.index') }}"
            class="group flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200
            {{ request()->routeIs('jam_buka.*') ? 'bg-gray-900 text-white shadow-sm' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
            <i class="fas fa-clock text-sm {{ request()->routeIs('jam_buka.*') ? 'text-white' : 'text-gray-400 group-hover:text-gray-600' }}"></i>
            <span>Jam Buka</span>
        </a>
        
        <a href="{{ route('label.index') }}"
            class="group flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200
            {{ request()->routeIs('label.*') ? 'bg-gray-900 text-white shadow-sm' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
            <i class="fas fa-tag text-sm {{ request()->routeIs('label.*') ? 'text-white' : 'text-gray-400 group-hover:text-gray-600' }}"></i>
            <span>Label</span>
        </a>
        
        <!-- Separator -->
        <div class="h-px bg-gray-100 my-4 mx-3"></div>
        
        <a href="{{ route('cafe.index') }}"
            class="group flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200
            {{ request()->routeIs('cafe.*') ? 'bg-gray-900 text-white shadow-sm' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
            <i class="fas fa-coffee text-sm {{ request()->routeIs('cafe.*') ? 'text-white' : 'text-gray-400 group-hover:text-gray-600' }}"></i>
            <span>Daftar Cafe</span>
        </a>
        
        <a href="{{ route('admin.komentar.index') }}"
            class="group flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200
            {{ request()->routeIs('admin.komentar.*') ? 'bg-gray-900 text-white shadow-sm' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
            <i class="fas fa-comments text-sm {{ request()->routeIs('admin.komentar.*') ? 'text-white' : 'text-gray-400 group-hover:text-gray-600' }}"></i>
            <span>Kelola Komentar</span>
        </a>
    </nav>
</div>

<!-- Overlay for mobile -->
<div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 z-30 lg:hidden hidden"></div>