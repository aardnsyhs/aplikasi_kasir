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
            'nama_pelanggan' => 'nullable|required_if:jenis_pelanggan,member_baru|string|max:255',
            'alamat' => 'nullable|required_if:jenis_pelanggan,member_baru|string',
            'nomor_telepon' => 'nullable|required_if:jenis_pelanggan,member_baru|string|regex:/^08[0-9]{8,11}$/',
            'username_member' => 'nullable|required_if:jenis_pelanggan,member|string|exists:pelanggan,username',
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

        if ($validated['jenis_pelanggan'] === 'member_baru') {
            $pelanggan = Pelanggan::create([
                'nama_pelanggan' => $validated['nama_pelanggan'],
                'alamat' => $validated['alamat'],
                'nomor_telepon' => $validated['nomor_telepon'],
                'username' => Str::slug($validated['nama_pelanggan']),
            ]);
            $pelangganId = $pelanggan->id;
        } elseif ($validated['jenis_pelanggan'] === 'member') {
            $pelanggan = Pelanggan::where('username', $validated['username_member'])->first();
            if (!$pelanggan) {
                return back()->withErrors(['username_member' => 'Username pelanggan tidak ditemukan!']);
            }
            $pelangganId = $pelanggan->id;
        }

        DB::beginTransaction();
        try {
            $penjualanData = [
                'tanggal_penjualan' => Carbon::now(),
                'total_harga' => $totalHarga,
                'nominal_bayar' => $nominalBayar,
                'kembalian' => $kembalian,
                'user_id' => auth()->user()->id,
            ];

            if ($pelangganId) {
                $penjualanData['pelanggan_id'] = $pelangganId;
            }

            $penjualan = Penjualan::create($penjualanData);

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

            return redirect()->route('checkout.success', ['id' => $penjualan->id]);
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
        $username = $request->query('username');

        if (!$username) {
            return response()->json(['found' => false, 'message' => 'Username tidak boleh kosong.'], 400);
        }

        $member = Pelanggan::where('username', $username)->first();

        if ($member) {
            return response()->json([
                'found' => true,
                'nama' => $member->nama_pelanggan,
                'alamat' => $member->alamat,
                'nomor_telepon' => $member->nomor_telepon
            ]);
        }

        return response()->json(['found' => false, 'message' => 'Member tidak ditemukan.']);
    }
}
