<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use DetailPesanan;
class Menu extends Model
{
    use HasFactory;
    protected $table = "menu";
    protected $primaryKey = 'id_menu';
    protected $fillable = [
            'nama_menu',
            'harga_menu',
            'stok',
    ];


    public function detail_pesanan(){
        return $this->hasMany(DetailPesanan::class,'id_menu');
    }

    public function kurangiStok($id,$jumlah){
        $stok = DB::table('menu')->where('id_menu',$id)->decrement('stok',$jumlah);
    }
}
