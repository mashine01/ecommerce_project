<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;


    protected $primaryKey = 'id';
    protected $fillable = [
        'style_code',
        'front_thumbnail',
        'front_grid',
        'front_view',
        'front_display',
        'back_thumbnail',
        'back_grid',
        'back_view',
        'back_display',
        'left_thumbnail',
        'left_grid',
        'left_view',
        'left_display',
        'right_thumbnail',
        'right_grid',
        'right_view',
        'right_display',
        'created_by,'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'style_code', 'style_code');
    }
}
