<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class AdminNotification extends Model
{
    protected $table = 'notifications_admin';

    protected $fillable = [
        'title',
        'body',
        'send_at',
    ];
}
