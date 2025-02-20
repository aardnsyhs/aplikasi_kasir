<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class StokController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stok = Produk::paginate(10);
        return view('stok.index', compact('stok'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Produk $stok)
    {
        return view('stok.show', compact('stok'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produk $stok)
    {
        return view('stok.edit', compact('stok'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produk $stok)
    {
        $request->validate([
            'tambah_stok' => 'required|integer|min:1',
        ]);

        $stok->update(['stok' => $stok->stok + $request->tambah_stok]);

        return redirect()->route('stok.index')->with('success', 'Stok berhasil ditambahkan!');
    }

    public function search(Request $request)
    {
        $q = $request->input('search');

        $stok = Produk::where('nama_produk', 'like', '%' . $q . '%')
            ->paginate(10);

        return view('stok.index', compact('stok', 'q'));
    }

}
