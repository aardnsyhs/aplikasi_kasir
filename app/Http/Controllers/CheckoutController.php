<?php

namespace App\Http\Controllers;

use App\Models\DetailPenjualan;
use App\Models\Pelanggan;
use App\Models\Penjualan;
use App\Models\Produk;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong!');
        }

        return view('checkout.index', compact('cart'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'jenis_pelanggan' => 'required|in:bukan_member,member_baru,member',
            'nama_pelanggan' => [
                'nullable',
                'required_if:jenis_pelanggan,member_baru,member',
                'string',
                'max:255',
                function ($attribute, $value, $fail) use ($request) {
                    if ($request->jenis_pelanggan === 'member' && !Pelanggan::where('nama_pelanggan', $value)->exists()) {
                        $fail('Nama pelanggan tidak ditemukan.');
                    }
                }
            ],
            'alamat' => 'nullable|required_if:jenis_pelanggan,member_baru|string',
            'nomor_telepon' => 'nullable|required_if:jenis_pelanggan,member_baru|string|regex:/^08[0-9]{8,11}$/',
            'produk' => 'required|array',
            'produk.*.produk_id' => 'required|exists:produk,id',
            'produk.*.quantity' => 'required|integer|min:1',
            'produk.*.harga' => 'required|numeric|min:0',
            'nominal_bayar' => 'required|numeric|min:0'
        ]);

        $totalHarga = collect($validated['produk'])->sum(fn($item) => $item['harga'] * $item['quantity']);
        $nominalBayar = $validated['nominal_bayar'];
        $kembalian = $nominalBayar - $totalHarga;

        if ($kembalian < 0) {
            return back()->withErrors(['nominal_bayar' => 'Jumlah yang dibayarkan kurang dari total harga!']);
        }

        $pelangganId = null;

        DB::beginTransaction();
        try {
            if ($validated['jenis_pelanggan'] === 'member_baru') {
                $pelanggan = Pelanggan::create([
                    'nama_pelanggan' => $validated['nama_pelanggan'],
                    'alamat' => $validated['alamat'],
                    'nomor_telepon' => $validated['nomor_telepon'],
                    'jenis_pelanggan' => 'member_baru',
                ]);
                $pelangganId = $pelanggan->id;
            } elseif ($validated['jenis_pelanggan'] === 'member') {
                $pelanggan = Pelanggan::where('nama_pelanggan', $validated['nama_pelanggan'])->first();
                if (!$pelanggan) {
                    return back()->withErrors(['nama_pelanggan' => 'Nama pelanggan tidak ditemukan!']);
                }

                $pelanggan->update([
                    'jenis_pelanggan' => 'member',
                ]);

                $pelangganId = $pelanggan->id;
            }

            $penjualan = Penjualan::create([
                'tanggal_penjualan' => Carbon::now(),
                'total_harga' => $totalHarga,
                'nominal_bayar' => $nominalBayar,
                'kembalian' => $kembalian,
                'user_id' => auth()->user()->id,
                'pelanggan_id' => $pelangganId,
            ]);

            foreach ($validated['produk'] as $produk) {
                $produkModel = Produk::find($produk['produk_id']);

                if ($produkModel->stok < $produk['quantity']) {
                    DB::rollBack();
                    return redirect()->route('cart.index')->with('error', 'Stok produk ' . $produkModel->nama_produk . ' tidak mencukupi!');
                }

                DetailPenjualan::create([
                    'penjualan_id' => $penjualan->id,
                    'produk_id' => $produk['produk_id'],
                    'nama_produk' => $produkModel->nama_produk,
                    'jumlah_produk' => $produk['quantity'],
                    'subtotal' => $produk['quantity'] * $produk['harga'],
                ]);

                $produkModel->decrement('stok', $produk['quantity']);
            }

            DB::commit();

            session()->forget('cart');

            return redirect()->route('checkout.success', ['id' => $penjualan->id])
                ->with('success', 'Transaksi berhasil disimpan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Terjadi kesalahan saat memproses transaksi!']);
        }
    }

    public function show($id)
    {
        $kasir = Penjualan::with('petugas')->findOrFail($id);
        $penjualan = Penjualan::with(['pelanggan', 'detailPenjualan.produk'])->findOrFail($id);
        return view('checkout.success', compact('penjualan', 'kasir'));
    }

    public function cekMember(Request $request)
    {
        try {
            $namaPelanggan = $request->query('nama_pelanggan');

            if (!$namaPelanggan) {
                return response()->json(['error' => 'Nama pelanggan diperlukan'], 400);
            }

            $members = Pelanggan::where('nama_pelanggan', 'LIKE', "%{$namaPelanggan}%")
                ->select('id', 'nama_pelanggan as nama', 'alamat', 'nomor_telepon')
                ->get();

            if ($members->isEmpty()) {
                return response()->json([], 200);
            }

            return response()->json($members);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan pada server'], 500);
        }
    }
}
