<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $nullable = [
        'deskripsi'
    ];
    protected $fillable = [
        'kategori'
    ];

    protected $hidden = ['created_at', 'updated_at'];

    public function paket(){
        return $this->hasMany(Paket::class);
    }
}
