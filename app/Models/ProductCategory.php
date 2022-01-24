<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ProductCategory extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'Product_category';
    protected $fillable = [
        'name_category',
        'status',
    ];

}
