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
        Schema::table('plg_off', function (Blueprint $table) {
            $table->string('status_pembayaran')->default('belum bayar');
        });
    }


    public function down(): void
    {
        Schema::table('plg_off', function (Blueprint $table) {
            //
        });
    }
};
