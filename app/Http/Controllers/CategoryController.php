<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->paginate(4);
        $trashes = Category::onlyTrashed()->latest()->paginate(2);
        return view('categories.index', compact('categories', 'trashes'));
    }

    public function edit($id)
    {
        $categories = Category::latest()->paginate(4);
        $trashes = Category::onlyTrashed()->latest()->paginate(2);
        $toBeEdited = Category::findOrFail($id);
        $editing = true;
        return view('categories.index', compact('toBeEdited', 'editing', 'categories', 'trashes'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'category_name' => 'required|min:3|max:40'
        ]);

        $category = Category::findOrFail($id);
        $category->update($validated);
        $toBeEdited = null;
        $editing = null;
        return redirect()->route('categories.index')->with('success', 'Category updated successfully!');
    }

    public function cancel() {
        $toBeEdited = null;
        $editing = null;
        return redirect()->route('categories.index');
    }


    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|min:3|max:40|unique:category',
        ]);

        Category::create([
            'category_name' => $request->category_name,
        ]);
        return redirect()->back()->with('success', 'Category added successfully.');
    }

    public function softDelete($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Successfully moved to trash!');
    }

    public function restore($id)
    {
        $category = Category::withTrashed()->find($id)->restore();
        return redirect()->route('categories.index')->with('success', 'Category successfully restored!');
    }

    public function forceDelete($id)
    {
        $category = Category::withTrashed()->find($id)->forceDelete();
        return redirect()->route('categories.index')->with('success', 'Category permanently deleted!');
    }
}
