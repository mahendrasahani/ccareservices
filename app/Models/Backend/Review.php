<?php

namespace App\Models\Backend;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "product_id",
        "rating",
        "comment",
        "status"
    ];

    public function getUser(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getProduct(){
        return $this->belongsTo(Product::class, 'product_id');
    }
}
