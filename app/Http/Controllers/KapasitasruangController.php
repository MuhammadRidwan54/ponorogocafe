<?php

namespace App\Http\Controllers;

use App\Models\kapasitasruang;
use Illuminate\Http\Request;

class KapasitasruangController extends Controller
{
    public function index()
    {
        $kapasitasruang = kapasitasruang::all();
        return view('kapasitas_ruang.index', compact('kapasitasruang'));
    }

    public function create()
    {
        return view('kapasitas_ruang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kapasitas_ruang' => 'required|string|max:255',
        ]);

        kapasitasruang::create([
            'kapasitas_ruang' => $request->kapasitas_ruang,
        ]);

        return redirect()->route('kapasitas_ruang.index')->with('success', 'Kapasitas ruang berhasil ditambahkan');
    }

    public function edit(kapasitasruang $kapasitas_ruang)
    {
        return view('kapasitas_ruang.edit', ['kapasitasruang' => $kapasitas_ruang]);
    }

    public function update(Request $request, kapasitasruang $kapasitas_ruang)
    {
        $request->validate([
            'kapasitas_ruang' => 'required|string|max:255',
        ]);

        $kapasitas_ruang->update([
            'kapasitas_ruang' => $request->kapasitas_ruang,
        ]);

        return redirect()->route('kapasitas_ruang.index')->with('success', 'Kapasitas ruang berhasil diperbarui');
    }

    public function destroy(kapasitasruang $kapasitas_ruang)
    {
        $kapasitas_ruang->delete();

        return redirect()->route('kapasitas_ruang.index')->with('success', 'Kapasitas ruang berhasil dihapus');
    }
}
