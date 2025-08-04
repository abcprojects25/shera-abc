<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Media;

class Products extends Model
{   
    use HasFactory;
    protected $table = 'products'; 
    public function media()
{
    return $this->hasMany(Media::class);
}

}
