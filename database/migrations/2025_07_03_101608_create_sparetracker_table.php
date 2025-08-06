<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('sparetracker', function (Blueprint $table) {
            $table->id();
            $table->string('sn')->nullable(); // tidak unique agar bisa ada duplikat jika diperlukan
            $table->string('nama_perangkat')->nullable();
            $table->string('jenis')->nullable();
            $table->string('type')->nullable();
            $table->string('kondisi')->nullable();
            $table->string('pengadaan_by')->nullable();
            $table->string('lokasi_asal')->nullable();
            $table->string('lokasi')->nullable();
            $table->string('bulan_masuk')->nullable();
            $table->date('tanggal_masuk')->nullable();
            $table->string('status_penggunaan_sparepart')->nullable();
            $table->string('lokasi_realtime')->nullable();
            $table->string('kabupaten')->nullable();
            $table->string('bulan_keluar')->nullable();
            $table->date('tanggal_keluar')->nullable();
            $table->string('layanan_ai')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sparetracker');
    }
};
