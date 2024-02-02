<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_name',
        'min_purchase_qty',
        'max_purchase_qty',
        'product_images',
        'regular_price',
        'sku',
        'stock_status',
        'discount_start_date',
        'discount_end_date',
        'discount',
        'discount_type',
        'product_description',
        'meta_title',
        'meta_description',
        'slug',
        'product_status',
        'brand',
        'main_category',
        'sub_category'
    ];

    protected $cast = [
    'product_images' => 'array'
    ];
}
