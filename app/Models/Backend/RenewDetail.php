<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RenewDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        "order_id",
        "product_id",
        "month",
        "tax_name",
        "tax_amount",
        "discount",
        "unit_price",
        "total_amount",
        "start_date",
        "end_date",
        "payment_method",
        "payment_status",
        "renewal_note",
        "status",
        "quantity"
    ];
}
