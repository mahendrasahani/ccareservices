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
        'sub_category',
        'attribute_name',
        'attribute_value'
    ];

    protected $casts = [
    'product_images' => 'array',
    'main_category' => 'array',
    'sub_category' => 'array',
    'attribute_name' => 'array',
    'attribute_value' => 'array'
    ];

    public function getBrand(){
        return $this->belongsTo(Brand::class, 'brand');
    }

    // public function getStock(){
    //     return $this->hasOne(Stock::class, 'product_id');
    // }

    public function getStock(){
        return $this->hasMany(Stock::class, 'product_id');
    }

}
