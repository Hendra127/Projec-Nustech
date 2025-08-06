<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('laporan_pm', function (Blueprint $table) {
            if (!Schema::hasColumn('laporan_pm', 'teknisi')) {
                $table->string('teknisi')->nullable()->after('laporan_ba_pm'); // atau after kolom lain sesuai urutan
            }
        });
    }

    public function down(): void
    {
        Schema::table('laporan_pm', function (Blueprint $table) {
            if (Schema::hasColumn('laporan_pm', 'teknisi')) {
                $table->dropColumn('teknisi');
            }
        });
    }
};
