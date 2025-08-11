<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\admin\ProductApplication;
use App\Models\admin\ProductImages;
use App\Models\Categories;

class Products extends Model
{   
    use HasFactory;
    protected $table = 'products'; 
    protected $fillable = [
        'product_order',
        'category_id',
        'title',
        'texture',
        'image',
        'thickness',
        'description',
        'profile',
        'colour',
        'size',
        'weight',
        'quantity',
        'application',
        'is_deleted',
        'status'
    ];

    public function applications()
    {
        return $this->hasMany(ProductApplication::class, 'product_id');
    }

    public function productImages()
    {
        return $this->hasMany(ProductImages::class, 'product_id');
    }

    public function category()
{
    return $this->belongsTo(Categories::class, 'category_id');
}


}
