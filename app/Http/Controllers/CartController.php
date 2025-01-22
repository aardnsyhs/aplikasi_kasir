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
                $item['quantity'] = isset($item['quantity']) ? $item['quantity'] + 1 : 2;
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

        return response()->json(['message' => 'Produk berhasil ditambahkan ke keranjang!']);
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
