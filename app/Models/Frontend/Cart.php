<?php

namespace App\Models\Frontend;

use App\Models\Backend\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable =  [
        "user_id",
        "product_id",
        "quantity",
        "delivery_date",
        "option_id",
        "option_value_id",
        "stock_id",
        "month",
        "price",
        "status", 
    ];

    public function getProduct(){
        return $this->belongsTo(Product::class, 'product_id');
    }
}


