<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meja;
use App\Models\Menu;
use App\Models\Pesanan;

class DashboardController extends Controller
{
    public function dashboardPelayan(){
        $meja = new Meja;
        return view('pelayan.index',['total_meja'=>$meja->getAllMeja(),'kosong'=>$meja->mejaKosong(),'terisi'=>$meja->mejaTerisi()]);
    }

    public function dashboardKasir(){
        $pesanan = new Pesanan;
        return view('kasir.index',$pesanan->getPendapatan());
    }

    public function dashboardKoki(){
        $menu = new Menu;
        return view('koki.index',['total_menu'=>$menu->totalMenu()]);
    }
}
