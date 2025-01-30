<?php

namespace App\Http\Controllers;

use App\Models\DetailPenjualan;
use App\Models\Pelanggan;
use App\Models\Penjualan;
use App\Models\Produk;
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
        $validated = $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'alamat' => 'required|string',
            'nomor_telepon' => 'required|string|max:15',
            'produk' => 'required|array',
            'produk.*.produk_id' => 'required|exists:produk,id',
            'produk.*.quantity' => 'required|integer|min:1',
            'produk.*.harga' => 'required|numeric|min:0',
        ]);

        $pelanggan = Pelanggan::create([
            'nama_pelanggan' => $validated['nama_pelanggan'],
            'alamat' => $validated['alamat'],
            'nomor_telepon' => $validated['nomor_telepon'],
        ]);

        $penjualan = Penjualan::create([
            'tanggal_penjualan' => Carbon::now(),
            'total_harga' => collect($validated['produk'])->sum(fn($item) => $item['harga'] * $item['quantity']),
            'pelanggan_id' => $pelanggan->id,
        ]);

        foreach ($validated['produk'] as $produk) {
            DetailPenjualan::create([
                'penjualan_id' => $penjualan->id,
                'produk_id' => $produk['produk_id'],
                'jumlah_produk' => $produk['quantity'],
                'subtotal' => $produk['quantity'] * $produk['harga'],
            ]);

            $produkModel = Produk::find($produk['produk_id']);
            if ($produkModel->stok >= $produk['quantity']) {
                $produkModel->stok -= $produk['quantity'];
                $produkModel->save();
            } else {
                return redirect()->route('cart.index')->with('error', 'Stok produk ' . $produkModel->nama_produk . ' tidak mencukupi!');
            }
        }

        session()->forget('cart');

        return redirect()->route('checkout.success', ['id' => $penjualan->id]);
    }

    public function show($id) {
        $penjualan = Penjualan::with(['pelanggan', 'detailPenjualan.produk'])->findOrFail($id);
        return view('checkout.success', compact('penjualan'));
    }
}
