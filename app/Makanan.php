<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Makanan extends Model
{
    
    
    public function orders()
    {
        return $this->belongsToMany(
            Order::class, 
            'makanan_order',
            'makanan_id',
            'order_id');
    }

    protected $fillable = [
        'nama', 
        'harga',
    ];
}