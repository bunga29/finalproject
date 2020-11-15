<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class Order extends Model
{
    
    public function makanans()
    {
        return $this->belongsToMany(
            Makanan::class, 
            'makanan_order',
            'order_id',
            'makanan_id')->withPivot('jumlah');
    }

    public function minumans()
    {
        return $this->belongsToMany(
            Minuman::class, 
            'minuman_order',
            'order_id',
            'minuman_id')->withPivot('jumlah');
    }

    protected $fillable = [
        'nama', 'total', 'keterangan',
    ];
    // protected $casts = [
    //     'harga_mak' => 'array',
    //     'nama_mak' => 'array',
    //     'jumlah_mak' => 'array',
    //   ];
}
