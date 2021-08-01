<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meja;
use App\Models\Menu;
use App\Models\Pesanan;
use App\Models\DetailPesanan;

class PembayaranController extends Controller
{
    public function listPembayaran(){
        $pembayaran = Pesanan::where('status','=','served')->get();
        return view('kasir.pembayaran',compact('pembayaran'));
    }

    public function showPembayaran($id){
        $pesanan = Pesanan::where('id_pesanan',$id)->first();
        $detail = $pesanan->detail_pesanan;
        return view('kasir.form-pembayaran',compact('pesanan','detail'));
    }

    public function prosesPembayaran($id){
        $pesanan = Pesanan::where('id_pesanan',$id)->first();
        $pesanan->status = 'paid';
        $pesanan->save();

        return redirect()->route('kasir.pembayaran');
    }

    public function laporan(){
        $pembayaran = Pesanan::where('status','=','paid')->get();
        return view('kasir.laporan',compact('pembayaran'));
    }
}
