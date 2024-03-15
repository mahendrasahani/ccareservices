<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    ];
}
