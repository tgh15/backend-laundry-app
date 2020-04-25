<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransaksiList extends Model
{
    public function transaksi(){
        return $this->belongsTo(Transaksi::class);
    }
}
