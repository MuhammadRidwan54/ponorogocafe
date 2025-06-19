<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Menampilkan dashboard utama
     */
    public function index()
    {
        // Ambil data user yang sedang login
        $user = Auth::user();
        
        return view('dashboard.index', [
            'user' => $user,
            'title' => 'Dashboard'
        ]);
    }
}