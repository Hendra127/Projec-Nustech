<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('log_perangkat', function (Blueprint $table) {
            $table->id();
            $table->string('site_id')->nullable();
            $table->string('sitename')->nullable();
            $table->string('perangkat')->nullable();
            $table->date('tanggal_pergantian')->nullable();
            $table->string('sn_lama')->nullable();
            $table->string('sn_baru')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('log_perangkat');
    }
};
