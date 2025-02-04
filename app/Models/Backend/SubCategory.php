<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'main_category_id',
        'ordering_number',
        'type',
        'thumbnail_image',
        'slug',
        'meta_title',
        'meta_description',
        'meta_image',
        'page_description',
        'filtering_attribute',
        'status'
    ];
    protected $casts = [
        'filtering_attribute' => 'array'
    ];

    public function mainCategory(){
        return $this->belongsTo(MainCategory::class, 'main_category_id', 'id');
    }
}
