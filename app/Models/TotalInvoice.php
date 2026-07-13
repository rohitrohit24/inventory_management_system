<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TotalInvoice extends Model
{
    protected $fillable = [
        'supplier_id',
        'invoice_no',
        'product_id',
        'purchases_date',
        'quantity',
        'cost_price',
        'total_amount',
        'paid_amount',
        'due_amount',
        'products',
        'status',
        'created_by',
    ];
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }
    protected $casts = [
        'products' => 'array',
    ];
}
