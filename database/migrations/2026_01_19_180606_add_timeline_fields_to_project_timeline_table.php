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
    Schema::table('project_timeline', function (Blueprint $table) {
        $table->unsignedBigInteger('project_site_id')->nullable()->after('id');
        $table->date('tanggal_mulai')->nullable()->after('project_site_id');
        $table->date('tanggal_selesai')->nullable()->after('tanggal_mulai');
        $table->integer('durasi_hari')->nullable()->after('tanggal_selesai');
    });
}

public function down()
{
    Schema::table('project_timeline', function (Blueprint $table) {
        $table->dropColumn('project_site_id');
        $table->dropColumn('tanggal_mulai');
        $table->dropColumn('tanggal_selesai');
        $table->dropColumn('durasi_hari');
    });
}

};
