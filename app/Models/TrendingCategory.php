<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrendingCategory extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'created_by',
    ];

    public function trendings()
    {
        return $this->hasMany(Trending::class, 'categories', 'id');
    }

}