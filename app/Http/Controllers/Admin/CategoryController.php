<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get();
        return view('admin.products.product_categories', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|unique:categories,name']);
        Category::create(['name' => $request->name]);
        return redirect()->back()->with('success', 'Category added successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate(['name' => 'required|string|unique:categories,name,' . $id]);
        $category = Category::findOrFail($id);
    $category->update(['name' => $request->name]);
        return redirect()->back()->with('success', 'Category updated successfully.');
    }

    public function destroy(Request $request, $id)
    {
        $category = Category::findOrFail($id);
    $category->delete();
        return redirect()->back()->with('success', 'Category deleted successfully.');
    }
}

