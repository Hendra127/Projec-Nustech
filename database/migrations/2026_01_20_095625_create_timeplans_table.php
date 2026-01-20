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
        Schema::create('timeplans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_site_id')->constrained()->cascadeOnDelete();
            $table->integer('jumlah_site');
            $table->string('teknisi');
            $table->date('start_date'); // tanggal mulai kerja
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('timeplans');
    }
};
