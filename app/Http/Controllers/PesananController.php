<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\Models\Menu;
use App\Models\Pesanan;
use App\Models\DetailPesanan;
use App\Models\Meja;

class PesananController extends Controller
{

    public function listPesananKoki(){
        $pesananObj = new Pesanan;
        $pesanan = $pesananObj->getProcessedPesanan();
        return view('koki.pesanan',compact('pesanan'));
    }

    public function detailPesananKoki($id){
        $pesanan = Pesanan::where('id_pesanan',$id)->first();
        $detail = $pesanan->detail_pesanan;
        return view('koki.detail-pesanan',compact('pesanan','detail'));
    }

    public function detailPesanan($id){
        $detail = DB::table('detail_pesanan')->join('menu','detail_pesanan.id_menu','=','menu.id_menu')
        ->select('detail_pesanan.*','menu.nama_menu')->where('id_pesanan',$id)->get();
        return response()->json(['code'=>200, 'data'=>$detail], 200);
    }

    public function listPesananPelayan(){
        $pesananObj = new Pesanan;
        $pesanan = $pesananObj->getProcessedPesanan();
        return view('pelayan.pesanan',compact('pesanan'));
    }

    public function createPesanan(){
        $menu = Menu::where('stok','>','0')->get();
        return view('pelayan.form-pesanan',compact('menu'));
    }

    public function storePesanan(Request $request){
        if(!isset($request->dataPesanan['nama'])){
            return response()->json(['error'=>'Nama Pelanggan Tidak Boleh Kosong']);
        }
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

    public function updateStatusPesanan($id){
        $pesanan = Pesanan::where('id_pesanan',$id)->first();
        $newStatus;
        switch ($pesanan->status) {
            case 'waiting':
                $newStatus = 'cooking';
                break;
            case 'cooking':
                $newStatus = 'cooked';
                break;
            case 'cooked':
                $newStatus = 'served';
                break;
            default:
                break;
        }
        $pesanan->status = $newStatus;
        $pesanan->save();
        $role = auth()->user()->role;
        if($role == 'koki'){
            return redirect()->route('koki-pesanan.index');
        }else if($role == 'pelayan'){
            return redirect()->route('pelayan-pesanan.index');
        }
    }

}
