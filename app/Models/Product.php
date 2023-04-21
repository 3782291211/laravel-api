<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    # we can specify a name for our table:
    # protected $table = 'my_products';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price'
    ];
}

