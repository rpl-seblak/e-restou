<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meja extends Model
{
    use HasFactory;
    protected $table = 'meja';
    protected $primaryKey = 'id_meja';
    public $timestamps = false;

    public function getAllMeja(){
        return $this->count();
    }

    public function mejaKosong(){
        return $this->where('ketersediaan','=',true)->count();
    }

    public function mejaTerisi(){
        return $this->where('ketersediaan','=',false)->count();
    }

}
