<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $primaryKey = 'banner_id';
    protected $fillable = [
        'banner_title',
        'banner_subtitle',
        'banner_type',
        'banner_path',
        'priority',
        'created_by',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
