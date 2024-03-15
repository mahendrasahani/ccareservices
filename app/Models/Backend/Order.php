<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "order_id",
        "payment_mode",
        "delivery_charge",
        "sub_total",
        "total",
        "delivery_date",
        "shipping_address",
        "billing_address",
        "promo_code",
        "promo_discount",
        "cancel_reason", 
        "billing_name", 
        "shipping_name", 
        "billing_email", 
        "shipping_email", 
        "delivery_type", 
        "payment_method", 
        "tax", 
        "payment_status", 
        "order_status", 
        "status"
    ];

   public function getOrderProduct(){
    return $this->hasMany(OrderProduct::class, 'order_id');
   }

   

  
}
