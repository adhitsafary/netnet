<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rekap_mutasi_harian', function (Blueprint $table) {
            $table->id();
            $table->string('tanggal');
            $table->integer('tagihan_awal');
            $table->integer('pemasukan_bulan_kemarin');
            $table->integer('pemasukan_bulan_sekarang');

            $table->string('saldo_akhir');
            $table->integer('total_koreksi');
            $table->integer('belum_tertagih');
            $table->integer('pemasukan_harian');

            $table->string('piutang');
            $table->integer('piutang_masuk');
            $table->integer('pendapatan_total');
            $table->integer('keterangan');

            $table->timestamps();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekap_mutasi_harian');
    }
};
