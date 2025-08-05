<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cmspages extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id','sub_category_id','page_name','page_title','page_url','contents','meta_keywords','meta_description','is_deleted'
        ];
    
}
