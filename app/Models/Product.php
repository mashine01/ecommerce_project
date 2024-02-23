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
        'is_active',
        'front_image',
        'back_image',
        'left_image',
        'right_image',
        'vendor_id',
        'brand_id',
        'category_id',
        'sub_category_id',
        'price',
        'discount',
        'discount_price',
        'vendor_style_code',
        'style_code',
        'created_by',        
    ];

    public function variants() {
        return $this->hasMany(ProductVariant::class, 'style_code', 'style_code');
    }

    public function vendor() {
        return $this->belongsTo(Vendor::class, 'vendor_id', 'id');
    }

    public function brand() {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }

    public function subcategory() {
        return $this->belongsTo(SubCategory::class, 'sub_category_id', 'id');
    }

    public function trendings() {
        return $this->hasMany(Trending::class, 'style_code', 'style_code');
    }
}
