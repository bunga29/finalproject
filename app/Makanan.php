<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Makanan extends Model
{
    protected $fillable = [
        'nama', 
        'harga',
    ];
}