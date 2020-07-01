<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Transaksi;

class LaporanController extends Controller
{
    public function getLaporan(Request $request){
        // return $request;
        $dateStart  = $request->start;
        $dateEnd    = $request->end;
        $laporan = Transaksi::whereBetween('created_at', [$dateStart, $dateEnd])->get();
        return $laporan;
    }
}
