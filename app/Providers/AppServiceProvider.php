<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }



public function boot(): void
{
    // Step 1: Get categories where category_id = categry_lookup and type = 1
    $parentCategories = DB::table('categories')
        ->where('type', 1)
        ->whereIn('id', function ($query) {
            $query->select('category_id')
                ->from('categories_lookups')
                ->whereColumn('category_id', 'categry_lookup'); // same value in same row
        })
        ->orderBy('name')
        ->get();

    // Step 2: Get children for each parent category (categories whose categry_lookup = parent's category_id)
    $childrenLookups = DB::table('categories_lookups')
        ->whereIn('category_id', $parentCategories->pluck('id'))
        ->whereColumn('category_id', '!=', 'categry_lookup') // children must be different from parent
        ->get();

    // Step 3: Fetch child categories info
    $childCategoryIds = $childrenLookups->pluck('categry_lookup')->unique()->toArray();

    $childCategories = DB::table('categories')
        ->whereIn('id', $childCategoryIds)
        ->get()
        ->keyBy('id');

    // Step 4: Build nested array of parent categories and their children
    $nestedCategories = $parentCategories->map(function ($parent) use ($childrenLookups, $childCategories) {
        $children = $childrenLookups->filter(function ($lookup) use ($parent) {
            return $lookup->category_id == $parent->id;
        })->map(function ($lookup) use ($childCategories) {
            return $childCategories->get($lookup->categry_lookup);
        })->filter(); // remove nulls

        return [
            'category' => $parent,
            'subcategories' => $children->values()
        ];
    });

    View::share('nestedCategories', $nestedCategories);
}





}
