<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nip')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('role', ['Super Admin', 'Pemberi Laporan', 'Pengawas', 'Koordinator Pengawas', 'Pimpinan']);
            $table->enum('bidang', ['Panmud Perdata', 'Panmud Pidana', 'Panmud Tipikor', 'Panmud PHI', 'Panmud Hukum', 'Sub Bag. Perencanaan, TI, dan Pelaporan', 'Sub Bag. Kepegawaian dan Ortala', 'Sub Bag. Umum dan Keuangan'])->nullable();
            $table->string('profile_picture')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};
