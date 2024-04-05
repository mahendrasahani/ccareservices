<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryBoy extends Model
{
    use HasFactory;
    protected $fillable = [
        "name",
        "email",
        "phone",
        "address",
        "father_name",
        "aadhar_number",
        "status",
    ];
}
