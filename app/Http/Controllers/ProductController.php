<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function chooseService()
    {
        // Ambil semua produk beserta surat-surat yang terkait
        $products = Product::with('letters')->get();

        // Kirim data produk ke view
        return view('forms.choose_service', compact('products'));
    }
}
