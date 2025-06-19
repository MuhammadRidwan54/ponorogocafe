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
        return view('index', [
            'hargamenu' => HargaMenu::all(),
            'kapasitasruang' => KapasitasRuang::all(),
            'fasilitas' => Fasilitas::all(),
            'tempatParkir' => TempatParkir::all()
        ]);
    }

    // Hasil rekomendasi SAW
    public function hasil(Request $request)
    {
        // Ambil input user
        $input = $request->only([
            'harga_menu',
            'kapasitas_ruang',
            'tempat_parkir',
            'fasilitas',
            'jam'
        ]);

        // Ambil data cafe dan relasi
        $cafes = Cafe::with(['hargamenu', 'kapasitasruang', 'tempatparkir', 'jambuka', 'fasilitas'])->get();

        // Bobot SAW
        $bobot = [
            'harga_menu' => 0.25,
            'kapasitas_ruang' => 0.25,
            'tempat_parkir' => 0.25,
            'jam_buka' => 0.25,
        ];

        // Nilai maksimum per kriteria
        $max = [
            'harga_menu' => $cafes->max(fn($c) => $c->hargamenu->nilai ?? 1),
            'kapasitas_ruang' => $cafes->max(fn($c) => $c->kapasitasruang->nilai ?? 1),
            'tempat_parkir' => $cafes->max(fn($c) => $c->tempatparkir->nilai ?? 1),
            'jam_buka' => $cafes->max(fn($c) => $c->jambuka->nilai ?? 1),
        ];

        // Hitung skor SAW
        $cafes = $cafes->map(function ($cafe) use ($bobot, $max) {
            $score = 0;
            $score += (($cafe->hargamenu->nilai ?? 0) / ($max['harga_menu'] ?: 1)) * $bobot['harga_menu'];
            $score += (($cafe->kapasitasruang->nilai ?? 0) / ($max['kapasitas_ruang'] ?: 1)) * $bobot['kapasitas_ruang'];
            $score += (($cafe->tempatparkir->nilai ?? 0) / ($max['tempat_parkir'] ?: 1)) * $bobot['tempat_parkir'];
            $score += (($cafe->jambuka->nilai ?? 0) / ($max['jam_buka'] ?: 1)) * $bobot['jam_buka'];
            $cafe->score = round($score, 4);
            return $cafe;
        })->sortByDesc('score')->values();

        // Filter berdasarkan jam buka
        if (!empty($input['jam'])) {
            $cafes = $cafes->filter(function ($cafe) use ($input) {
                $jamBuka = $cafe->jambuka->jam_buka ?? '00:00';
                $jamAwal = intval(substr($jamBuka, 0, 2));

                return match ($input['jam']) {
                    'pagi' => $jamAwal >= 7 && $jamAwal <= 11,
                    'siang' => $jamAwal >= 12 && $jamAwal <= 15,
                    'sore' => $jamAwal >= 16 && $jamAwal <= 18,
                    '24' => str_contains(strtolower($jamBuka), '24'),
                    default => true,
                };
            })->values();
        }

        // Filter berdasarkan fasilitas
        if (!empty($input['fasilitas'])) {
            $fasilitasInput = $input['fasilitas'];
            $cafes = $cafes->filter(function ($cafe) use ($fasilitasInput) {
                $cafeFasilitas = $cafe->fasilitas->pluck('id')->toArray();
                return count(array_intersect($fasilitasInput, $cafeFasilitas)) === count($fasilitasInput);
            })->values();
        }

        return view('hasil', [
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
