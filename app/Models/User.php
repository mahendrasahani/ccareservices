<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Backend\Order;
use App\Models\Backend\Review;
use App\Models\Backend\ShippingAddress;
use App\Models\Frontend\Cart;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_type',
        'status',
        'phone',
        'company_name',
        'address_1',
        'address_2',
        'country',
        'state',
        'city',
        'postal_code',
        'aadhar_front',
        'aadhar_back',
        'company_id',
        'profile',
        'otp_verify_status',
        'otp',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function getShippingAddress(){
        return $this->hasOne(ShippingAddress::class, 'user_id');
    }

    public function getUserOrder(){
        return $this->hasMany(Order::class, 'user_id');
    }

    public function getCartItem(){
        return $this->hasMany(Cart::class, 'user_id');
    }

    public function getReview(){
        return $this->hasMany(Review::class, 'user_id');
    }
}
