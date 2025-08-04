<?php
namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $table = 'banners';

     protected $fillable = [
        'banner_url_id',
        'image',
        'status',
    ];

    public $timestamps = true;

      public function bannerUrl()
    {
        return $this->belongsTo(BannerUrl::class, 'banner_url_id');
    }
}
