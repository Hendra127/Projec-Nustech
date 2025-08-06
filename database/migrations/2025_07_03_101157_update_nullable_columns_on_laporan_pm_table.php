<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('laporan_pm', function (Blueprint $table) {
            // Gunakan pengecekan agar tidak error jika kolom belum ada
            if (Schema::hasColumn('laporan_pm', 'tanggal_submit')) {
                $table->string('tanggal_submit')->nullable()->change();
            }

            if (Schema::hasColumn('laporan_pm', 'site_id')) {
                $table->string('site_id')->nullable()->change();
            }

            if (Schema::hasColumn('laporan_pm', 'lokasi_site')) {
                $table->string('lokasi_site')->nullable()->change();
            }

            if (Schema::hasColumn('laporan_pm', 'kabupaten_kota')) {
                $table->string('kabupaten_kota')->nullable()->change();
            }

            if (Schema::hasColumn('laporan_pm', 'provinsi')) {
                $table->string('provinsi')->nullable()->change();
            }

            if (!Schema::hasColumn('laporan_pm', 'teknisi')) {
                $table->string('teknisi')->nullable();
            } else {
                $table->string('teknisi')->nullable()->change();
            }

            if (Schema::hasColumn('laporan_pm', 'status_laporan')) {
                $table->string('status_laporan')->nullable()->change();
            }

            if (Schema::hasColumn('laporan_pm', 'pm_bulan')) {
                $table->string('pm_bulan')->nullable()->change();
            }

            if (Schema::hasColumn('laporan_pm', 'laporan_ba_pm')) {
                $table->date('laporan_ba_pm')->nullable()->change();
            }

            if (Schema::hasColumn('laporan_pm', 'masalah_kendala')) {
                $table->text('masalah_kendala')->nullable()->change();
            }

            if (Schema::hasColumn('laporan_pm', 'action')) {
                $table->text('action')->nullable()->change();
            }

            if (Schema::hasColumn('laporan_pm', 'ket_tambahan')) {
                $table->text('ket_tambahan')->nullable()->change();
            }
        });
    }

    public function down(): void
    {
        Schema::table('laporan_pm', function (Blueprint $table) {
            if (Schema::hasColumn('laporan_pm', 'teknisi')) {
                $table->dropColumn('teknisi');
            }

            // Tidak perlu rollback `nullable()->change()` kecuali sangat dibutuhkan
        });
    }
};
