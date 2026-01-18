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
    Schema::table('laporan_instalasi', function (Blueprint $table) {
        $table->foreignId('project_site_id')
              ->after('id')
              ->constrained('project_sites')
              ->cascadeOnDelete();
    });
}

public function down()
{
    Schema::table('laporan_instalasi', function (Blueprint $table) {
        $table->dropForeign(['project_site_id']);
        $table->dropColumn('project_site_id');
    });
}

};
