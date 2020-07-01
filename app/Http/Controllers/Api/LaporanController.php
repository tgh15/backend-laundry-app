<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Transaksi;
use App\Http\Resources\TransaksiResource;

class LaporanController extends Controller
{
    public function getLaporan(Request $request){
        // return $request;
        $dateStart  = $request->start;
        $dateEnd    = $request->end;
        $laporan = Transaksi::whereBetween('created_at', [$dateStart, $dateEnd])->get();
        if ($laporan) {
            # code...
            return TransaksiResource::collection($laporan);
        }else{
            return response()->json(["error" => 'error' ]);
        }
    }
}
