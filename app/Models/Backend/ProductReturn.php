<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductReturn extends Model
{
    use HasFactory;
    protected $fillable = [
        "order_id",
        "user_id",
        "attribute_id",
        "attribute_value_id",
        "product_id",
        "stock_id",
        "order_number",
        "date_of_purchase",
        "customer_name",
        "customer_email",
        "customer_phone",
        "product_name",
        "attribute_name",
        "attribute_value_name",
        "quantity",
        "return_reson",
        "comment",
        "return_action", 
    ];
}
 