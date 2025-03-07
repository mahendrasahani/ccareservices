<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    use HasFactory;
    protected $fillable = [
        'attribute_id',
        'name',
        'sort_order',
        'status'
    ];

    public function Attribute(){
        return $this->belongsTo(Attribute::class, 'attribute_id', 'id');
    }

   
}
