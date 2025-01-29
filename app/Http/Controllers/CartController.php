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
                'gambar' => $request->gambar,
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
        $newQuantity = 1;
        $newTotal = 0;

        foreach ($cart as &$item) {
            if ($item['produk_id'] == $request->produk_id) {
                if ($request->action == 'increment') {
                    $item['quantity'] += 1;
                } elseif ($request->action == 'decrement' && $item['quantity'] > 1) {
                    $item['quantity'] -= 1;
                }
                $newQuantity = $item['quantity'];
                $newTotal = number_format($item['harga'] * $item['quantity'], 2, ',', '.');
                break;
            }
        }

        session()->put('cart', $cart);

        $totalHarga = collect($cart)->sum(function ($item) {
            return $item['harga'] * $item['quantity'];
        });

        return response()->json([
            'success' => true,
            'new_quantity' => $newQuantity,
            'new_total' => $newTotal,
            'total_harga' => number_format($totalHarga, 2, ',', '.')
        ]);
    }

    public function remove(Request $request)
    {
        $cart = session()->get('cart', []);

        $cart = array_filter($cart, function ($item) use ($request) {
            return $item['produk_id'] != $request->produk_id;
        });

        session()->put('cart', array_values($cart));

        return response()->json(['success' => true]);
    }
}
