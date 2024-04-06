<?php

namespace App\Models\Backend;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;
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
        "billing_phone", 
        "shipping_phone", 
        "delivery_type", 
        "delivery_boy_id",
        "payment_method", 
        "tax", 
        "payment_status", 
        "order_status", 
        "status"
    ];

   public function getOrderProduct(){
    return $this->hasMany(OrderProduct::class, 'order_id');
   }

   public function getAllOrders(){
    return $this->belongsTo(User::class, 'user_id');
   }

  
}
