<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;
    # we can specify a name for our table:
    # protected $table = 'my_products';

    public $timestamps = false;

    protected $fillable = [
        'title',
        'description',
        'candidate_id',
        'candidate_name',
        'location_name',
        'date',
        'longitude',
        'latitude'
    ];
}
