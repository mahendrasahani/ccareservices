<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
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
        'attribute_value',
        'vendor_id',
        'date_of_purchase',
        'purchase_amount',
        'invoice_number', 
        'tax_name', 
        'tax_rate',  
        "tax_id"
    ];

    protected $casts = [
    'product_images' => 'array',
    'main_category' => 'array',
    'sub_category' => 'array',
    'attribute_name' => 'array',
    'attribute_value' => 'array', 
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

    public function getOrderProduct(){
        return $this->hasMany(OrderProduct::class, 'product_id');
    }

    public function getReview(){
        return $this->hasMany(Review::class, 'product_id');
    }
   

}
