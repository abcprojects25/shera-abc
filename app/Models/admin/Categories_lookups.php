<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories_lookups extends Model
{
    use HasFactory;
 protected $table = 'categories_lookups';
    protected $primaryKey = 'idl';
    public $timestamps = true;

    protected $fillable = [
        'categry_lookup',
        'category_id',
    ];
}