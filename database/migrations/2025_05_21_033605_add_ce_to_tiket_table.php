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
        Schema::table('tiket', function (Blueprint $table) {
            $table->string('ce')->nullable()->after('plan_actions');
        });
    }

    public function down()
    {
        Schema::table('tiket', function (Blueprint $table) {
            $table->dropColumn('ce');
        });
    }
};
