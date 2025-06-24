<?php

namespace App\Http\Controllers;

use App\Models\Label;
use Illuminate\Http\Request;

class LabelController extends Controller
{
    public function index()
    {
        $labels = Label::all();
        return view('label.index', compact('labels'));
    }

    public function create()
    {
        return view('label.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_label' => 'required|string|max:255|unique:label,nama_label',
        ]);

        Label::create([
            'nama_label' => $request->nama_label,
        ]);

        return redirect()->route('label.index')->with('success', 'Label berhasil ditambahkan');
    }

    public function edit(Label $label)
    {
        return view('label.edit', ['label' => $label]);
    }

    public function update(Request $request, Label $label)
    {
        $request->validate([
            'nama_label' => 'required|string|max:255|unique:label,nama_label,' . $label->id,
        ]);
        
        $label->update([
            'nama_label' => $request->nama_label,
        ]);

        return redirect()->route('label.index')->with('success', 'Label berhasil diperbarui');
    }

    public function destroy(Label $label)
    {
        $label->delete();

        return redirect()->route('label.index')->with('success', 'Label berhasil dihapus');
    }
}
