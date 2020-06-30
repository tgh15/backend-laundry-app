<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            if ($transaksi) {
                # code...
                return TransaksiResource::collection($transaksi);
            }else{
                return response()->json(["error" => 'error' ]);
            }
            //throw $th;

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
        try{
            DB::beginTransaction();
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
                $transaksilist->harga = $request->transaksilist[$i]['harga'];
                $transaksi->transaksilist()->save($transaksilist);
            }
            DB::commit();
            return new TransaksiResource($transaksi);
        }catch(\Exception $e){
            return response()->json(["error" => $e->getMessage() ]);
            DB::rollback();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($kode_transaksi)
    {
        // return $kode_transaksi;
        $transaksi = Transaksi::where('kode_transaksi','=', $kode_transaksi)->with('transaksilist')->first();
        if ($transaksi) {
            # code...
            return new TransaksiResource($transaksi);
        }else {
            # code...
            return response()->json(["data" => ["message" => "data tidak ditemukan"] ]);
        }
        // return $transaksi[0];
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
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->status_pembayaran = $request->status_pembayaran;
        $transaksi->status_pengerjaan = $request->status_pengerjaan;
        
        if($transaksi->save()){
            return new TransaksiResource($transaksi);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            Transaksi::findOrFail($id)->delete();
            return response()->json(['message'=> 'berhasil dihapus']);
        }catch(\Exception $e){
            return response()->json(["error" => $e->getMessage() ]);
        }
        // Transaksi::findOrFail($id)->delete();
        // return response()->json(['message'=> 'berhasil dihapus']);
    }
}
