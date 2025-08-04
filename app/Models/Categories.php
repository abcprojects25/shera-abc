<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\admin\Categories_lookups;

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

    

}
