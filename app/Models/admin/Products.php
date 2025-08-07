<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

}
