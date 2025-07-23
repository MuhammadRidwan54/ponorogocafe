<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cafe;
use App\Models\Fasilitas;
use App\Models\HargaMenu;
use App\Models\Komentar;

class DashboardController extends Controller
{
    /**
     * Menampilkan dashboard utama
     */
    public function index()
    {
        // Ambil data user yang sedang login
        $user = Auth::user();
        
        // Hitung statistik utama
        $cafe_count = Cafe::count();
        $fasilitas_count = Fasilitas::count();
        $harga_menu_count = HargaMenu::count();
        $komentar_count = Komentar::count();
        $komentar_baru = Komentar::where('disetujui', false)->count();
        
        // Hitung komentar terbaru untuk activity feed
        $latest_comment = Komentar::with('cafe')
                              ->latest()
                              ->first();
        
        // Hitung total data (cafe + fasilitas + menu)
        $total_data = $cafe_count + $fasilitas_count + $harga_menu_count;
        
        return view('dashboard.index', [
            'user' => $user,
            'title' => 'Dashboard Admin',
            
            // Data statistik
            'cafe_count' => $cafe_count,
            'fasilitas_count' => $fasilitas_count,
            'harga_menu_count' => $harga_menu_count,
            'komentar_count' => $komentar_count,
            'komentar_baru' => $komentar_baru,
            
            // Data tambahan
            'total_data' => $total_data,
            'total_master' => 3, // Jumlah model master (Cafe, Fasilitas, HargaMenu)
            
            // Data untuk activity feed
            'latest_comment' => $latest_comment
        ]);
    }
}