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
        Schema::create('laporan_pm', function (Blueprint $table) {
            $table->id(); // ID auto increment
            $table->date('tanggal_submit')->nullable();
            $table->string('site_id')->nullable();
            $table->string('lokasi_site')->nullable();
            $table->string('kabupaten_kota')->nullable();
            $table->string('provinsi')->nullable();
            $table->string('pm_bulan')->nullable();
            $table->date('laporan_ba_pm')->nullable();
            $table->string('teknisi')->nullable()->change();
            $table->text('masalah_kendala')->nullable();
            $table->text('action')->nullable();
            $table->text('ket_tambahan')->nullable();
            $table->string('status_laporan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laporan_pm');
    }
};
