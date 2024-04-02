<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryBoyDetail extends Model
{
    use HasFactory;

    protected $fillable =[
        "user_id",
        "earning",
        "collection"
    ];
}
