<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        if ($request->hasFile('product_img')) {
            $image = $request->file('product_img');
            $imagePath = $image->store('public/images');
            $imageUrl = Storage::url($imagePath);
            // $imageUrl = 'https://kopii.com/' . Storage::url($imagePath);
            // change it to this when project is hosted to match the previous products added and to not need adding prefix on react
            $validated['product_img'] = $imageUrl;
        }
        $image = Image::create($validated);
        return redirect()->route('images.index')->with('success', 'Image uploaded successfully!');
    }

    public function index() {
        $images = Image::all();
        return view('products.image', compact('images'));
    }
}
