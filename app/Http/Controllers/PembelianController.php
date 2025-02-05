<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class PembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Produk::query();

        if ($request->has('sort_by')) {
            switch ($request->sort_by) {
                case 'termurah':
                    $query->orderBy('harga', 'asc');
                    break;
                case 'termahal':
                    $query->orderBy('harga', 'desc');
                    break;
                case 'terbaru':
                    $query->orderBy('created_at', 'desc');
                    break;
                case 'terlama':
                    $query->orderBy('created_at', 'asc');
                    break;
                default:
                    'Terjadi Error';
                    break;
            }
        }

        $produk = $query->paginate(8);
        return view('pembelian.index', compact('produk'));
    }
}
