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
        Schema::table('newprojects', function (Blueprint $table) {
            $table->foreignId('card_id')
                ->nullable()
                ->constrained('cards')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('newprojects', function (Blueprint $table) {
            //
        });
    }
};
