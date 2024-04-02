<?php

namespace App\Models\Backend;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "name",
        "email",
        "phone",
        "address",
        "city",
        "zip_code",
        "country"
    ];

    public function getUser(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
