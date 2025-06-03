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
        Schema::create('datapass', function (Blueprint $table) {
            $table->id();
            $table->string('site_id');
            $table->string('nama_lokasi');
            $table->string('kabupaten');
            $table->string('adop')->nullable();
            $table->string('pass_ap1')->nullable();
            $table->string('pass_ap2')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('datapass');
    }
};
