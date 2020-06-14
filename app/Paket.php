<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    protected $fillable = [
        'paket', 'harga', 'kategori_id'
    ];

    public function kategori(){
        return $this->belongsTo(Kategori::class);
    }
}
