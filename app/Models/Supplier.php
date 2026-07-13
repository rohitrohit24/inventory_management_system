<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Supplier extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'email',
        'company_name',
        'address',
        'gst_number',
        'status'
    ];
    public function TotalInvoice(): HasMany
    {
        return $this->hasMany(TotalInvoice::class);
    }
}
