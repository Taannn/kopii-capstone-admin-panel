<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        // $products = Product::latest()->paginate(5);
        $products = Product::with('category')->paginate(5);
        return view('products.index', compact('products'));
    }
}
