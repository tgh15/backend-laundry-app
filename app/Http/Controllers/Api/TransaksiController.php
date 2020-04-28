<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Resources\TransaksiResource;
use\App\Transaksi;
use\App\TransaksiList;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaksi = Transaksi::all();
        return TransaksiResource::collection($transaksi);
        // return $transaksi;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $transaksi = new Transaksi();
        $transaksi->kode_transaksi = $request->kode_transaksi;
        $transaksi->nama_pelanggan = $request->nama_pelanggan;
        $transaksi->no_hp = $request->no_hp;
        $transaksi->alamat = $request->alamat;
        $transaksi->total_harga = $request->total_bayar;
        $transaksi->status_pengerjaan = $request->status_pengerjaan;
        $transaksi->status_pembayaran = $request->status_pembayaran;
        $transaksi->save();

        for ($i=0; $i < count($request->transaksilist); $i++) { 
            $transaksilist = new TransaksiList;
            $transaksilist->paket = $request->transaksilist[$i]['paket'];
            $transaksilist->kuantitas = $request->transaksilist[$i]['kuantitas'];
            $transaksilist->kiloan = $request->transaksilist[$i]['kiloan'];
            $transaksilist->harga = $request->transaksilist[$i]['harga'];
            $transaksi->transaksilist()->save($transaksilist);
        }
        return response()->json($transaksi->with('transaksilist'), 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transaksi = Transaksi::with('transaksilist')->find($id);
        return TransaksiResource::collection($transaksi);
        // return $transaksi;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}