<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Kategori;
use Validator;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::all();
        return response()->json(['data'=>$kategori]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'kategori' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['error' => $validator->errors()], 401);
        }

        $input = $request->all();
        $kategori = Kategori::create($input);
        return response()->json(['data'=>$kategori]);
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        $find = Kategori::find($id);
        $kategori = $find->update($input);

        return response()->json([ 'message' => 'edited','data' => $input], 200);
    }
    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();
        return response()->json(['message'=>'deleted'], 200);
    }
}
