<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brandimages extends Model
{
    use HasFactory;

    protected $fillable = [
    	'image'
    ];

    public function brands()
    {
        return $this->belongsTo('App\Models\Brands');
    }
}
