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
        'quantity',
        'month',
        'price',
        'status',
    ];

    protected $casts =[
        'option_value' => 'array',
        'quantity' => 'array',
        'month' => 'array',
        'price' => 'array',
    ];

public function getProduct(){
    return $this->belongsTo(Product::class, 'product_id');
}

}
