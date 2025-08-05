<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    use HasFactory;

    protected $table = 'enquires';

  protected $fillable = [
    'first_name',
    'last_name',
    'email',
    'contact',
    'designation',
    'company_name',
    'country',
    'industry',
    'message',
];

}
