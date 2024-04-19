<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function products()
    {
        $products = Product::where('ordered_from', 'Kopii Shop')->get();
        return response()->json($products);
    }
    public function index()
    {
        // $products = Product::latest()->paginate(5);
        $products = Product::latest()->with('category')->paginate(4);
        $trashes = Product::onlyTrashed()->latest('deleted_at')->paginate(2);
        $adding = false;
        $editing = false;
        $addingDiscount = false;
        return view('products.index', compact('products', 'trashes', 'adding', 'editing', 'addingDiscount'));
    }

    public function edit($id)
    {
        $products = Product::latest()->paginate(4);
        $trashes = Product::onlyTrashed()->latest('deleted_at')->paginate(2);
        $toBeEdited = Product::findOrFail($id);
        $editing = true;
        $adding = false;
        return view('products.index', compact('toBeEdited', 'editing', 'products', 'trashes', 'adding'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'product_desc' => 'required|string',
            'product_img' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'product_price' => 'required|min:1',
            'product_stock' => 'required|min:1',
            'category_id' => 'required|exists:category,category_id'
        ]);
        $validated['product_stock'] = (int) $validated['product_stock'];
        $validated['product_price'] = floatval($validated['product_price']);

        $product = Product::findOrFail($id);
        $product->update($validated);

        if ($request->hasFile('product_img')) {
            $image = $request->file('product_img');
            $imagePath = $image->store('public/images');
            $imageUrl = Storage::url($imagePath);
            $product->product_img = $imageUrl;
            $product->save();
        }

        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'product_desc' => 'required|string',
            'product_img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'product_price' => 'required|min:1',
            'product_stock' => 'required|min:1',
            'category_id' => 'required|exists:category,category_id'
        ]);
        $request['product_stock'] = (int) $request['product_stock'];
        // $request['product_discount'] = (int) $request['product_discount'];
        $request['product_price'] = floatval($request['product_price']);
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

    public function add()
    {
        $products = Product::latest()->with('category')->paginate(4);
        $trashes = Product::onlyTrashed()->latest('deleted_at')->paginate(2);
        $adding = true;
        $editing = false;

        return view('products.index', compact('products', 'adding', 'trashes', 'editing'));
    }

    public function softDelete($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product moved to trash!');
    }

    public function restore($id)
    {
        $product = Product::withTrashed()->find($id)->restore();
        return redirect()->route('products.index')->with('success', 'Product successfully restored!');
    }

    public function forceDelete($id)
    {
        $product = Product::withTrashed()->find($id)->forceDelete();
        return redirect()->route('products.index')->with('success', 'Product permanently deleted!');
    }

    public function discountSelected($id)
    {
        $products = Product::latest()->paginate(4);
        $trashes = Product::onlyTrashed()->latest()->paginate(2);
        $discounted = Product::findOrFail($id);
        $adding = false;
        $editing = false;
        $addingDiscount = true;
        return view('products.index', compact('addingDiscount', 'products', 'trashes', 'discounted', 'editing', 'adding'));
    }

    public function discountApply(Request $request, $id)
    {
        $validated = $request->validate([
            'discount' => 'required|min:1|max:3'
        ]);

        $discounted = Product::findOrFail($id);
        $discounted->update($validated);
        $addingDiscount = null;
        return redirect()->route('products.index')->with('success', 'Discount Added!');
    }
    public function discountRemove($id)
    {
        $discounted = Product::findOrFail($id);
        $discounted->update([
            'discount' => null
        ]);
        return redirect()->route('products.index')->with('success', 'Discount has been reset.');
    }

    public function search(Request $request)
    {
        $products = Product::latest()->with('category');
        if ($request->has('search')) {
            $products = $products->where('product_name', 'like', '%' . $request->get('search', '') . '%');
        }
        return view('products.index', [
            'products' => $products->paginate(4),
            'adding' => false,
            'editing' => false,
            'addingDiscount' => false,
        ]);
    }
    public function incrementStockByAmount($id)
    {
        $validated = request()->validate([
            'amount' => 'required|numeric|min:1|max:10',
        ]);

        $product = Product::findOrFail($id);
        $product->increment('product_stock', $validated['amount']);
        return redirect()->back()->with('success', 'Product stock incremented by ' . $validated['amount'] . '.');
    }

    public function decrementStockByAmount($id)
    {
        $validated = request()->validate([
            'amount' => 'required|numeric|min:1|max:10',
        ]);

        $product = Product::findOrFail($id);
        $product->decrement('product_stock', $validated['amount']);
        return redirect()->back()->with('success', 'Product stock decremented by ' . $validated['amount'] . '.');
    }
    public function incrementStock($id)
    {
        $product = Product::findOrFail($id);
        $product->increment('product_stock');
        return redirect()->back()->with('success', 'Product stock incremented by one.');
    }

    public function decrementStock($id)
    {
        $product = Product::findOrFail($id);
        $product->decrement('product_stock');
        return redirect()->back()->with('success', 'Product stock decremented by one.');
    }
}
