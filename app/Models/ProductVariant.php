<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;
    protected $fillable = [
        'style_code',
        'quantity',
        'upc',
        'colour',
        'size',
        'sku',
        'created_by',
    ];

    public function product() {
        return $this->belongsTo(Product::class);
    }
}
