<?php 

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class CategoryImage extends Model
{
    protected $fillable = ['category_id', 'image_path', 'alt', 'status'];
}
