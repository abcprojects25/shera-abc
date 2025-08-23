<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categories;

class CategoryApplication extends Model
{
    use HasFactory;
    protected $table = 'category_applications';
    protected $fillable = ['category_id', 'name', 'alt_text', 'image', 'icon', 'desc', 'status'];

    public function category()
{
    return $this->belongsTo(Categories::class, 'category_id');
}

}
