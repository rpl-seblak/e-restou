<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesanan', function (Blueprint $table) {
            $table->id('id_pesanan');
            $table->string('nama_pelanggan',40);
            $table->enum('status',['waiting','cooking','served']);
            $table->timestamps();
        });
        Schema::table('pesanan', function (Blueprint $table) {
            $table->foreignId('id_pegawai')->after("id_pesanan")->constrained('pegawai');
            $table->foreignId('id_meja')->after("id_pegawai")->constrained('meja');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pesanan');
    }
}
