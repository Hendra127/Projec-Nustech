<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (Schema::hasTable('sparetracker')) {
            Schema::table('sparetracker', function (Blueprint $table) {
                // Cek apakah index unik ada sebelum dihapus
                try {
                    $table->dropUnique(['sn']); // gunakan array bukan string nama index
                } catch (\Exception $e) {
                    // Optional: log error atau abaikan
                }

                // Ubah jadi nullable
                $table->string('sn')->nullable()->change();
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('sparetracker')) {
            Schema::table('sparetracker', function (Blueprint $table) {
                $table->string('sn')->nullable(false)->unique()->change();
            });
        }
    }
};
