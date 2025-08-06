<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewprojectsTable extends Migration
{
    public function up()
    {
        Schema::create('newprojects', function (Blueprint $table) {
            $table->id();
            $table->string('no')->nullable();
            $table->string('site_id')->nullable();
            $table->string('sitename')->nullable();
            $table->string('tipe')->nullable();
            $table->string('batch')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('provinsi')->nullable();
            $table->string('kab')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kelurahan')->nullable();
            $table->text('alamat_lokasi')->nullable();
            $table->string('nama_pic')->nullable();
            $table->string('nomor_pic')->nullable();
            $table->string('sumber_listrik')->nullable();
            $table->string('gateway_area')->nullable();
            $table->string('beam')->nullable();
            $table->string('hub')->nullable();
            $table->string('kodefikasi')->nullable();
            $table->string('sn_antena')->nullable();
            $table->string('sn_modem')->nullable();
            $table->string('sn_router')->nullable();
            $table->string('sn_ap1')->nullable();
            $table->string('sn_ap2')->nullable();
            $table->string('sn_tranciever')->nullable();
            $table->string('sn_stabilizer')->nullable();
            $table->string('sn_rak')->nullable();
            $table->string('ip_modem')->nullable();
            $table->string('ip_router')->nullable();
            $table->string('ip_ap1')->nullable();
            $table->string('ip_ap2')->nullable();
            $table->string('expected_sqf')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('newprojects');
    }
}
