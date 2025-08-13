<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\admin\Categories_lookups;
use App\Models\admin\CategoryApplication;
use App\Models\admin\CategoryImage;
use App\Models\admin\Products;
use App\Models\Blogs;

class Categories extends Model
{
    use HasFactory;


 protected $table = 'categories';

    public function subCategories()
    {
        return $this->hasManyThrough(
            Categories::class,
            Categories_lookups::class,
            'category_id',       // FK on lookups: parent category
            'id',                // FK on categories (sub category)
            'id',                // local key on this model (parent)
            'categry_lookup'     // subcategory ID in lookup table
        )->whereColumn('categories_lookups.category_id', '!=', 'categories_lookups.categry_lookup');
    }

    public function applications()
    {
        return $this->hasMany(CategoryApplication::class, 'category_id');
    }

    public function categoryImages()
    {
        return $this->hasMany(CategoryImage::class, 'category_id');
    }

    public function products()
{
    return $this->hasMany(Products::class, 'category_id'); 
}

public function blogs()
{
    return $this->hasMany(Blogs::class, 'category_id')
        ->where('is_deleted', 0)
        ->where('is_published', 1)
        ->orderBy('blog_order', 'desc');
}


}
