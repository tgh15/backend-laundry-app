<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Kategori;

class PaketResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'paket' => $this->paket,
            'harga' => $this->harga,
            'kategori' => Kategori::find($this->kategori_id)->kategori
        ];
    }
}
