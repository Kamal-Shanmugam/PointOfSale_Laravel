<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'customer',
        'saleDate',
        'book_sold',
        'amount'
    ];
}
