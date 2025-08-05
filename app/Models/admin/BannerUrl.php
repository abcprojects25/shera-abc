<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class BannerUrl extends Model
{
    // Define table name
    protected $table = 'banner_urls';

    // Primary key
    protected $primaryKey = 'id';

    // Mass-assignable fields
    protected $fillable = [
        'page_name',
        'page_url',
        'status',
    ];

    // Timestamps are enabled by default; override if not using them
    public $timestamps = true;

      public function bannerUrl()
    {
        return $this->belongsTo(BannerUrl::class, 'banner_url_id');
    }
    
}
