<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecentActivity extends Model
{
    use HasFactory;
    protected $fillable =[
        "user_id",
        "user_name",
        "user_email",
        "user_phone",
        "location",
        "long",
        "lati",
        "ip_address", 
        "country",
        "country_code",
        "region",
        "city",
        "zip",
        "timezone",
        "isp",
        "org",
        "as", 
    ];
}
