<?php

namespace App\Http\Controllers;

use App\Models\Komentar;
use Illuminate\Http\Request;

class KomentarController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'cafe_id' => 'required|exists:cafe,id',
            'isi_komentar' => 'required|string',
        ]);

        Komentar::create([
            'cafe_id' => $request->cafe_id,
            'nama' => 'Anonymous', // otomatis anonymous
            'isi_komentar' => $request->isi_komentar,
            'disetujui' => false, // Belum disetujui
        ]);

        // Kembali ke halaman awal dengan notifikasi
        return redirect('/')->with('success', 'Komentar dikirim, menunggu persetujuan admin.');
    }

}
