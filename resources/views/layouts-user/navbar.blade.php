<!-- Navbar with custom color #7C6A46 -->
<nav id="mainNav" class="navbar-custom shadow-lg h-20 sticky top-0 z-50 transition-all duration-300 ease-in-out" style="background-color: #7C6A46;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full">
        <div class="flex justify-between items-center h-full">
            <!-- Logo -->
            <div class="flex-shrink-0 transition-all duration-300">
                <a href="{{ url('/') }}" class="flex items-center group">
                    <span class="text-2xl md:text-3xl font-bold text-white transition-all duration-300 group-hover:text-gray-200">
                        ponorogocafe.id
                    </span>
                    <!-- Heroicon: arrow-up-right -->
                    <svg class="w-6 h-6 ml-2 text-white transform transition-all duration-300 group-hover:scale-110 group-hover:-translate-y-1 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 17L17 7M17 7H7m10 0v10"></path>
                    </svg>
                </a>
            </div>

            <!-- Login/Admin Button -->
            <div class="flex items-center space-x-4">
                <!-- Mobile menu button -->
                <button class="md:hidden text-white hover:text-gray-200 transition-colors duration-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
                
                <!-- Admin/Login Button -->
                <button class="navbar-button bg-white text-white font-semibold py-2 px-6 rounded-full text-sm transition-all duration-300 hover:scale-105 transform shadow-md hover:shadow-lg" style="background-color: white; color: #7C6A46;">
                    <span>Admin</span>
                </button>
            </div>
        </div>
    </div>
</nav>

<script>
    // // Mobile menu toggle
    // document.getElementById('mobile-menu-button').addEventListener('click', function() {
    //     const menu = document.getElementById('mobile-menu');
    //     const isHidden = menu.classList.contains('hidden');
        
    //     // Toggle menu visibility
    //     menu.classList.toggle('hidden');
        
    //     // Toggle button icons
    //     const svgs = this.querySelectorAll('svg');
    //     svgs.forEach(svg => svg.classList.toggle('hidden'));
    //     svgs.forEach(svg => svg.classList.toggle('block'));
    // });

    // Add scroll effect to navbar
    window.addEventListener('scroll', function() {
        const nav = document.getElementById('mainNav');
        if (window.scrollY > 10) {
            nav.classList.add('shadow-lg');
            nav.classList.add('h-16');
            nav.querySelector('span').classList.add('text-2xl');
        } else {
            nav.classList.remove('shadow-lg');
            nav.classList.remove('h-16');
            nav.querySelector('span').classList.remove('text-2xl');
        }
    });
</script>