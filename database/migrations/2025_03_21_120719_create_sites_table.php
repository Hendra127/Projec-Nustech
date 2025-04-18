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
        Schema::create('datasite', function (Blueprint $table) {
            $table->id(); // Primary key auto increment
            $table->string('site_id', 100)->nullable(false);
            $table->string('sitename', 150)->nullable();
            $table->string('tipe', 100)->nullable();
            $table->string('batch', 100)->nullable();
            $table->decimal('latitude', 11, 8)->nullable(); // Akurat hingga 0.00000001
            $table->decimal('longitude', 11, 8)->nullable();
            $table->string('provinsi', 100)->nullable();
            $table->string('kab', 100)->nullable();
            $table->string('kecamatan', 100)->nullable();
            $table->string('kelurahan', 100)->nullable();
            $table->text('alamat_lokasi')->nullable();
            $table->string('nama_pic', 150)->nullable();
            $table->string('nomor_pic', 50)->nullable();
            $table->string('sumber_listrik', 100)->nullable();
            $table->string('gateway_area', 100)->nullable();
            $table->string('beam', 100)->nullable();
            $table->string('hub', 100)->nullable();
            $table->string('kodefikasi', 100)->nullable();
            $table->string('sn_antena', 100)->nullable();
            $table->string('sn_modem', 100)->nullable();
            $table->string('sn_router', 100)->nullable();
            $table->string('sn_ap1', 100)->nullable();
            $table->string('sn_ap2', 100)->nullable();
            $table->string('sn_tranciever', 100)->nullable();
            $table->string('sn_stabilizer', 100)->nullable();
            $table->string('sn_rak', 100)->nullable();
            $table->string('ip_modem', 50)->nullable();
            $table->string('ip_router', 50)->nullable();
            $table->string('ip_ap1', 50)->nullable();
            $table->string('ip_ap2', 50)->nullable();
            $table->string('expected_sqf', 50)->nullable();
            $table->timestamps(); // created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('datasite');
    }
};
