<?php

namespace App\Http\Controllers;

use App\Models\Cafe;
use App\Models\Jambuka;
use App\Models\Fasilitas;
use App\Models\HargaMenu;
use App\Models\TempatParkir;
use App\Models\KapasitasRuang;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Halaman utama
    public function index()
    {
        $cafes = Cafe::with(['fasilitas', 'hargamenu', 'kapasitasruang', 'tempatparkir', 'jambuka'])->get();

        return view('index', [
            'cafes' => $cafes,
            'hargamenu' => HargaMenu::all(),
            'kapasitasruang' => KapasitasRuang::all(),
            'fasilitas' => Fasilitas::all(),
            'tempatParkir' => TempatParkir::all()
        ]);
    }

    public function search(Request $request)
    {
        $query = Cafe::with(['fasilitas', 'hargamenu', 'kapasitasruang', 'tempatparkir', 'jambuka']);

        // Filter berdasarkan nama_cafe
       if ($request->filled('search')) {
        $query->where('nama_cafe', 'like', '%' . $request->search . '%');
    }
        // Filter berdasarkan fasilitas
        if ($request->has('fasilitas') && is_array($request->fasilitas)) {
            $query->whereHas('fasilitas', function ($q) use ($request) {
                $q->whereIn('fasilitas.id', $request->fasilitas);
            });
        }

        // Filter berdasarkan harga_menu
        if ($request->filled('harga_menu')) {
            $query->where('hargamenu_id', $request->harga_menu);
        }

        // Filter berdasarkan kapasitas_ruang
        if ($request->filled('kapasitas_ruang')) {
            $query->where('kapasitasruang_id', $request->kapasitas_ruang);
        }

        // Filter berdasarkan tempat_parkir
        if ($request->filled('tempat_parkir')) {
            $query->where('tempatparkir_id', $request->tempat_parkir);
        }

        // Filter berdasarkan jam_buka
        if ($request->filled('jam_buka')) {
        $query->whereHas('jambuka', function($q) use ($request) {
            $q->where('waktu_buka', $request->jam_buka === '24_jam' ? '24' : $request->jam_buka);
        });
    }

        $cafes = $query->get();

        return view('index', [
            'cafes' => $cafes,
            'hargamenu' => HargaMenu::all(),
            'kapasitasruang' => KapasitasRuang::all(),
            'fasilitas' => Fasilitas::all(),
            'tempatParkir' => TempatParkir::all()
        ]);
    }


    // Hasil rekomendasi SAW
  public function hasil(Request $request)
{
    $input = $request->only([
        'harga_menu',
        'kapasitas_ruang',
        'tempat_parkir',
        'fasilitas',
        'jam'
    ]);

    $cafes = Cafe::with(['hargamenu', 'kapasitasruang', 'tempatparkir', 'jambuka', 'fasilitas'])->get();

    $bobot = [
        'harga_menu'      => 0.28, // Cost
        'kapasitas_ruang' => 0.12,
        'ac'              => 0.14,
        'tempat_ibadah'   => 0.20,
        'toilet'          => 0.14,
        'ruang_rapat'     => 0.10,
        'tempat_parkir'   => 0.02,
    ];

    $cafes = $cafes->map(function ($cafe) use ($bobot) {
        // Harga Menu (Cost)
        $harga = intval($cafe->hargamenu->harga_menu);
        $nilaiHarga = 1;
        if ($harga <= 10000) {
            $nilaiHarga = 5;
        } elseif ($harga <= 20000) {
            $nilaiHarga = 3;
        }

        // Kapasitas Ruang
        $kapasitas = intval($cafe->kapasitasruang->kapasitas_ruang);
        $nilaiKapasitas = 1;
        if ($kapasitas > 50) {
            $nilaiKapasitas = 5;
        } elseif ($kapasitas >= 20) {
            $nilaiKapasitas = 3;
        }

        // Fasilitas
        $fasilitasId = $cafe->fasilitas->pluck('nama_fasilitas')->map(fn($f) => strtolower($f))->toArray();

        $nilaiAc           = in_array('ac', $fasilitasId) ? 5 : 3;
        $nilaiTempatIbadah = in_array('tempat ibadah', $fasilitasId) ? 5 : 3;
        $nilaiToilet       = in_array('toilet', $fasilitasId) ? 5 : 3;
        $nilaiRuangRapat   = in_array('ruang rapat', $fasilitasId) ? 5 : 3;

        // Tempat Parkir
        $parkir = strtolower($cafe->tempatparkir->tempat_parkir ?? '');
        $nilaiParkir = ($parkir === 'luas (motor & mobil)') ? 5 : 3;

        // Skor SAW
        $score =
            ($nilaiHarga / 5) * $bobot['harga_menu'] +
            ($nilaiKapasitas / 5) * $bobot['kapasitas_ruang'] +
            ($nilaiAc / 5) * $bobot['ac'] +
            ($nilaiTempatIbadah / 5) * $bobot['tempat_ibadah'] +
            ($nilaiToilet / 5) * $bobot['toilet'] +
            ($nilaiRuangRapat / 5) * $bobot['ruang_rapat'] +
            ($nilaiParkir / 5) * $bobot['tempat_parkir'];

        $cafe->score = round($score, 4);
        return $cafe;
    })->sortByDesc('score')->values();

    // Filter jam buka pakai waktu_buka
    if (!empty($input['jam'])) {
        $cafes = $cafes->filter(function ($cafe) use ($input) {
            return strtolower($cafe->jambuka->waktu_buka) === strtolower($input['jam']);
        })->values();
    }

    // Filter fasilitas tambahan
    if (!empty($input['fasilitas'])) {
        $fasilitasInput = $input['fasilitas'];
        $cafes = $cafes->filter(function ($cafe) use ($fasilitasInput) {
            $cafeFasilitas = $cafe->fasilitas->pluck('id')->toArray();
            return count(array_intersect($fasilitasInput, $cafeFasilitas)) === count($fasilitasInput);
        })->values();
    }

    return view('index', [
        'cafes' => $cafes,
        'jamBukaOptions' => Jambuka::all(),
        'kriteria' => $input,
        'request' => $request
    ]);
}



    // Detail cafe
    public function cafe($id)
    {
        $cafe = Cafe::with(['hargamenu', 'kapasitasruang', 'tempatparkir', 'jambuka', 'fasilitas'])->findOrFail($id);
        return view('detailcafe', compact('cafe'));
    }
}
