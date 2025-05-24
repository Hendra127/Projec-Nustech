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
        Schema::create('tiket', function (Blueprint $table) {
            $table->id();
            $table->string('nama_site')->nullable();
            $table->string('provinsi');
            $table->string('kabupaten');
            $table->integer('durasi')->nullable(); // Jika durasi dalam angka (hari/jam)
            $table->string('kategori');
            $table->date('tanggal_rekap')->nullable();
            $table->string('bulan_open');
            $table->string('status_tiket');
            $table->text('kendala')->nullable();
            $table->date('tanggal_close')->nullable();
             $table->string('bulan_close')->nullable()->change(); 
            $table->text('detail_problem')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tiket');
    }
};
