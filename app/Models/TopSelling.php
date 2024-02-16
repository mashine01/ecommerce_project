<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TopSelling extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';

    protected $fillable = [
        'style_code',
        'created_by',
    ];

    function product()
    {
        return $this->belongsTo(Product::class, 'style_code', 'style_code');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'style_code', 'style_code');
    }
}
