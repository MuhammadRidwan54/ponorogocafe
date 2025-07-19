@extends('layouts.app')

@section('title', 'Dashboard Admin - PonorogoCafe')
@section('header-title', 'Dashboard Utama')
@section('header-description', 'Selamat datang di panel admin PonorogoCafe')

@section('content')
<style>
    /* Animation Styles */
    .animate-fade-in {
        opacity: 0;
        animation: fadeIn 0.6s ease-out forwards;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    
    .animate-slide-up {
        opacity: 0;
        transform: translateY(20px);
        animation: slideUp 0.6s ease-out forwards;
    }
    
    @keyframes slideUp {
        from { 
            opacity: 0;
            transform: translateY(20px);
        }
        to { 
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .animate-card-pop {
        opacity: 0;
        transform: scale(0.95);
        animation: cardPop 0.5s ease-out forwards;
    }
    
    @keyframes cardPop {
        from { 
            opacity: 0;
            transform: scale(0.95);
        }
        to { 
            opacity: 1;
            transform: scale(1);
        }
    }
    
    /* Staggered Animations */
    .welcome-card {
        animation-delay: 0.1s;
    }
    
    .stat-card:nth-child(1) { animation-delay: 0.2s; }
    .stat-card:nth-child(2) { animation-delay: 0.3s; }
    .stat-card:nth-child(3) { animation-delay: 0.4s; }
    .stat-card:nth-child(4) { animation-delay: 0.5s; }
    
    .quick-action:nth-child(1) { animation-delay: 0.3s; }
    .quick-action:nth-child(2) { animation-delay: 0.4s; }
    .quick-action:nth-child(3) { animation-delay: 0.5s; }
    .quick-action:nth-child(4) { animation-delay: 0.6s; }
    
    .activity-item {
        animation: fadeInSlideUp 0.5s ease-out forwards;
        opacity: 0;
        transform: translateY(10px);
    }
    
    @keyframes fadeInSlideUp {
        from { 
            opacity: 0;
            transform: translateY(10px);
        }
        to { 
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    /* Hover Effects */
    .quick-action {
        transition: all 0.3s ease;
    }
    
    .quick-action:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }
    
    .stat-card {
        transition: all 0.3s ease;
    }
    
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }
    
    /* Icon Animation */
    .icon-wrapper {
        transition: all 0.3s ease;
    }
    
    .quick-action:hover .icon-wrapper {
        transform: scale(1.1);
    }
    
    /* Custom Colors */
    .bg-cafe-primary {
        background-color: #996207;
    }
    
    .border-cafe-primary {
        border-color: #996207;
    }
    
    .text-cafe-primary {
        color: #996207;
    }
    
    .hover\:bg-cafe-primary:hover {
        background-color: #7a4e05;
    }
</style>

<div class="space-y-6">
    <!-- Welcome Card -->
    <div class="bg-gradient-to-r from-yellow-700 to-yellow-600 p-8 rounded-xl shadow-lg text-white animate-slide-up welcome-card">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-3xl font-bold mb-2">Selamat Datang, {{ $user->name }}</h1>
                <p class="text-yellow-100 text-lg">Sistem Manajemen Cafe Ponorogo</p>
            </div>
            <div class="mt-4 md:mt-0">
                <div class="bg-white/10 backdrop-blur-sm p-4 rounded-lg inline-block">
                    <p class="text-sm font-medium">Hari ini: {{ now()->translatedFormat('l, d F Y') }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Cafe -->
        <div class="bg-white p-6 rounded-xl shadow-md border-l-4 border-blue-500 animate-card-pop stat-card">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Total Cafe</p>
                    <h3 class="text-2xl font-bold text-gray-800">{{ $cafe_count ?? 15 }}</h3>
                </div>
                <div class="bg-blue-100 p-3 rounded-full icon-wrapper">
                    <i class="fas fa-coffee text-blue-500 text-xl"></i>
                </div>
            </div>
            <a href="{{ route('cafe.index') }}" class="mt-4 inline-block text-sm font-medium text-blue-500 hover:text-blue-700 transition-colors duration-300">
                Lihat detail →
            </a>
        </div>

        <!-- Fasilitas -->
        <div class="bg-white p-6 rounded-xl shadow-md border-l-4 border-green-500 animate-card-pop stat-card">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Fasilitas</p>
                    <h3 class="text-2xl font-bold text-gray-800">{{ $fasilitas_count ?? 12 }}</h3>
                </div>
                <div class="bg-green-100 p-3 rounded-full icon-wrapper">
                    <i class="fas fa-building text-green-500 text-xl"></i>
                </div>
            </div>
            <a href="{{ route('fasilitas.index') }}" class="mt-4 inline-block text-sm font-medium text-green-500 hover:text-green-700 transition-colors duration-300">
                Lihat detail →
            </a>
        </div>

        <!-- Menu Items -->
        <div class="bg-white p-6 rounded-xl shadow-md border-l-4 border-red-500 animate-card-pop stat-card">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Menu Items</p>
                    <h3 class="text-2xl font-bold text-gray-800">{{ $harga_menu_count ?? 8 }}</h3>
                </div>
                <div class="bg-red-100 p-3 rounded-full icon-wrapper">
                    <i class="fas fa-utensils text-red-500 text-xl"></i>
                </div>
            </div>
            <a href="{{ route('harga_menu.index') }}" class="mt-4 inline-block text-sm font-medium text-red-500 hover:text-red-700 transition-colors duration-300">
                Lihat detail →
            </a>
        </div>

        <!-- Total Kapasitas -->
        <div class="bg-white p-6 rounded-xl shadow-md border-l-4 border-teal-500 animate-card-pop stat-card">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium">Total Kapasitas</p>
                    <h3 class="text-2xl font-bold text-gray-800">250</h3>
                </div>
                <div class="bg-teal-100 p-3 rounded-full icon-wrapper">
                    <i class="fas fa-users text-teal-500 text-xl"></i>
                </div>
            </div>
            <a href="#" class="mt-4 inline-block text-sm font-medium text-teal-500 hover:text-teal-700 transition-colors duration-300">
                Lihat detail →
            </a>
        </div>
    </div>

    <!-- Quick Actions Section -->
    <div class="bg-white p-8 rounded-xl shadow-md animate-fade-in">
        <h3 class="text-2xl font-semibold text-gray-800 mb-6">Menu Cepat</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-4">
            <!-- Tambah Cafe Baru -->
            <a href="{{ route('cafe.index') }}" class="group flex items-center p-4 rounded-lg transition-all duration-300 hover:shadow-lg hover:bg-blue-50 hover:border-blue-200 border border-transparent quick-action animate-card-pop">
                <div class="bg-blue-100 p-3 rounded-full mr-4 group-hover:bg-blue-200 transition-colors duration-300 icon-wrapper">
                    <i class="fas fa-plus text-blue-500 text-xl"></i>
                </div>
                <div>
                    <h4 class="font-semibold text-gray-800">Tambah Cafe Baru</h4>
                    <p class="text-sm text-gray-500">Daftarkan cafe baru ke sistem</p>
                </div>
            </a>

            <!-- Kelola Fasilitas -->
            <a href="{{ route('fasilitas.index') }}" class="group flex items-center p-4 rounded-lg transition-all duration-300 hover:shadow-lg hover:bg-green-50 hover:border-green-200 border border-transparent quick-action animate-card-pop">
                <div class="bg-green-100 p-3 rounded-full mr-4 group-hover:bg-green-200 transition-colors duration-300 icon-wrapper">
                    <i class="fas fa-building text-green-500 text-xl"></i>
                </div>
                <div>
                    <h4 class="font-semibold text-gray-800">Kelola Fasilitas</h4>
                    <p class="text-sm text-gray-500">Update fasilitas yang tersedia</p>
                </div>
            </a>

            <!-- Update Menu -->
            <a href="{{ route('harga_menu.index') }}" class="group flex items-center p-4 rounded-lg transition-all duration-300 hover:shadow-lg hover:bg-red-50 hover:border-red-200 border border-transparent quick-action animate-card-pop">
                <div class="bg-red-100 p-3 rounded-full mr-4 group-hover:bg-red-200 transition-colors duration-300 icon-wrapper">
                    <i class="fas fa-utensils text-red-500 text-xl"></i>
                </div>
                <div>
                    <h4 class="font-semibold text-gray-800">Update Menu</h4>
                    <p class="text-sm text-gray-500">Perbarui harga dan menu</p>
                </div>
            </a>

            <!-- Analisis Data -->
            <a href="#" class="group flex items-center p-4 rounded-lg transition-all duration-300 hover:shadow-lg hover:bg-purple-50 hover:border-purple-200 border border-transparent quick-action animate-card-pop">
                <div class="bg-purple-100 p-3 rounded-full mr-4 group-hover:bg-purple-200 transition-colors duration-300 icon-wrapper">
                    <i class="fas fa-chart-line text-purple-500 text-xl"></i>
                </div>
                <div>
                    <h4 class="font-semibold text-gray-800">Analisis Data</h4>
                    <p class="text-sm text-gray-500">Lihat laporan dan statistik</p>
                </div>
            </a>
        </div>
    </div>

    <!-- System Info Section -->
    <div class="bg-white p-8 rounded-xl shadow-md animate-fade-in">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-2xl font-semibold text-gray-800">Info Sistem</h3>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="p-4 bg-gray-50 rounded-lg">
                <p class="text-sm text-gray-500 font-medium">Total Data</p>
                <p class="text-xl font-bold text-gray-800">{{ $total_data ?? 47 }}</p>
            </div>
            <div class="p-4 bg-gray-50 rounded-lg">
                <p class="text-sm text-gray-500 font-medium">Data Master</p>
                <p class="text-xl font-bold text-gray-800">{{ $total_master ?? 32 }}</p>
            </div>
            <div class="p-4 bg-gray-50 rounded-lg">
                <p class="text-sm text-gray-500 font-medium">Status</p>
                <div class="flex items-center mt-1">
                    <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                    <span class="text-sm font-medium text-gray-800">Online</span>
                </div>
            </div>
            <div class="p-4 bg-gray-50 rounded-lg">
                <p class="text-sm text-gray-500 font-medium">Update Terakhir</p>
                <p class="text-sm font-medium text-gray-800">{{ now()->diffForHumans() }}</p>
            </div>
        </div>
    </div>

    <!-- Recent Activity Section -->
    <div class="bg-white p-8 rounded-xl shadow-md animate-fade-in">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-2xl font-semibold text-gray-800">Aktivitas Terbaru</h3>
            <a href="#" class="text-sm font-medium text-cafe-primary hover:text-yellow-700 transition-colors duration-300">
                Lihat Semua
            </a>
        </div>
        <div class="space-y-4">
            <div class="flex items-start pb-4 border-b border-gray-100 last:border-0 last:pb-0 activity-item" 
                 style="animation-delay: 0.1s">
                <div class="bg-green-100 p-2 rounded-full mr-4 icon-wrapper">
                    <i class="fas fa-plus text-green-500 text-sm"></i>
                </div>
                <div class="flex-1">
                    <p class="text-gray-800">Cafe "Warung Kopi Santai" ditambahkan</p>
                    <p class="text-xs text-gray-500 mt-1">2 menit yang lalu</p>
                </div>
            </div>

            <div class="flex items-start pb-4 border-b border-gray-100 last:border-0 last:pb-0 activity-item" 
                 style="animation-delay: 0.2s">
                <div class="bg-blue-100 p-2 rounded-full mr-4 icon-wrapper">
                    <i class="fas fa-edit text-blue-500 text-sm"></i>
                </div>
                <div class="flex-1">
                    <p class="text-gray-800">Fasilitas "WiFi Gratis" diperbarui</p>
                    <p class="text-xs text-gray-500 mt-1">15 menit yang lalu</p>
                </div>
            </div>

            <div class="flex items-start pb-4 border-b border-gray-100 last:border-0 last:pb-0 activity-item" 
                 style="animation-delay: 0.3s">
                <div class="bg-orange-100 p-2 rounded-full mr-4 icon-wrapper">
                    <i class="fas fa-utensils text-orange-500 text-sm"></i>
                </div>
                <div class="flex-1">
                    <p class="text-gray-800">Menu "Kopi Americano" harga diubah</p>
                    <p class="text-xs text-gray-500 mt-1">30 menit yang lalu</p>
                </div>
            </div>

            <div class="flex items-start pb-4 border-b border-gray-100 last:border-0 last:pb-0 activity-item" 
                 style="animation-delay: 0.4s">
                <div class="bg-purple-100 p-2 rounded-full mr-4 icon-wrapper">
                    <i class="fas fa-clock text-purple-500 text-sm"></i>
                </div>
                <div class="flex-1">
                    <p class="text-gray-800">Jam buka "24 Jam" ditambahkan</p>
                    <p class="text-xs text-gray-500 mt-1">1 jam yang lalu</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Add intersection observer for scroll animations
    document.addEventListener('DOMContentLoaded', function() {
        const animateElements = document.querySelectorAll('.animate-card-pop, .animate-slide-up, .activity-item');
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.animationPlayState = 'running';
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });
        
        animateElements.forEach(el => {
            observer.observe(el);
            // Pause animations initially
            el.style.animationPlayState = 'paused';
        });
    });
</script>
@endsection