<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meja;
use App\Models\Menu;
use App\Models\Pesanan;
use App\Models\DetailPesanan;
use DataTables;
use Carbon\Carbon;

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

    public function laporan(Request $request){
        if ($request->ajax()) {
            $pembayaran = Pesanan::select(\DB::raw('tanggal_pemesanan, SUM(total_pembayaran) as pendapatan'))
            ->groupBy('tanggal_pemesanan')
            ->where('status','=','paid')->latest('tanggal_pemesanan');
            $data;
            if ($request->has('bulan') && $request->bulan != null) {
                // dd(Carbon::parse($request->bulan)->month);
                $data = $pembayaran->whereRaw('MONTH(tanggal_pemesanan) = '.Carbon::parse($request->bulan)->month.
                ' AND YEAR(tanggal_pemesanan) = '.Carbon::parse($request->bulan)->year)->get();
            }else{
                $data = $pembayaran->get();
            }
            // dd($pembayaran->get());
            // $data = \DB::table('pesanan')->where('status','=','paid')->select('*')->orderBy('tanggal_pemesanan');
            return Datatables::of($data)
                    ->editColumn('pendapatan', function ($pesanan) {
                        return $pesanan->pendapatan ? "Rp ".number_format($pesanan->pendapatan,0,'','.') : '';
                    })
                    ->addIndexColumn()
                    ->make(true);
        }
        return view('kasir.laporan');
    }

    public function filter(Request $request){
        $pesanan = DB::table('pesanan')->get();
        return Datatables::of($users)
            ->filter(function ($query) use ($request) {
                if ($request->has('bulan')) {
                    $query->where('tanggal_pemesanan', '=', $request->bulan);
                }

            })
            ->make(true);
    }
}
