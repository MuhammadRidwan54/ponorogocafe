@extends('layouts.app')

@section('title', 'Dashboard Admin - PonorogoCafe')
@section('header-title', 'Dashboard Utama')
@section('header-description', 'Selamat datang di panel admin PonorogoCafe')

@section('content')
    <div class="min-h-screen bg-gray-50 flex">
        <!-- Main Content -->
        <div class="flex-1 flex flex-col min-w-0 lg:ml-0">
            <!-- Main Dashboard Content -->
            <main class="flex-1 overflow-auto p-2 space-y-6">  
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Total Cafe -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-lg transition-shadow">
                        <div class="flex items-center justify-between">
                            <div class="p-3 rounded-lg bg-blue-50 text-blue-600">
                                <i class="fas fa-coffee text-xl"></i>
                            </div>
                            <span class="flex items-center space-x-1 px-2 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">
                                <i class="fas fa-arrow-up"></i>
                                <span>+12%</span>
                            </span>
                        </div>
                        <div class="mt-4">
                            <h3 class="text-2xl font-bold text-gray-900">{{ $cafe_count ?? 15 }}</h3>
                            <p class="text-sm text-gray-600">Total Cafe</p>
                        </div>
                    </div>

                    <!-- Fasilitas -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-lg transition-shadow">
                        <div class="flex items-center justify-between">
                            <div class="p-3 rounded-lg bg-green-50 text-green-600">
                                <i class="fas fa-building text-xl"></i>
                            </div>
                            <span class="flex items-center space-x-1 px-2 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">
                                <i class="fas fa-arrow-up"></i>
                                <span>+5%</span>
                            </span>
                        </div>
                        <div class="mt-4">
                            <h3 class="text-2xl font-bold text-gray-900">{{ $fasilitas_count ?? 12 }}</h3>
                            <p class="text-sm text-gray-600">Fasilitas</p>
                        </div>
                    </div>

                    <!-- Menu Items -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-lg transition-shadow">
                        <div class="flex items-center justify-between">
                            <div class="p-3 rounded-lg bg-orange-50 text-orange-600">
                                <i class="fas fa-utensils text-xl"></i>
                            </div>
                            <span class="flex items-center space-x-1 px-2 py-1 bg-red-100 text-red-800 text-xs font-medium rounded-full">
                                <i class="fas fa-arrow-down"></i>
                                <span>-2%</span>
                            </span>
                        </div>
                        <div class="mt-4">
                            <h3 class="text-2xl font-bold text-gray-900">{{ $harga_menu_count ?? 8 }}</h3>
                            <p class="text-sm text-gray-600">Menu Items</p>
                        </div>
                    </div>

                    <!-- Total Kapasitas -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-lg transition-shadow">
                        <div class="flex items-center justify-between">
                            <div class="p-3 rounded-lg bg-purple-50 text-purple-600">
                                <i class="fas fa-users text-xl"></i>
                            </div>
                            <span class="flex items-center space-x-1 px-2 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">
                                <i class="fas fa-arrow-up"></i>
                                <span>+8%</span>
                            </span>
                        </div>
                        <div class="mt-4">
                            <h3 class="text-2xl font-bold text-gray-900">250</h3>
                            <p class="text-sm text-gray-600">Total Kapasitas</p>
                        </div>
                    </div>
                </div>

                <!-- Main Content Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Quick Actions -->
                    <div class="lg:col-span-2">
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                            <div class="p-6 border-b border-gray-200">
                                <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                                    <i class="fas fa-bolt text-blue-600 mr-2"></i>
                                    Aksi Cepat
                                </h3>
                            </div>
                            <div class="p-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <a href="{{ route('cafe.index') }}" class="flex items-center p-4 border border-gray-200 rounded-lg hover:shadow-md hover:border-blue-300 transition-all group">
                                        <div class="p-2 rounded-lg mr-4 bg-blue-50 text-blue-600">
                                            <i class="fas fa-plus"></i>
                                        </div>
                                        <div class="flex-1">
                                            <p class="font-medium text-gray-900 group-hover:text-blue-700">Tambah Cafe Baru</p>
                                            <p class="text-sm text-gray-500">Daftarkan cafe baru ke sistem</p>
                                        </div>
                                        <i class="fas fa-arrow-right text-gray-400 group-hover:text-blue-600"></i>
                                    </a>

                                    <a href="{{ route('fasilitas.index') }}" class="flex items-center p-4 border border-gray-200 rounded-lg hover:shadow-md hover:border-green-300 transition-all group">
                                        <div class="p-2 rounded-lg mr-4 bg-green-50 text-green-600">
                                            <i class="fas fa-building"></i>
                                        </div>
                                        <div class="flex-1">
                                            <p class="font-medium text-gray-900 group-hover:text-green-700">Kelola Fasilitas</p>
                                            <p class="text-sm text-gray-500">Update fasilitas yang tersedia</p>
                                        </div>
                                        <i class="fas fa-arrow-right text-gray-400 group-hover:text-green-600"></i>
                                    </a>

                                    <a href="{{ route('harga_menu.index') }}" class="flex items-center p-4 border border-gray-200 rounded-lg hover:shadow-md hover:border-orange-300 transition-all group">
                                        <div class="p-2 rounded-lg mr-4 bg-orange-50 text-orange-600">
                                            <i class="fas fa-utensils"></i>
                                        </div>
                                        <div class="flex-1">
                                            <p class="font-medium text-gray-900 group-hover:text-orange-700">Update Menu</p>
                                            <p class="text-sm text-gray-500">Perbarui harga dan menu</p>
                                        </div>
                                        <i class="fas fa-arrow-right text-gray-400 group-hover:text-orange-600"></i>
                                    </a>

                                    <a href="#" class="flex items-center p-4 border border-gray-200 rounded-lg hover:shadow-md hover:border-purple-300 transition-all group">
                                        <div class="p-2 rounded-lg mr-4 bg-purple-50 text-purple-600">
                                            <i class="fas fa-chart-line"></i>
                                        </div>
                                        <div class="flex-1">
                                            <p class="font-medium text-gray-900 group-hover:text-purple-700">Analisis Data</p>
                                            <p class="text-sm text-gray-500">Lihat laporan dan statistik</p>
                                        </div>
                                        <i class="fas fa-arrow-right text-gray-400 group-hover:text-purple-600"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- System Info -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                        <div class="p-6 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                                <i class="fas fa-info-circle text-green-600 mr-2"></i>
                                Info Sistem
                            </h3>
                        </div>
                        <div class="p-6 space-y-4">
                            <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                                <span class="text-sm font-medium text-gray-600">Total Data</span>
                                <span class="font-bold text-blue-600">{{ $total_data ?? 47 }}</span>
                            </div>
                            <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                                <span class="text-sm font-medium text-gray-600">Data Master</span>
                                <span class="font-bold text-green-600">{{ $total_master ?? 32 }}</span>
                            </div>
                            <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                                <span class="text-sm font-medium text-gray-600">Status</span>
                                <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold flex items-center">
                                    <i class="fas fa-circle text-green-500 mr-1" style="font-size: 8px;"></i>
                                    Online
                                </span>
                            </div>
                            <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                                <span class="text-sm font-medium text-gray-600">Update Terakhir</span>
                                <span class="text-xs text-gray-500">{{ now()->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                            <i class="fas fa-chart-line text-blue-600 mr-2"></i>
                            Aktivitas Terbaru
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            <div class="flex items-center p-4 border-l-4 border-green-500 bg-green-50 rounded-r-lg">
                                <div class="p-2 bg-white rounded-lg mr-4 shadow-sm">
                                    <i class="fas fa-plus text-gray-600"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-900">Cafe "Warung Kopi Santai" ditambahkan</p>
                                    <p class="text-xs text-gray-500">2 menit yang lalu</p>
                                </div>
                            </div>

                            <div class="flex items-center p-4 border-l-4 border-blue-500 bg-blue-50 rounded-r-lg">
                                <div class="p-2 bg-white rounded-lg mr-4 shadow-sm">
                                    <i class="fas fa-edit text-gray-600"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-900">Fasilitas "WiFi Gratis" diperbarui</p>
                                    <p class="text-xs text-gray-500">15 menit yang lalu</p>
                                </div>
                            </div>

                            <div class="flex items-center p-4 border-l-4 border-orange-500 bg-orange-50 rounded-r-lg">
                                <div class="p-2 bg-white rounded-lg mr-4 shadow-sm">
                                    <i class="fas fa-utensils text-gray-600"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-900">Menu "Kopi Americano" harga diubah</p>
                                    <p class="text-xs text-gray-500">30 menit yang lalu</p>
                                </div>
                            </div>

                            <div class="flex items-center p-4 border-l-4 border-purple-500 bg-purple-50 rounded-r-lg">
                                <div class="p-2 bg-white rounded-lg mr-4 shadow-sm">
                                    <i class="fas fa-clock text-gray-600"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-900">Jam buka "24 Jam" ditambahkan</p>
                                    <p class="text-xs text-gray-500">1 jam yang lalu</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
@endsection