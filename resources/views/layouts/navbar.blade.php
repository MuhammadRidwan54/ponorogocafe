<!-- Sidebar -->
<div id="sidebar" class="bg-brown-800 text-white w-64 min-h-screen p-4 shadow-xl fixed lg:relative transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out z-40">
    <!-- Close button for mobile -->
    <div class="lg:hidden flex justify-end mb-4">
        <button id="closeSidebarBtn" class="text-brown-200 hover:text-white">
            <i class="fas fa-times text-xl"></i>
        </button>
    </div>
    
    <div class="mb-8">
        <h1 class="text-xl lg:text-2xl font-bold text-brown-100">ponorogocafe.id</h1>
        <p class="text-brown-300 text-xs lg:text-sm mt-1">Dashboard Admin</p>
    </div>
    
    <nav class="space-y-2">
       <a href="{{ route('dashboard') }}"
   class="flex items-center space-x-3 p-3 rounded-lg 
   {{ request()->routeIs('dashboard') ? 'bg-brown-700 text-white shadow-md' : 'text-brown-200 hover:bg-brown-700 hover:text-white transition-all duration-200' }}">
    <i class="fas fa-home"></i>
    <span class="font-medium text-sm lg:text-base">Dashboard</span>
</a>

<a href="{{ route('fasilitas.index') }}"
   class="flex items-center space-x-3 p-3 rounded-lg 
   {{ request()->routeIs('fasilitas.*') ? 'bg-brown-700 text-white shadow-md' : 'text-brown-200 hover:bg-brown-700 hover:text-white transition-all duration-200' }}">
    <i class="fas fa-building"></i>
    <span class="text-sm lg:text-base">Fasilitas</span>
</a>
         <a href="{{ route('harga_menu.index') }}"
           class="flex items-center space-x-3 p-3 rounded-lg 
           {{ request()->routeIs('harga_menu.*') ? 'bg-brown-700 text-white shadow-md' : 'text-brown-200 hover:bg-brown-700 hover:text-white transition-all duration-200' }}">
            <i class="fas fa-utensils"></i>
            <span class="text-sm lg:text-base">Harga Menu</span>
        </a>
        <a href="{{ route('kapasitas_ruang.index') }}"
           class="flex items-center space-x-3 p-3 rounded-lg 
           {{ request()->routeIs('kapasitas_ruang.*') ? 'bg-brown-700 text-white shadow-md' : 'text-brown-200 hover:bg-brown-700 hover:text-white transition-all duration-200' }}">
            <i class="fas fa-users"></i>
            <span class="text-sm lg:text-base">Kapasitas Ruang</span>
        </a>
        <a href="{{ route('tempat_parkir.index') }}"
           class="flex items-center space-x-3 p-3 rounded-lg 
           {{ request()->routeIs('tempat_parkir.*') ? 'bg-brown-700 text-white shadow-md' : 'text-brown-200 hover:bg-brown-700 hover:text-white transition-all duration-200' }}">
            <i class="fas fa-car"></i>
            <span class="text-sm lg:text-base">Tempat Parkir</span>
        </a>
           <a href="{{ route('jam_buka.index') }}"
           class="flex items-center space-x-3 p-3 rounded-lg 
           {{ request()->routeIs('jam_buka.*') ? 'bg-brown-700 text-white shadow-md' : 'text-brown-200 hover:bg-brown-700 hover:text-white transition-all duration-200' }}">
            <i class="fas fa-clock"></i>
            <span class="text-sm lg:text-base">Jam Buka</span>
        </a>
        <div class="border-t border-brown-600 my-4"></div>
       <a href="{{ route('cafe.index') }}"
           class="flex items-center space-x-3 p-3 rounded-lg 
           {{ request()->routeIs('cafe.*') ? 'bg-brown-700 text-white shadow-md' : 'text-brown-200 hover:bg-brown-700 hover:text-white transition-all duration-200' }}">
            <i class="fas fa-coffee"></i>
            <span class="text-sm lg:text-base">Menu Cafe</span>
        </a>
    </nav>
</div>

<!-- Overlay for mobile -->
<div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 z-30 lg:hidden hidden"></div>