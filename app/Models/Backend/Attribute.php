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
        return $this->hasmany(AttributeValue::class, 'attribute_id', 'id');
    }
}
