<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categories;

class Projects extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id','title','image','url','description','status','city_state_name'
        ];

        public function category()
{
    return $this->belongsTo(Categories::class, 'category_id');
}

}
