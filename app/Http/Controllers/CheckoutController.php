<?php

namespace App\Http\Controllers;

use App\Models\DetailPenjualan;
use App\Models\Pelanggan;
use App\Models\Penjualan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index() {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong!');
        }

        return view('checkout.index', compact('cart'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'alamat' => 'required|string',
            'nomor_telepon' => 'required|string|max:15',
            'produk' => 'required|array',
            'produk.*.id' => 'required|exists:produk,id',
            'produk.*.jumlah' => 'required|integer|min:1',
        ]);

        // Simpan data pelanggan
        $pelanggan = new Pelanggan();
        $pelanggan->nama_pelanggan = $validated['nama_pelanggan'];
        $pelanggan->alamat = $validated['alamat'];
        $pelanggan->nomor_telepon = $validated['nomor_telepon'];
        $pelanggan->save();

        // Simpan data penjualan
        $penjualan = new Penjualan();
        $penjualan->tanggal_penjualan = Carbon::now();
        $penjualan->total_harga = collect($validated['produk'])->sum(fn($item) => $item['harga'] * $item['jumlah']);
        $penjualan->pelanggan_id = $pelanggan->id;
        $penjualan->save();

        // Simpan detail penjualan
        foreach ($validated['produk'] as $produk) {
            $detailPenjualan = new DetailPenjualan();
            $detailPenjualan->penjualan_id = $penjualan->id;
            $detailPenjualan->produk_id = $produk['id'];
            $detailPenjualan->jumlah_produk = $produk['jumlah'];
            $detailPenjualan->subtotal = $produk['jumlah'] * $produk['harga'];
            $detailPenjualan->save();
        }

        return response()->json(['message' => 'Pembayaran berhasil dan data tersimpan!'], 200);
    }

}
