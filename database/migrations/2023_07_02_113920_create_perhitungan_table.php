<?php

use Brick\Math\BigInteger;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perhitungan', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('barang_keluar_id')->unsigned();
            $table->bigInteger('barang_id')->unsigned();
            $table->double('eoq', 8, 2);
            $table->double('frekuensi', 8, 2);
            $table->double('rop', 8, 2);
            $table->double('total_biaya_simpan', 8, 2);
            $table->double('total_biaya_pesan', 8, 2);
            $table->double('total_biaya_persediaan', 8, 2);

            $table->foreign('barang_keluar_id')->references('id')->on('barang_keluar')->onDelete('cascade');
            $table->foreign('barang_id')->references('id')->on('barang')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('perhitungan');
    }
};
