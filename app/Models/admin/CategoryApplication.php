<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryApplication extends Model
{
    use HasFactory;
    protected $table = 'category_applications';
    protected $fillable = ['category_id', 'name', 'alt_text', 'image', 'status'];
}
