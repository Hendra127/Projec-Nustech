<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('slas', function (Blueprint $table) {
            $table->id();
            $table->string('site_id')->nullable();
            $table->string('nama_lokasi')->nullable();
            $table->string('snmp_modem')->nullable();
            $table->string('snmp_router')->nullable();
            $table->string('snmp_ap1')->nullable();
            $table->string('snmp_ap2')->nullable();
            $table->decimal('rata_rata_perangkat', 5, 2)->nullable();
            $table->decimal('rata_rata_ap1_ap2', 5, 2)->nullable();
            $table->string('uptime_zabbix')->nullable();
            $table->string('uptime_perhari')->nullable();
            $table->integer('uptime_perhari_menit')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('slas');
    }
};
