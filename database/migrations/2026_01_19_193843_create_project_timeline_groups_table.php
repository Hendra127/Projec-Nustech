<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectTimelineGroupsTable extends Migration
{
    public function up()
    {
        Schema::create('project_timeline_groups', function (Blueprint $table) {
            $table->id();
            $table->string('group_name');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('project_timeline_groups');
    }
}
