<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;
    protected $fillable = [
        "user_id",
        "order_id",
        "product_id",
        "product_name",
        "quantity",
        "price",
        "month",
        "total_price",
        "option_id",
        "option_value_id", 
        "stock_id", 
        "return_status",
        "return_qty_left",
        "delivery_date",
        "end_date",
    ];

    public function getProduct(){
        return $this->belongsTo(Product::class, 'product_id')->withTrashed();
    }

    public function getOrder(){
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function getRenewalProduct(){
        return $this->hasMany(RenewDetail::class, 'product_id');
    }
 
}
