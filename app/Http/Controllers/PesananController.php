<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meja;
class PesananController extends Controller
{
    public function tampilMeja(){
        $meja = new Meja();
        return view('pelayan.meja-list',['meja'=>$meja->getAllMeja()]);
    }
}
