<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'vendor_id',
        'created_by',
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id', 'id');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
