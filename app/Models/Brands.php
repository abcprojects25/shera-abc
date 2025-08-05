<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brands extends Model
{
    use HasFactory;


    public function brandimages()
    {
        return $this->hasMany('App\Models\Brandimages');
    }

    public function brandpdfs()
    {
        return $this->hasMany('App\Models\Brandpdfs');
    }
}
