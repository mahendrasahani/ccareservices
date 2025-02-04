<?php

namespace App\Models\Backend;

use App\Models\Frontend\Cart;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stock extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'product_id',
        'option_name',
        'option_value',
        'attribute_id',
        'attribute_value_id',
        'quantity',
        'month',
        'price',
        'price_1',
        'price_2',
        'price_3',
        'price_4',
        'price_5',
        'price_6',
        'price_7',
        'price_8',
        'price_9',
        'price_10',
        'price_11',
        'price_12', 
        'vendor_id',
        'date_of_purchase',
        'purchase_amount',
        'invoice_no',
        'stock_staus',
        'tax_name',
        'tax_rate',
        'status', 
    ];

    protected $casts =[
        'option_value' => 'array',
        // 'quantity' => 'array',
        'month' => 'array',
        'price' => 'array',
        'tax_name' => 'array',
        'tax_rate' => 'array',
    ];

public function getProduct(){
    return $this->belongsTo(Product::class, 'product_id')->withTrashed();
}

// public function getCart(){
//     return $this->hasMany(Cart::class, 'product_id');
// }

public function getCart(){
    return $this->belongsTo(Cart::class, 'stock_id');
}

public function getAttr(){
    return $this->hasOne(Attribute::class, 'id', 'attribute_id');
}

public function getAttrValue(){
    return $this->hasOne(AttributeValue::class, 'id', 'attribute_value_id');
}


}
