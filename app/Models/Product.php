<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'Products';
    protected $fillable = [
        'name_product',
        'merchant_id',
        'product_category_id',
        'stock',
        'price',
        'unit',
        'image',
        'status',
    ];

}
