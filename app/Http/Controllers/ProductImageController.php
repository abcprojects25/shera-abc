<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\ProductImages;

class ProductImageController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        foreach ($request->file('images') as $image) {
            \Log::info('Storing image', ['original' => $image->getClientOriginalName()]);

            $path = $image->store('product_images', 'public');

            ProductImages::create([
                'product_id' => $request->product_id,
                'image_path' => $path,
            ]);
        }

        return redirect()->back()->with('success', 'Images uploaded successfully!');
    }
}
