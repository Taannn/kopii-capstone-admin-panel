<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        // $products = Product::latest()->paginate(5);
        $products = Product::latest()->with('category')->paginate(5);
        return view('products.index', compact('products'));
    }

    public function store(Request $request)
    {
        $request['product_stock'] = (int) $request['product_stock'];
        // $request['product_discount'] = (int) $request['product_discount'];
        $request['product_price'] = floatval($request['product_price']);

        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'product_desc' => 'required|string',
            'product_img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'product_price' => 'required|numeric|min:0',
            'product_stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:category,category_id'
        ]);
        if ($request->hasFile('product_img')) {
            $image = $request->file('product_img');
            $imagePath = $image->store('public/images');
            $imageUrl = Storage::url($imagePath);
            // $imageUrl = 'https://kopii.com/' . Storage::url($imagePath);
            // change it to this when project is hosted to match the previous products added and to not need adding prefix on react
            $validated['product_img'] = $imageUrl;
        }
        $image = Product::create($validated);
        return redirect()->route('products.index')->with('success', 'Product successfully added!');
    }
}
