<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'description',
        'image',
        'vendor_id',
        'brand_id',
        'price',
        'discount',
        'discount_price',
        'style_code',
        'vendor_style_code',
        'category_id',
        'created_by',
    ];

    public function vendor() {
        return $this->belongsTo(Vendor::class, 'vendor_id', 'id');
    }

    public function brand() {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }
    
    public function category() {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function variants() {
        return $this->hasMany(ProductVariant::class, 'style_code', 'style_code');
    }

    public function trendings() {
        return $this->hasMany(Trending::class, 'style_code', 'style_code');
    }
}
