@extends('layouts.app')

@section('title', 'Dashboard Admin - PonorogoCafe')
@section('header-title', 'Dashboard Utama')
@section('header-description', 'Selamat datang di panel admin PonorogoCafe')

@section('content')
    <!-- Stats Cards -->
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3 lg:gap-6 mb-6 lg:mb-8">
        <!-- Fasilitas Card -->
        <div class="bg-white rounded-xl shadow-md p-3 lg:p-6 hover:shadow-lg transition-shadow duration-200">
            <div class="flex flex-col lg:flex-row lg:items-center">
                <div class="p-2 lg:p-3 rounded-full bg-brown-100 text-brown-600 self-center lg:self-auto">
                    <i class="fas fa-building text-lg lg:text-xl"></i>
                </div>
                <div class="mt-2 lg:mt-0 lg:ml-4 text-center lg:text-left">
                    <h3 class="text-sm lg:text-lg font-semibold text-gray-700">Fasilitas</h3>
                    <p class="text-lg lg:text-2xl font-bold text-brown-600">12</p>
                </div>
            </div>
            <div class="mt-2 lg:mt-4 text-center lg:text-left">
                <a href="" class="text-brown-600 hover:text-brown-800 font-medium text-xs lg:text-sm">
                    Kelola →
                </a>
            </div>
        </div>

        <!-- Harga Menu Card -->
        <div class="bg-white rounded-xl shadow-md p-3 lg:p-6 hover:shadow-lg transition-shadow duration-200">
            <div class="flex flex-col lg:flex-row lg:items-center">
                <div class="p-2 lg:p-3 rounded-full bg-green-100 text-green-600 self-center lg:self-auto">
                    <i class="fas fa-utensils text-lg lg:text-xl"></i>
                </div>
                <div class="mt-2 lg:mt-0 lg:ml-4 text-center lg:text-left">
                    <h3 class="text-sm lg:text-lg font-semibold text-gray-700">Harga Menu</h3>
                    <p class="text-lg lg:text-2xl font-bold text-green-600">8</p>
                </div>
            </div>
            <div class="mt-2 lg:mt-4 text-center lg:text-left">
                <a href="" class="text-green-600 hover:text-green-800 font-medium text-xs lg:text-sm">
                    Kelola →
                </a>
            </div>
        </div>

        <!-- Kapasitas Ruang Card -->
        <div class="bg-white rounded-xl shadow-md p-3 lg:p-6 hover:shadow-lg transition-shadow duration-200">
            <div class="flex flex-col lg:flex-row lg:items-center">
                <div class="p-2 lg:p-3 rounded-full bg-blue-100 text-blue-600 self-center lg:self-auto">
                    <i class="fas fa-users text-lg lg:text-xl"></i>
                </div>
                <div class="mt-2 lg:mt-0 lg:ml-4 text-center lg:text-left">
                    <h3 class="text-sm lg:text-lg font-semibold text-gray-700">Kapasitas</h3>
                    <p class="text-lg lg:text-2xl font-bold text-blue-600">5</p>
                </div>
            </div>
            <div class="mt-2 lg:mt-4 text-center lg:text-left">
                <a href="" class="text-blue-600 hover:text-blue-800 font-medium text-xs lg:text-sm">
                    Kelola →
                </a>
            </div>
        </div>

        <!-- Tempat Parkir Card -->
        <div class="bg-white rounded-xl shadow-md p-3 lg:p-6 hover:shadow-lg transition-shadow duration-200">
            <div class="flex flex-col lg:flex-row lg:items-center">
                <div class="p-2 lg:p-3 rounded-full bg-purple-100 text-purple-600 self-center lg:self-auto">
                    <i class="fas fa-car text-lg lg:text-xl"></i>
                </div>
                <div class="mt-2 lg:mt-0 lg:ml-4 text-center lg:text-left">
                    <h3 class="text-sm lg:text-lg font-semibold text-gray-700">Parkir</h3>
                    <p class="text-lg lg:text-2xl font-bold text-purple-600">3</p>
                </div>
            </div>
            <div class="mt-2 lg:mt-4 text-center lg:text-left">
                <a href="" class="text-purple-600 hover:text-purple-800 font-medium text-xs lg:text-sm">
                    Kelola →
                </a>
            </div>
        </div>

        <!-- Jam Buka Card -->
        <div class="bg-white rounded-xl shadow-md p-3 lg:p-6 hover:shadow-lg transition-shadow duration-200">
            <div class="flex flex-col lg:flex-row lg:items-center">
                <div class="p-2 lg:p-3 rounded-full bg-orange-100 text-orange-600 self-center lg:self-auto">
                    <i class="fas fa-clock text-lg lg:text-xl"></i>
                </div>
                <div class="mt-2 lg:mt-0 lg:ml-4 text-center lg:text-left">
                    <h3 class="text-sm lg:text-lg font-semibold text-gray-700">Jam Buka</h3>
                    <p class="text-lg lg:text-2xl font-bold text-orange-600">4</p>
                </div>
            </div>
            <div class="mt-2 lg:mt-4 text-center lg:text-left">
                <a href="" class="text-orange-600 hover:text-orange-800 font-medium text-xs lg:text-sm">
                    Kelola →
                </a>
            </div>
        </div>

        <!-- Menu Cafe Card -->
        <div class="bg-white rounded-xl shadow-md p-3 lg:p-6 hover:shadow-lg transition-shadow duration-200">
            <div class="flex flex-col lg:flex-row lg:items-center">
                <div class="p-2 lg:p-3 rounded-full bg-red-100 text-red-600 self-center lg:self-auto">
                    <i class="fas fa-coffee text-lg lg:text-xl"></i>
                </div>
                <div class="mt-2 lg:mt-0 lg:ml-4 text-center lg:text-left">
                    <h3 class="text-sm lg:text-lg font-semibold text-gray-700">Cafe</h3>
                    <p class="text-lg lg:text-2xl font-bold text-red-600">15</p>
                </div>
            </div>
            <div class="mt-2 lg:mt-4 text-center lg:text-left">
                <a href="" class="text-red-600 hover:text-red-800 font-medium text-xs lg:text-sm">
                    Kelola →
                </a>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 lg:gap-6">
        <!-- Quick Actions -->
        <div class="bg-white rounded-xl shadow-md p-4 lg:p-6">
            <h3 class="text-base lg:text-lg font-semibold text-gray-700 mb-4">Aksi Cepat</h3>
            <div class="space-y-3">
                <a href="" class="flex items-center p-3 bg-brown-50 rounded-lg hover:bg-brown-100 transition-colors">
                    <i class="fas fa-plus text-brown-600 mr-3"></i>
                    <span class="text-gray-700 text-sm lg:text-base">Tambah Cafe Baru</span>
                </a>
                <a href="" class="flex items-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                    <i class="fas fa-building text-gray-600 mr-3"></i>
                    <span class="text-gray-700 text-sm lg:text-base">Kelola Fasilitas</span>
                </a>
                <a href="" class="flex items-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                    <i class="fas fa-utensils text-gray-600 mr-3"></i>
                    <span class="text-gray-700 text-sm lg:text-base">Update Harga Menu</span>
                </a>
            </div>
        </div>

        <!-- System Info -->
        <div class="bg-white rounded-xl shadow-md p-4 lg:p-6">
            <h3 class="text-base lg:text-lg font-semibold text-gray-700 mb-4">Informasi Sistem</h3>
            <div class="space-y-3">
                <div class="flex justify-between items-center">
                    <span class="text-gray-600 text-sm lg:text-base">Total Data Cafe</span>
                    <span class="font-semibold text-brown-600">15</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-600 text-sm lg:text-base">Data Master</span>
                    <span class="font-semibold text-green-600">32</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-600 text-sm lg:text-base">Status Sistem</span>
                    <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs font-medium">Online</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-600 text-sm lg:text-base">Last Update</span>
                    <span class="text-gray-500 text-xs lg:text-sm">2 menit lalu</span>
                </div>
            </div>
        </div>
    </div>
@endsection