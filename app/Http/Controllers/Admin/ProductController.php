<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;

class ProductController extends Controller
{
    public function index(Request $request)
{
    $query = \App\Models\Product::with('images');

    if ($search = $request->input('search')) {
        $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%$search%")
              ->orWhere('description', 'like', "%$search%")
              ->orWhere('category', 'like', "%$search%")
              ->orWhere('applications', 'like', "%$search%");
        });
    }

    $products = $query->latest()->get();

    return view('admin.products.products_lists', compact('products'));
}


    public function create()
    {
        return view('admin.products.add_products');
    }

    public function edit(Product $product)
    {
        $product->load('images');
        return response()->json($product);
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'category' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'applications' => 'nullable|string',
            'new_images.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // Process applications from Tagify JSON format to CSV
        $applications = $this->convertTagifyToCSV($request->applications);

        $product->update([
            'category' => $request->category,
            'name' => $request->name,
            'description' => $request->description,
            'applications' => $applications,
        ]);

        // Reorder images if provided
        if ($request->filled('image_order')) {
            $imageIds = explode(',', $request->image_order);
            foreach ($imageIds as $index => $id) {
                ProductImage::where('id', $id)
                    ->where('product_id', $product->id)
                    ->update(['display_order' => $index]);
            }
        }

        // Upload new images
        if ($request->hasFile('new_images')) {
            foreach ($request->file('new_images') as $imageFile) {
                $path = $imageFile->store('product_images', 'public');
                $maxOrder = ProductImage::where('product_id', $product->id)->max('display_order') ?? 0;

                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $path,
                    'display_order' => $maxOrder + 1,
                ]);
            }
        }

        return redirect('/admin/products/products_lists')->with('success', 'Product updated.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required|string',
            'name' => 'required|string',
            'description' => 'nullable|string|max:10000',
            'applications' => 'nullable|string',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $applications = $this->convertTagifyToCSV($request->applications);

        $product = Product::create([
            'category' => $request->category,
            'name' => $request->name,
            'description' => $request->description,
            'applications' => $applications,
        ]);

        $images = $request->file('images');

        foreach ($images as $index => $image) {
            $filename = time() . '_' . $index . '.' . $image->getClientOriginalExtension();
            $image->storeAs('product_images', $filename, 'public');

            ProductImage::create([
                'product_id' => $product->id,
                'image_path' => 'product_images/' . $filename,
                'display_order' => $index + 1,
            ]);
        }

        return redirect()->back()->with('success', 'Product and images saved!');
    }

    public function reorderImages(Request $request)
    {
        foreach ($request->all() as $imgData) {
            ProductImage::where('id', $imgData['id'])->update(['display_order' => $imgData['order']]);
        }

        return response()->json(['status' => 'Image order updated']);
    }

    /**
     * Convert Tagify JSON to CSV string
     */
    private function convertTagifyToCSV($tagifyJson)
    {
        $csvTags = [];

        $decoded = json_decode($tagifyJson, true);

        if (is_array($decoded)) {
            foreach ($decoded as $item) {
                if (isset($item['value'])) {
                    $csvTags[] = $item['value'];
                }
            }
        }

        return implode(',', $csvTags);
    }

    public function destroy(Product $product)
{
    // Delete images from storage
    foreach ($product->images as $image) {
        if (\Storage::disk('public')->exists($image->image_path)) {
            \Storage::disk('public')->delete($image->image_path);
        }
    }

    // Delete image records
    $product->images()->delete();

    // Delete product
    $product->delete();

    return response()->json(['status' => 'success', 'message' => 'Product deleted successfully.']);
}

}
