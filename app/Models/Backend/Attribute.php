<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'status'
    ];
    
    public function attributeValues(){
        return $this->hasMany(AttributeValue::class, 'attribute_id', 'id');
    }

    public function getStock(){
        return $this->belongsTo(Stock::class, 'attribute_id', 'id');
    }

}
