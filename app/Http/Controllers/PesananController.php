<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\Models\Meja;
use App\Models\Menu;
use App\Models\Pesanan;
use App\Models\DetailPesanan;

class PesananController extends Controller
{
    public function tampilMeja(){
        $meja = new Meja();
        return view('pelayan.meja-list',['meja'=>$meja->getAllMeja()]);
    }

    public function listPesananKoki(){
        return view('koki.pesanan');
    }

    public function detailPesananKoki(){
        return view('koki.detail-pesanan');
    }

    public function listPesananPelayan(){
        return view('pelayan.pesanan');
    }

    public function createPesanan(){
        $menu = Menu::all();
        return view('pelayan.form-pesanan',compact('menu'));
    }

    public function storePesanan(Request $request){
        DB::transaction(function () use($request){
        $dataPesanan = $request->dataPesanan;
        $namaPelanggan = $dataPesanan['nama'];
        $meja = $dataPesanan['idMeja'];
        $detailPesanan = $dataPesanan['pesanan'];
        $totalBayar = 0;
        foreach($detailPesanan as $value){
            $totalBayar += $value['jumlah'];
            
        }
            $pesanan = Pesanan::create([
                'id_pegawai'=> \Auth::user()->id_pegawai,
                'id_meja' => $meja,
                'nama_pelanggan' => $namaPelanggan,
                'tanggal_pemesanan' => Carbon::now()->format('Y-m-d'),
                'total_pembayaran' => $totalBayar,
                'status' => 'waiting'
            ]);

            $meja = Meja::find($meja);
                  $meja->ketersediaan = false;
                  $meja->save();

            $newDetail = [];
            // dd($detailPesanan);
            for($i=0;$i<count($detailPesanan);$i++){
                $newDetail[] = [
                    "id_pesanan" => $pesanan->id_pesanan,
                    "id_menu" => $detailPesanan[$i]['idMenu'],
                    "qty" => $detailPesanan[$i]["qty"]
                ];
            }
            
            DetailPesanan::upsert($newDetail,[
                'id_pesanan',
                'id_menu',
                'qty'
            ]);
            for($j=0;$j<count($detailPesanan);$j++){
                $menu = new Menu;
                $menu->kurangiStok($detailPesanan[$j]["idMenu"],$detailPesanan[$j]["qty"]);
            }
        },5);

        return response()->json(['code'=>200, 'message'=>'Transaksi Berhasil'], 200);

    }

}
