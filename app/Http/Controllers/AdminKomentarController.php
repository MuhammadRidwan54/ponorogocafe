<?php

namespace App\Http\Controllers;

use App\Models\Komentar;
use Illuminate\Http\Request;

class AdminKomentarController extends Controller
{
    public function index()
    {
        $komentar = \App\Models\Komentar::with('cafe')->latest()->get();
        return view('komentar.index', compact('komentar'));
    }

    public function setujui($id)
    {
        $komentar = Komentar::findOrFail($id);
        $komentar->disetujui = true;
        $komentar->save();

        return back()->with('success', 'Komentar telah disetujui.');
    }

    public function hapus($id)
    {
        $komentar = Komentar::findOrFail($id);
        $komentar->delete();

        return back()->with('success', 'Komentar berhasil dihapus.');
    }
}
