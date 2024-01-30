<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainCategory extends Model
{
    use HasFactory;
    protected $fillable = [
    'name',
    'ordering_number',
    'thumbnail',
    'meta_title',
    'meta_description',
    'meta_image',
    'filtering_attribute',
    'status',
    ];

    protected $casts = [
        'filtering_attribute' => 'array',
    ];
}
