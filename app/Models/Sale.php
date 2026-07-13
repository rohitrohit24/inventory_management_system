<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'invoice_no',
        'customer_name',
        'user_id',
        'product_id',
        'category_id',
        'quantity',
        'unit_price',
        'discount',
        'tax',
        'item_total',
        'payment_method',
        'sale_date',
    ];
}
