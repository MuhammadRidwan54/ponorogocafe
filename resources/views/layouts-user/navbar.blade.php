<!-- Modern Mobile-First Navbar -->
<nav id="mainNav" class="bg-[#7C6A46] shadow-lg h-14 md:h-16 sticky top-0 z-50 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-6 h-full">
        <div class="flex justify-between items-center h-full">
            <!-- Logo -->
            <div class="flex-shrink-0">
                <a href="{{ url('/') }}" class="flex items-center group">
                    <span class="text-base md:text-xl font-bold text-white transition-all duration-300 group-hover:text-gray-200">
                        ponorogocafe.id
                    </span>
                    <svg class="w-3 h-3 md:w-4 md:h-4 text-white transform transition-all duration-300 group-hover:scale-110 group-hover:-translate-y-1 group-hover:translate-x-1 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 17L17 7M17 7H7m10 0v10"></path>
                    </svg>
                </a>
            </div>

            {{-- <!-- Admin Button -->
            <div class="flex items-center">
                <button class="bg-white text-[#7C6A46] font-semibold py-2 px-4 md:px-6 rounded-full text-sm transition-all duration-300 hover:scale-105 shadow-md hover:shadow-lg">
                    <span>Admin</span>
                </button>
            </div> --}}
        </div>
    </div>
</nav>

<script>
// Enhanced navbar scroll effect
window.addEventListener('scroll', function() {
    const nav = document.getElementById('mainNav');
    if (window.scrollY > 10) {
        nav.classList.add('shadow-xl');
        nav.classList.remove('h-14', 'md:h-16');
        nav.classList.add('h-12', 'md:h-14');
    } else {
        nav.classList.remove('shadow-xl', 'h-12', 'md:h-14');
        nav.classList.add('h-14', 'md:h-16');
    }
});
</script>
