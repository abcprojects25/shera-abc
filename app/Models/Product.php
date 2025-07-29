<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Product extends Model
{
    use HasFactory;

    protected $fillable = [ 'category', 'name','description', 'applications'];


    public function images()
{
    return $this->hasMany(ProductImage::class)->orderBy('display_order');

}

}
