<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\TransaksiListResource;

class TransaksiResource extends JsonResource
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
            'kode_transaksi' => $this->kode_transaksi,
            'nama_pelanggan' => $this->nama_pelanggan,
            'no_hp' => $this->no_hp,
            'alamat' => $this->alamat,
            'total_bayar' => $this->total_harga,
            'status_pengerjaan' => $this->status_pengerjaan,
            'status_pembayaran' => $this->status_pembayaran,
            'tanggal_transaksi' => date_format($this->created_at, 'Y-m-d'),
            'transaksi_list' => TransaksiListResource::collection($this->transaksilist)
        ];
    }
}
