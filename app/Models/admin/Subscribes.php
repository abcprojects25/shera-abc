<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscribes extends Model
{
    use HasFactory;
     protected $fillable = ['email'];
}
