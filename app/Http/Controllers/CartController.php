<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index() {
        return view('cart.index');
    }

    public function add(Request $request) {
        $cart = session()->get('cart', []);

        $found = false;
        foreach ($cart as &$item) {
            if ($item['produk_id'] == $request->produk_id) {
                $item['quantity'] += 1;
                $found = true;
                break;
            }
        }

        if (!$found) {
            $cart[] = [
                'produk_id' => $request->produk_id,
                'nama_produk' => $request->nama_produk,
                'harga' => $request->harga,
                'stok' => $request->stok,
                'quantity' => 1,
            ];
        }

        session()->put('cart', $cart);

        $totalItems = array_sum(array_column($cart, 'quantity'));

        return response()->json([
            'message' => 'Produk berhasil ditambahkan ke keranjang!',
            'total_items' => $totalItems,
        ]);
    }

    public function update(Request $request)
    {
        $cart = session()->get('cart', []);

        foreach ($cart as &$item) {
            if ($item['produk_id'] == $request->produk_id) {
                $item['quantity'] = $request->quantity;
                break;
            }
        }

        session()->put('cart', $cart);

        return response()->json([
            'success' => true,
            'message' => 'Jumlah produk berhasil diperbarui!'
        ]);
    }

    public function remove(Request $request)
    {
        $cart = session()->get('cart', []);

        $cart = array_filter($cart, function($item) use ($request) {
            return $item['produk_id'] != $request->produk_id;
        });

        $cart = array_values($cart);

        session()->put('cart', $cart);

        return response()->json(['message' => 'Produk berhasil dihapus dari keranjang!']);
    }
}
