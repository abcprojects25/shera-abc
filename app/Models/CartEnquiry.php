<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartEnquiry extends Model
{
    use HasFactory;

     protected $table = 'cart_enquiry';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
       'client_name',
    'email',
    'contact_no',
    'office_address',
    ];

    /**
     * Relationship: CartEnquiry has many CartItems
     */
    public function cartItems()
    {
        return $this->hasMany(CartItem::class, 'cart_enquiry_id');
    }
}
