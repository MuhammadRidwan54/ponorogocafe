<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use Illuminate\Http\Request;

class FasilitasController extends Controller
{
    public function index()
    {
        $fasilitas = Fasilitas::all();
        return view('fasilitas.index', compact('fasilitas'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_fasilitas' => 'required|string|max:255',
            'icon_svg' => 'nullable|string',
        ]);

        Fasilitas::create($data);

        return redirect()->route('fasilitas.index')->with('success', 'Fasilitas berhasil ditambahkan');
    }

    public function show($id)
    {
        $fasilitas = Fasilitas::findOrFail($id);
        return response()->json($fasilitas);
    }

    public function edit($id)
    {
        $fasilitas = Fasilitas::findOrFail($id);
        return response()->json([
            'nama_fasilitas' => $fasilitas->nama_fasilitas,
            'icon_svg' => $fasilitas->icon_svg,
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'nama_fasilitas' => 'required|string|max:255',
            'icon_svg' => 'nullable|string',
        ]);

        $fasilitas = Fasilitas::findOrFail($id);
        $fasilitas->update($data);

        return redirect()->route('fasilitas.index')->with('success', 'Fasilitas berhasil diperbarui');
    }

    public function destroy($id)
    {
        $fasilitas = Fasilitas::findOrFail($id);
        $fasilitas->delete();

        return redirect()->route('fasilitas.index')->with('success', 'Fasilitas berhasil dihapus');
    }
}