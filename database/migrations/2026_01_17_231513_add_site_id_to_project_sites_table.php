<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('project_sites', function (Blueprint $table) {
            $table->string('site_id')->after('project_id');
        });
    }

    public function down()
    {
        Schema::table('project_sites', function (Blueprint $table) {
            $table->dropColumn('site_id');
        });
    }
};
