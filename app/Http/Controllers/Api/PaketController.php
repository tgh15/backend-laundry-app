<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Resources\PaketResource;

use App\Paket;
use Validator;

class PaketController extends Controller
{
    public function index()
    {
        $paket = Paket::all();
        return PaketResource::collection($paket);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'paket' => 'required',
            'harga' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['error' => $validator->errors()], 401);
        }

        $input = $request->all();
        $paket = Paket::create($input);
        return new PaketResource($paket);
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        $find = Paket::find($id);
        $paket = $find->update($input);
        if($paket){
            return response()->json([ 'message' => 'edited','data' => $input], 200);
        }
    }

    public function destroy($id)
    {
        $paket = Paket::find($id);
        $paket->delete();
        return response()->json(['message'=>'deleted'], 200);
    }
}
