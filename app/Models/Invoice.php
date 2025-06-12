<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'customer',
        'saleDate',
        'books_sold',
        'amount'
    ];
    protected $casts = [
        'books_sold' => 'array',
    ];
}
