<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "profile_image",
        "business_name",
        "email",
        "phone",
        "address",
        "gst"
    ];
}
