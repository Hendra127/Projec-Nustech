<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('project_timeline', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lokasi');
            $table->enum('status', ['pending', 'progress', 'done'])->default('pending');
            $table->date('tanggal');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('project_timeline');
    }
};
