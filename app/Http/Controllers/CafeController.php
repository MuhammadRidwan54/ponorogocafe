<?php

namespace App\Http\Controllers;

use App\Models\Cafe;
use App\Models\Label;
use App\Models\Review;
use App\Models\JamBuka;
use App\Models\Komentar;
use App\Models\Fasilitas;
use App\Models\HargaMenu;
use App\Models\TempatParkir;
use Illuminate\Http\Request;
use App\Models\KapasitasRuang;

class CafeController extends Controller
{
    public function index(Request $request)
    {
        $query = Cafe::query();

        if ($request->filled('search')) {
            $query->where('nama_cafe', 'like', '%' . $request->search . '%');
        }

        $cafe = $query->with(['fasilitas', 'labels', 'hargamenu', 'kapasitasruang', 'tempatparkir', 'jambuka'])->get();
        
        $jambuka = JamBuka::all();
        $hargamenu = HargaMenu::all();
        $kapasitasruang = KapasitasRuang::all();
        $tempatparkir = TempatParkir::all();
        $fasilitas = Fasilitas::all();
        $labels = Label::all();

        // Jika AJAX, return hanya tbody
        if ($request->ajax()) {
            return view('cafe._table', compact('cafe'))->render();
        }

        return view('cafe.index', compact(
            'cafe',
            'jambuka',
            'hargamenu',
            'kapasitasruang',
            'tempatparkir',
            'fasilitas',
            'labels'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_cafe' => 'required|string',
            'alamat' => 'required|string',
            'alamat_url' => 'required|url',
            'keterangan_motor' => 'required|string',
            'keterangan_mobil' => 'required|string',
            'keterangan_mushola' => 'required|string',
            'keterangan_toilet' => 'required|string',
            'instagram_url' => 'nullable|url|',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg|max:8192',
            'gambar.*' => 'nullable|image|mimes:jpeg,png,jpg|max:8192',
            'fasilitas_id' => 'required|array',
            'fasilitas_id.*' => 'exists:fasilitas,id',
            'label_id' => 'required|array',
            'label_id.*' => 'exists:label,id',
            'hargamenu_id' => 'required|exists:hargamenu,id',
            'kapasitasruang_id' => 'required|exists:kapasitasruang,id',
            'tempatparkir_id' => 'required|exists:tempatparkir,id',
            'jambuka_id' => 'required|exists:jambuka,id',
        ]);

        // Format instagram_url jika input berupa @username
        if ($request->instagram_url && str_starts_with($request->instagram_url, '@')) {
            $validated['instagram_url'] = 'https://instagram.com/'.substr($request->instagram_url, 1);
        }

        $gambarPaths = [];
        if ($request->hasFile('gambar')) {
            foreach ($request->file('gambar') as $image) {
                $gambarPaths[] = $image->store('gambar_cafe', 'public');
            }
        }

        $cafe = Cafe::create([
            'nama_cafe' => $request->nama_cafe,
            'alamat' => $request->alamat,
            'alamat_url' => $request->alamat_url,
            'keterangan_motor' => $request->keterangan_motor,
            'keterangan_mobil' => $request->keterangan_mobil,
            'keterangan_mushola' => $request->keterangan_mushola,
            'keterangan_toilet' => $request->keterangan_toilet,
            'instagram_url' => $request->instagram_url,
            'thumbnail' => $request->file('thumbnail')->store('thumbnail_cafe', 'public'),
            'gambar' => json_encode($gambarPaths),
            'hargamenu_id' => $request->hargamenu_id,
            'kapasitasruang_id' => $request->kapasitasruang_id,
            'tempatparkir_id' => $request->tempatparkir_id,
            'jambuka_id' => $request->jambuka_id,
        ]);

        $cafe->fasilitas()->sync($request->fasilitas_id);
        $cafe->labels()->sync($request->label_id);

        return redirect()->route('cafe.index')->with('success', 'Cafe berhasil ditambahkan');
    }

    public function edit($id)
    {
        $cafe = Cafe::with(['fasilitas', 'labels'])->findOrFail($id);
        
        $jambuka = JamBuka::all();
        $hargamenu = HargaMenu::all();
        $kapasitasruang = KapasitasRuang::all();
        $tempatparkir = TempatParkir::all();
        $fasilitas = Fasilitas::all();
        $labels = Label::all();

        return view('cafe.edit-modal-data', compact(
            'cafe',
            'jambuka',
            'hargamenu',
            'kapasitasruang',
            'tempatparkir',
            'fasilitas',
            'labels'
        ));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_cafe' => 'required|string',
            'alamat' => 'required|string',
            'alamat_url' => 'nullable|url',
            'keterangan_motor' => 'required|string',
            'keterangan_mobil' => 'required|string',
            'keterangan_mushola' => 'required|string',
            'keterangan_toilet' => 'required|string',
            'instagram_url' => 'nullable|url',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:6114',
            'gambar.*' => 'nullable|image|mimes:jpeg,png,jpg|max:6114',
            'fasilitas_id' => 'required|array',
            'fasilitas_id.*' => 'exists:fasilitas,id',
            'label_id' => 'required|array',
            'label_id.*' => 'exists:label,id',
            'hargamenu_id' => 'required|exists:hargamenu,id',
            'kapasitasruang_id' => 'required|exists:kapasitasruang,id',
            'tempatparkir_id' => 'required|exists:tempatparkir,id',
            'jambuka_id' => 'required|exists:jambuka,id',
        ]);

        $cafe = Cafe::findOrFail($id);

        $gambarPaths = json_decode($cafe->gambar) ?? [];
        if ($request->hasFile('gambar')) {
            foreach ($request->file('gambar') as $image) {
                $gambarPaths[] = $image->store('gambar_cafe', 'public');
            }
        }

        $updateData = [
            'nama_cafe' => $request->nama_cafe,
            'alamat' => $request->alamat,
            'alamat_url' => $request->alamat_url ?? null,
            'keterangan_motor' => $request->keterangan_motor,
            'keterangan_mobil' => $request->keterangan_mobil,
            'keterangan_mushola' => $request->keterangan_mushola,
            'keterangan_toilet' => $request->keterangan_toilet,
            'instagram_url' => $request->instagram_url ?? null,
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
        $cafe->labels()->sync($request->label_id);

        return redirect()->route('cafe.index')->with('success', 'Cafe berhasil diperbarui');
    }

    public function destroy($id)
    {
        $cafe = Cafe::findOrFail($id);
        $cafe->delete();

        return redirect()->route('cafe.index')->with('success', 'Cafe berhasil dihapus');
    }

    public function komentar($id)
    {
        $cafe = Cafe::with('komentar')->findOrFail($id);

        return view('komentar.index', compact('cafe'));
    }

}
