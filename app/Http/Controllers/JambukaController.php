<?php

namespace App\Http\Controllers;

use App\Models\jambuka;
use Illuminate\Http\Request;

class JambukaController extends Controller
{
    public function index()
    {
        $jambuka = jambuka::all();
        return view('jam_buka.index', compact('jambuka'));
    }

    public function create()
    {
        return view('jam_buka.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jam_buka' => 'required|string|max:255',
            'waktu_buka' => 'required|in:pagi,siang,sore,24',
        ]);

        jambuka::create([
            'jam_buka' => $request->jam_buka,
            'waktu_buka' => $request->waktu_buka,
        ]);

        return redirect()->route('jam_buka.index')->with('success', 'Jam buka berhasil ditambahkan');
    }

    public function edit(jambuka $jam_buka)
    {
        return view('jam_buka.edit', ['jambuka' => $jam_buka]);
    }

    public function update(Request $request, jambuka $jam_buka)
    {
        $request->validate([
            'jam_buka' => 'required|string|max:255',
            'waktu_buka' => 'required|in:pagi,siang,sore,24',
        ]);

        $jam_buka->update([
            'jam_buka' => $request->jam_buka,
            'waktu_buka' => $request->waktu_buka,
        ]);

        return redirect()->route('jam_buka.index')->with('success', 'Jam buka berhasil diperbarui');
    }

    public function destroy(jambuka $jam_buka)
    {
        $jam_buka->delete();

        return redirect()->route('jam_buka.index')->with('success', 'Jam buka berhasil dihapus');
    }
}
