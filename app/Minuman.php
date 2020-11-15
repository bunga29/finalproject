<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Minuman extends Model
{
    
    public $table = "minumans";
    
    public function orders()
    {
        return $this->belongsToMany(
            Order::class, 
            'minuman_order',
            'minuman_id',
            'order_id');
    }

    protected $fillable = [
        'nama', 
        'harga',
    ];
}
