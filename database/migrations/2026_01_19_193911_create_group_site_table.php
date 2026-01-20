<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupSiteTable extends Migration
{
    public function up()
    {
        Schema::create('group_site', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('group_id');
            $table->unsignedBigInteger('project_site_id');
            $table->string('status')->default('pending'); // pending/progress/done
            $table->timestamps();

            $table->foreign('group_id')->references('id')->on('project_timeline_groups')->onDelete('cascade');
            $table->foreign('project_site_id')->references('id')->on('project_sites')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('group_site');
    }
}
