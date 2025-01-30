<?php

namespace App\Http\Controllers;

use App\Models\Produk;

class PembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produk = Produk::paginate(8);
        return view('pembelian.index', compact('produk'));
    }
}
