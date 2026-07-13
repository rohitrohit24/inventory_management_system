<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'sku',
        'barcode',
        'image',
        'cost_price',
        'selling_price',
        'quantity',
        'alert_quantity',
        'description',
        'status'
    ];
    public function category(): BelongsTo
    {
        return $this->belongsTo(Categorie::class);
    }
    public function TotalInvoice(): HasMany
    {
        return $this->hasMany(TotalInvoice::class);
    }
}
