<?php

namespace App\Http\Controllers;

use App\Models\hargamenu;
use Illuminate\Http\Request;

class HargamenuController extends Controller
{
    public function index()
    {
        $hargamenu = hargamenu::all();
        return view('harga_menu.index', compact('hargamenu'));
    }

    public function create()
    {
        return view('harga_menu.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'harga_menu' => 'required|string|max:255',
        ]);

        hargamenu::create([
            'harga_menu' => $request->harga_menu,
        ]);

        return redirect()->route('harga_menu.index')->with('success', 'Harga menu berhasil ditambahkan');
    }

    public function edit(hargamenu $harga_menu)
    {
        return view('harga_menu.edit', ['hargamenu' => $harga_menu]);
    }

    public function update(Request $request, hargamenu $harga_menu)
    {
        $request->validate([
            'harga_menu' => 'required|string|max:255',
        ]);

        $harga_menu->update([
            'harga_menu' => $request->harga_menu,
        ]);

        return redirect()->route('harga_menu.index')->with('success', 'Harga menu berhasil diperbarui');
    }

    public function destroy(hargamenu $harga_menu)
    {
        $harga_menu->delete();

        return redirect()->route('harga_menu.index')->with('success', 'Harga menu berhasil dihapus');
    }
}
