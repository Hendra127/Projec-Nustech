<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('tracking', function (Blueprint $table) {
        $table->id();
        $table->string('nama_perangkat');
        $table->string('jenis');
        $table->string('tipe');
        $table->string('sn')->unique();
        $table->string('kondisi');
        $table->string('lokasi_awal')->nullable();
        $table->string('kab_awal')->nullable();
        $table->string('lokasi_realtime')->nullable();
        $table->string('kab_realtime')->nullable();
        $table->string('layanan_ai')->nullable();
        $table->string('bulan_masuk')->nullable();
        $table->date('tanggal_masuk')->nullable();
        $table->string('bulan_keluar')->nullable();
        $table->date('tanggal_keluar')->nullable();
        $table->text('keterangan')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tracking');
    }
};
