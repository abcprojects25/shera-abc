<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

     protected $fillable = [
        'cart_enquiry_id',
        'product_id',
        'product_name',   // add this
        'product_image',  // add this
        'quantity',
        'requirement',
    ];

    public function enquiry()
    {
        return $this->belongsTo(CartEnquiry::class, 'cart_enquiry_id');
    }
}
