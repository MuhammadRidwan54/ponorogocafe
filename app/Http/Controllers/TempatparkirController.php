<?php

namespace App\Http\Controllers;

use App\Models\tempatparkir;
use Illuminate\Http\Request;

class TempatparkirController extends Controller
{
    public function index()
    {
        $tempatparkir = tempatparkir::all();
        return view('tempat_parkir.index', compact('tempatparkir'));
    }

    public function create()
    {
        return view('tempat_parkir.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tempat_parkir' => 'required|string|max:255',
        ]);

        tempatparkir::create([
            'tempat_parkir' => $request->tempat_parkir,
        ]);

        return redirect()->route('tempat_parkir.index')->with('success', 'Tempat parkir berhasil ditambahkan');
    }

    public function edit(tempatparkir $tempat_parkir)
    {
        return view('tempat_parkir.edit', ['tempatparkir' => $tempat_parkir]);
    }

    public function update(Request $request, tempatparkir $tempat_parkir)
    {
        $request->validate([
            'tempat_parkir' => 'required|string|max:255',
        ]);

        $tempat_parkir->update([
            'tempat_parkir' => $request->tempat_parkir,
        ]);

        return redirect()->route('tempat_parkir.index')->with('success', 'Tempat parkir berhasil diperbarui');
    }

    public function destroy(tempatparkir $tempat_parkir)
    {
        $tempat_parkir->delete();

        return redirect()->route('tempat_parkir.index')->with('success', 'Tempat parkir berhasil dihapus');
    }
}
