@extends('layouts.app')

@section('title', 'Dashboard Admin - PonorogoCafe')
@section('header-title', 'Dashboard Utama')
@section('header-description', 'Selamat datang di panel admin PonorogoCafe')

@section('content')
    <div class="min-h-screen bg-gray-100 flex">
        <!-- Main Content -->
        <div class="flex-1 flex flex-col min-w-0 lg:ml-0">
            <!-- Main Dashboard Content -->
            <main class="flex-1 overflow-auto space-y-6">
                
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6">
                    <!-- Total Cafe -->
                    <div class="bg-white rounded-xl border border-gray-100 p-6 hover:shadow-sm transition-all duration-200 group">
                        <div class="flex items-center justify-between">
                            <div class="p-3 rounded-xl bg-gray-50 text-gray-700 group-hover:bg-gray-900 group-hover:text-white transition-all duration-200">
                                <i class="fas fa-coffee text-lg"></i>
                            </div>
                            <span class="flex items-center space-x-1 px-2.5 py-1 bg-green-50 text-green-700 text-xs font-semibold rounded-lg">
                                <i class="fas fa-arrow-up text-xs"></i>
                                <span>+12%</span>
                            </span>
                        </div>
                        <div class="mt-5">
                            <h3 class="text-2xl font-bold text-gray-900">{{ $cafe_count ?? 15 }}</h3>
                            <p class="text-sm text-gray-500 font-medium mt-1">Total Cafe</p>
                        </div>
                    </div>

                    <!-- Fasilitas -->
                    <div class="bg-white rounded-xl border border-gray-100 p-6 hover:shadow-sm transition-all duration-200 group">
                        <div class="flex items-center justify-between">
                            <div class="p-3 rounded-xl bg-gray-50 text-gray-700 group-hover:bg-gray-900 group-hover:text-white transition-all duration-200">
                                <i class="fas fa-building text-lg"></i>
                            </div>
                            <span class="flex items-center space-x-1 px-2.5 py-1 bg-green-50 text-green-700 text-xs font-semibold rounded-lg">
                                <i class="fas fa-arrow-up text-xs"></i>
                                <span>+5%</span>
                            </span>
                        </div>
                        <div class="mt-5">
                            <h3 class="text-2xl font-bold text-gray-900">{{ $fasilitas_count ?? 12 }}</h3>
                            <p class="text-sm text-gray-500 font-medium mt-1">Fasilitas</p>
                        </div>
                    </div>

                    <!-- Menu Items -->
                    <div class="bg-white rounded-xl border border-gray-100 p-6 hover:shadow-sm transition-all duration-200 group">
                        <div class="flex items-center justify-between">
                            <div class="p-3 rounded-xl bg-gray-50 text-gray-700 group-hover:bg-gray-900 group-hover:text-white transition-all duration-200">
                                <i class="fas fa-utensils text-lg"></i>
                            </div>
                            <span class="flex items-center space-x-1 px-2.5 py-1 bg-red-50 text-red-700 text-xs font-semibold rounded-lg">
                                <i class="fas fa-arrow-down text-xs"></i>
                                <span>-2%</span>
                            </span>
                        </div>
                        <div class="mt-5">
                            <h3 class="text-2xl font-bold text-gray-900">{{ $harga_menu_count ?? 8 }}</h3>
                            <p class="text-sm text-gray-500 font-medium mt-1">Menu Items</p>
                        </div>
                    </div>

                    <!-- Total Kapasitas -->
                    <div class="bg-white rounded-xl border border-gray-100 p-6 hover:shadow-sm transition-all duration-200 group">
                        <div class="flex items-center justify-between">
                            <div class="p-3 rounded-xl bg-gray-50 text-gray-700 group-hover:bg-gray-900 group-hover:text-white transition-all duration-200">
                                <i class="fas fa-users text-lg"></i>
                            </div>
                            <span class="flex items-center space-x-1 px-2.5 py-1 bg-green-50 text-green-700 text-xs font-semibold rounded-lg">
                                <i class="fas fa-arrow-up text-xs"></i>
                                <span>+8%</span>
                            </span>
                        </div>
                        <div class="mt-5">
                            <h3 class="text-2xl font-bold text-gray-900">250</h3>
                            <p class="text-sm text-gray-500 font-medium mt-1">Total Kapasitas</p>
                        </div>
                    </div>
                </div>

                <!-- Main Content Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Quick Actions -->
                    <div class="lg:col-span-2">
                        <div class="bg-white rounded-xl border border-gray-100">
                            <div class="p-6 border-b border-gray-50">
                                <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                                    <div class="w-2 h-2 bg-gray-900 rounded-full mr-3"></div>
                                    Aksi Cepat
                                </h3>
                            </div>
                            <div class="p-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <a href="{{ route('cafe.index') }}" class="group flex items-center p-4 border border-gray-100 rounded-xl hover:border-gray-200 hover:shadow-sm transition-all duration-200">
                                        <div class="p-3 rounded-xl mr-4 bg-gray-50 text-gray-600 group-hover:bg-gray-900 group-hover:text-white transition-all duration-200">
                                            <i class="fas fa-plus text-sm"></i>
                                        </div>
                                        <div class="flex-1">
                                            <p class="font-semibold text-gray-900 group-hover:text-gray-900">Tambah Cafe Baru</p>
                                            <p class="text-sm text-gray-500 font-medium mt-0.5">Daftarkan cafe baru ke sistem</p>
                                        </div>
                                        <i class="fas fa-arrow-right text-gray-300 group-hover:text-gray-600 transition-colors duration-200"></i>
                                    </a>

                                    <a href="{{ route('fasilitas.index') }}" class="group flex items-center p-4 border border-gray-100 rounded-xl hover:border-gray-200 hover:shadow-sm transition-all duration-200">
                                        <div class="p-3 rounded-xl mr-4 bg-gray-50 text-gray-600 group-hover:bg-gray-900 group-hover:text-white transition-all duration-200">
                                            <i class="fas fa-building text-sm"></i>
                                        </div>
                                        <div class="flex-1">
                                            <p class="font-semibold text-gray-900 group-hover:text-gray-900">Kelola Fasilitas</p>
                                            <p class="text-sm text-gray-500 font-medium mt-0.5">Update fasilitas yang tersedia</p>
                                        </div>
                                        <i class="fas fa-arrow-right text-gray-300 group-hover:text-gray-600 transition-colors duration-200"></i>
                                    </a>

                                    <a href="{{ route('harga_menu.index') }}" class="group flex items-center p-4 border border-gray-100 rounded-xl hover:border-gray-200 hover:shadow-sm transition-all duration-200">
                                        <div class="p-3 rounded-xl mr-4 bg-gray-50 text-gray-600 group-hover:bg-gray-900 group-hover:text-white transition-all duration-200">
                                            <i class="fas fa-utensils text-sm"></i>
                                        </div>
                                        <div class="flex-1">
                                            <p class="font-semibold text-gray-900 group-hover:text-gray-900">Update Menu</p>
                                            <p class="text-sm text-gray-500 font-medium mt-0.5">Perbarui harga dan menu</p>
                                        </div>
                                        <i class="fas fa-arrow-right text-gray-300 group-hover:text-gray-600 transition-colors duration-200"></i>
                                    </a>

                                    <a href="#" class="group flex items-center p-4 border border-gray-100 rounded-xl hover:border-gray-200 hover:shadow-sm transition-all duration-200">
                                        <div class="p-3 rounded-xl mr-4 bg-gray-50 text-gray-600 group-hover:bg-gray-900 group-hover:text-white transition-all duration-200">
                                            <i class="fas fa-chart-line text-sm"></i>
                                        </div>
                                        <div class="flex-1">
                                            <p class="font-semibold text-gray-900 group-hover:text-gray-900">Analisis Data</p>
                                            <p class="text-sm text-gray-500 font-medium mt-0.5">Lihat laporan dan statistik</p>
                                        </div>
                                        <i class="fas fa-arrow-right text-gray-300 group-hover:text-gray-600 transition-colors duration-200"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- System Info -->
                    <div class="bg-white rounded-xl border border-gray-100">
                        <div class="p-6 border-b border-gray-50">
                            <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                                <div class="w-2 h-2 bg-green-500 rounded-full mr-3"></div>
                                Info Sistem
                            </h3>
                        </div>
                        <div class="p-6 space-y-4">
                            <div class="flex justify-between items-center p-4 bg-gray-50 rounded-xl">
                                <span class="text-sm font-semibold text-gray-600">Total Data</span>
                                <span class="font-bold text-gray-900">{{ $total_data ?? 47 }}</span>
                            </div>
                            <div class="flex justify-between items-center p-4 bg-gray-50 rounded-xl">
                                <span class="text-sm font-semibold text-gray-600">Data Master</span>
                                <span class="font-bold text-gray-900">{{ $total_master ?? 32 }}</span>
                            </div>
                            <div class="flex justify-between items-center p-4 bg-gray-50 rounded-xl">
                                <span class="text-sm font-semibold text-gray-600">Status</span>
                                <span class="px-3 py-1.5 bg-green-50 text-green-700 rounded-lg text-xs font-semibold flex items-center">
                                    <div class="w-2 h-2 bg-green-500 rounded-full mr-2"></div>
                                    Online
                                </span>
                            </div>
                            <div class="flex justify-between items-center p-4 bg-gray-50 rounded-xl">
                                <span class="text-sm font-semibold text-gray-600">Update Terakhir</span>
                                <span class="text-xs text-gray-500 font-medium">{{ now()->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="bg-white rounded-xl border border-gray-100">
                    <div class="p-6 border-b border-gray-50">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                            <div class="w-2 h-2 bg-blue-500 rounded-full mr-3"></div>
                            Aktivitas Terbaru
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            <div class="flex items-center p-4 bg-green-50 rounded-xl border-l-4 border-green-500">
                                <div class="p-2.5 bg-white rounded-xl mr-4 shadow-sm">
                                    <i class="fas fa-plus text-gray-600 text-sm"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-semibold text-gray-900">Cafe "Warung Kopi Santai" ditambahkan</p>
                                    <p class="text-xs text-gray-500 font-medium mt-0.5">2 menit yang lalu</p>
                                </div>
                            </div>

                            <div class="flex items-center p-4 bg-blue-50 rounded-xl border-l-4 border-blue-500">
                                <div class="p-2.5 bg-white rounded-xl mr-4 shadow-sm">
                                    <i class="fas fa-edit text-gray-600 text-sm"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-semibold text-gray-900">Fasilitas "WiFi Gratis" diperbarui</p>
                                    <p class="text-xs text-gray-500 font-medium mt-0.5">15 menit yang lalu</p>
                                </div>
                            </div>

                            <div class="flex items-center p-4 bg-orange-50 rounded-xl border-l-4 border-orange-500">
                                <div class="p-2.5 bg-white rounded-xl mr-4 shadow-sm">
                                    <i class="fas fa-utensils text-gray-600 text-sm"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-semibold text-gray-900">Menu "Kopi Americano" harga diubah</p>
                                    <p class="text-xs text-gray-500 font-medium mt-0.5">30 menit yang lalu</p>
                                </div>
                            </div>

                            <div class="flex items-center p-4 bg-purple-50 rounded-xl border-l-4 border-purple-500">
                                <div class="p-2.5 bg-white rounded-xl mr-4 shadow-sm">
                                    <i class="fas fa-clock text-gray-600 text-sm"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-semibold text-gray-900">Jam buka "24 Jam" ditambahkan</p>
                                    <p class="text-xs text-gray-500 font-medium mt-0.5">1 jam yang lalu</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
@endsection