<?php

namespace App\Http\Controllers;

use App\Models\Cafe;
use App\Models\Review;
use App\Models\JamBuka;
use App\Models\Fasilitas;
use App\Models\HargaMenu;
use App\Models\TempatParkir;
use App\Models\KapasitasRuang;
use Illuminate\Http\Request;

class CafeController extends Controller
{
    public function index()
    {
        $cafe = Cafe::with([
            'fasilitas',
            'hargamenu', 
            'kapasitasruang', 
            'tempatparkir',
            'jambuka'
        ])->get();

        $jambuka = JamBuka::all();
        $hargamenu = HargaMenu::all();
        $kapasitasruang = KapasitasRuang::all();
        $tempatparkir = TempatParkir::all();
        $fasilitas = Fasilitas::all();

        return view('cafe.index', compact(
            'cafe',
            'jambuka',
            'hargamenu',
            'kapasitasruang',
            'tempatparkir',
            'fasilitas'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_cafe' => 'required|string',
            'alamat' => 'required|string',
            'alamat_url' => 'required|url',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg|max:5120', // 5MB
            'gambar.*' => 'nullable|image|mimes:jpeg,png,jpg|max:5120', // 5MB
            'fasilitas_id' => 'required|array',
            'fasilitas_id.*' => 'exists:fasilitas,id',
            'hargamenu_id' => 'required|exists:hargamenu,id',
            'kapasitasruang_id' => 'required|exists:kapasitasruang,id',
            'tempatparkir_id' => 'required|exists:tempatparkir,id',
            'jambuka_id' => 'required|exists:jambuka,id',
        ]);

        $gambarPaths = [];
        if($request->hasFile('gambar')) {
            foreach($request->file('gambar') as $image) {
                $gambarPaths[] = $image->store('gambar_cafe', 'public');
            }
        }

        $cafe = Cafe::create([
            'nama_cafe' => $request->nama_cafe,
            'alamat' => $request->alamat,
            'alamat_url' => $request->alamat_url,
            'thumbnail' => $request->file('thumbnail')->store('thumbnail_cafe', 'public'),
            'gambar' => json_encode($gambarPaths),
            'hargamenu_id' => $request->hargamenu_id,
            'kapasitasruang_id' => $request->kapasitasruang_id,
            'tempatparkir_id' => $request->tempatparkir_id,
            'jambuka_id' => $request->jambuka_id,
        ]);

        $cafe->fasilitas()->sync($request->fasilitas_id);

        return redirect()->route('cafe.index')->with('success', 'Cafe berhasil ditambahkan');
        
    }

    public function edit($id)
    {
        $cafe = Cafe::with('fasilitas')->findOrFail($id);
        $jambuka = JamBuka::all();
        $hargamenu = HargaMenu::all();
        $kapasitasruang = KapasitasRuang::all();
        $tempatparkir = TempatParkir::all();
        $fasilitas = Fasilitas::all();

        return view('cafe.edit-modal-data', compact(
            'cafe',
            'jambuka',
            'hargamenu',
            'kapasitasruang',
            'tempatparkir',
            'fasilitas',
        ));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_cafe' => 'required|string',
            'alamat' => 'required|string',
            'alamat_url' => 'nullable|url',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'gambar.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'hargamenu_id' => 'required|exists:hargamenu,id',
            'kapasitasruang_id' => 'required|exists:kapasitasruang,id',
            'tempatparkir_id' => 'required|exists:tempatparkir,id',
            'jambuka_id' => 'required|exists:jambuka,id',
            'fasilitas_id' => 'required|array',
            'fasilitas_id.*' => 'exists:fasilitas,id',
        ]);

        $cafe = Cafe::findOrFail($id);
        
        $gambarPaths = json_decode($cafe->gambar) ?? [];
        if($request->hasFile('gambar')) {
            foreach($request->file('gambar') as $image) {
                $gambarPaths[] = $image->store('gambar_cafe', 'public');
            }
        }

        $updateData = [
            'nama_cafe' => $request->nama_cafe,
            'alamat' => $request->alamat,
            'alamat_url' => $request->alamat_url ?? null,
            'gambar' => json_encode($gambarPaths),
            'hargamenu_id' => $request->hargamenu_id,
            'kapasitasruang_id' => $request->kapasitasruang_id,
            'tempatparkir_id' => $request->tempatparkir_id,
            'jambuka_id' => $request->jambuka_id,
        ];

        if ($request->hasFile('thumbnail')) {
            $updateData['thumbnail'] = $request->file('thumbnail')->store('thumbnail_cafe', 'public');
        }

        $cafe->update($updateData);
        $cafe->fasilitas()->sync($request->fasilitas_id);

        return redirect()->route('cafe.index')->with('success', 'Cafe berhasil diperbarui');
    }

    public function destroy($id)
    {
        $cafe = Cafe::findOrFail($id);
        $cafe->delete();

        return redirect()->route('cafe.index')->with('success', 'Cafe berhasil dihapus');
    }
}