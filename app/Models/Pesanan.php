<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DetailPesanan;

class Pesanan extends Model
{
    use HasFactory;
    protected $table = 'pesanan';
    protected $primaryKey = 'id_pesanan';
    public $timestamps = false;
    protected $fillable = [
        'id_pegawai',
        'id_meja',
        'nama_pelanggan',
        'tanggal_pemesanan',
        'total_pembayaran',
        'status'
];

    public function detail_pesanan(){
        return $this->hasMany(DetailPesanan::class,'id_pesanan');
    }
}
