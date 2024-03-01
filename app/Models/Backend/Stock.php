<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
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
        'status',
    ];

    protected $casts =[
        'option_value' => 'array',
        // 'quantity' => 'array',
        'month' => 'array',
        'price' => 'array',
    ];

public function getProduct(){
    return $this->belongsTo(Product::class, 'product_id');
}

}
