<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meja;

class MejaController extends Controller
{
    public function tampilMeja(){
        $meja = Meja::all();
        return view('pelayan.meja-list',['meja'=>$meja]);
    }

    public function ubahStatusMeja(Request $request){
        $meja = Meja::where('id_meja',$request->idMeja)->update(['ketersediaan'=>true]);
        return response()->json(['code'=>200]);
    }

}
