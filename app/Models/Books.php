<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'publisher',
        'ISBN',
        'edition',
        'genre',
        'cost',
        'price',
        'quantity',
        'cover_photo',
    ];
}
