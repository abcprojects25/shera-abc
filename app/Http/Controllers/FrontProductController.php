<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\admin\Categories_lookups;
use App\Models\Categories;
use App\Models\admin\Products;
use Illuminate\Support\Facades\DB;

class FrontProductController extends Controller
{
    //

     public function ViewProductDetails($product_url) {
    $product = Products::where('product_url', $product_url)->firstOrFail();
    return view('frontend.products.view', compact('product'));
}

      public function viewProductsCategory($slug, $subctg = null)
{
    $category = Categories::with('subCategories.subCategories')->where('seourl', $slug)->firstOrFail();
    // print_r($category-);
    // exit;
    $associatedCategories = $category->subCategories;

    $selectedAssociatedCategory = null;
    $subcategories = collect();
	$childCategories= $subcategories;
    $products = collect();

    if ($associatedCategories->isEmpty()) {
        // No subcategories: fetch products from main category
        $products = Products::where('category_id', $category->id)->get();
		 return view('frontend.products.product_listing', compact('products', 'category', 'childCategories'));
    } else {
        // Match associated subcategory by seourl instead of ID
        if ($subctg) {
            $selectedAssociatedCategory = $associatedCategories->firstWhere('seourl', $subctg);
            if (!$selectedAssociatedCategory) {
                $selectedAssociatedCategory = $associatedCategories->first();
            }
        } else {
            $selectedAssociatedCategory = $associatedCategories->first();
        }

        // Get sub-subcategories of selected associated category
        $subcategories = $selectedAssociatedCategory ? $selectedAssociatedCategory->subCategories : collect();
  
         // print_r($subcategories);
    // exit;

        if ($subcategories->isEmpty()) {
            // No sub-subcategories → show products of selected associated category
            $products = Products::where('category_id', $selectedAssociatedCategory->id)->get();
			 return view('frontend.products.product_listing', compact('products', 'category', 'childCategories'));
        }
    }

    return view('frontend.products.categories', compact(
        'category',
        'associatedCategories',
        'selectedAssociatedCategory',
        'subcategories',
        'products',
        'subctg'
    ));
}


public function productListing($seourl=null,$subctg=null,$slug=null)
{
    // Step 1: Retrieve the current category using the provided slug
    $category = Categories::where('seourl', $slug)->firstOrFail();

    // Step 2: Attempt to fetch products directly linked to this category
    $products = Products::where('category_id', $category->id)
                        ->where('is_deleted', 0)
                        ->where('status', 1)
                        ->get();

    // Step 3: Initialize a collection for child categories
    $childCategories = collect();

    // Step 4: If there are no products, check for direct child categories
    if ($products->isEmpty()) {
        $childCategoryIds = DB::table('categories_lookups')
            ->where('category_id', $category->id)
            ->pluck('categry_lookup');

        if ($childCategoryIds->isNotEmpty()) {
            $childCategories = Categories::whereIn('id', $childCategoryIds)->get();
        }

        // Step 5: If no child categories, try one level up (get parent category)
        if ($childCategoryIds->isEmpty()) {
            // Get the parent category of current category
            $parentCategoryId = DB::table('categories_lookups')
                ->where('categry_lookup', $category->id)
                ->value('category_id');

            if ($parentCategoryId) {
                $parentCategory = Categories::find($parentCategoryId);

                // Fetch products from the parent category
                $products = Products::where('category_id', $parentCategoryId)
                                    ->where('is_deleted', 0)
                                    ->where('status', 1)
                                    ->get();

                // Optionally, assign parent category to `$category` if you want to update heading/content
                // $category = $parentCategory;
            }
        }
    }

    return view('frontend.products.product_listing', compact('products', 'category', 'childCategories'));
}


public function autocomplete(Request $request)
{
    $search = $request->get('query');
    if (strlen($search) < 2) {
        return response()->json([]);
    }

    $products = Products::where('title', 'like', '%' . $search . '%')
        ->take(10)
        ->get(['title', 'product_url']);

    return response()->json($products);
}



}
