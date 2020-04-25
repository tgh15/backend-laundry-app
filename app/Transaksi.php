<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    public function transaksilist(){
        return $this->hasMany(TransaksiList::class);
    }
}
