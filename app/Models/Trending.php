<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trending extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
        'style_code',
        'categories',
        'created_by',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'style_code', 'style_code');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'style_code', 'style_code');
    }

    public function trendingCategory()
    {
        return $this->belongsTo(TrendingCategory::class, 'categories', 'id');
    }
}
