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
    Schema::create('pm_liberta', function (Blueprint $table) {
        $table->id();
        $table->string('site_id')->nullable();
        $table->string('nama_lokasi')->nullable();
        $table->string('provinsi')->nullable();
        $table->string('kabupaten_kota')->nullable();
        $table->string('pic_ce')->nullable();
        $table->string('month')->nullable();
        $table->date('date')->nullable();
        $table->string('status')->nullable();
        $table->string('week')->nullable();
        $table->string('kategori')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pm_liberta');
    }
};
