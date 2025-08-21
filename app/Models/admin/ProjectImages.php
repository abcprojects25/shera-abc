<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectImages extends Model
{
    use HasFactory;
    protected $table = 'project_images';
    protected $fillable = ['project_id', 'urls', 'alt', 'status'];
}
