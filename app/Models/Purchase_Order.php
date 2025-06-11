<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase_Order extends Model
{
    public function book()
    {
        return $this->belongsTo(Books::class, 'book_id');
    }
    public function supplier()
    {
        return $this->belongsTo(Suppliers::class, 'supplier_id');
    }
}
