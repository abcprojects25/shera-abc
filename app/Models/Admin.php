<?php

namespace App\Models;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model implements Authenticatable
{
    use AuthenticableTrait;
    use HasFactory;

    protected $guard = 'admins';

    protected $fillable = [
        'name',
        'email',
        'password'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}