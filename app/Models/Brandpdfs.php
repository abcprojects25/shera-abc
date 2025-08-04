<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brandpdfs extends Model
{
    use HasFactory;

    public function brands()
    {
        return $this->belongsTo('App\Models\Brands');
    }
}
