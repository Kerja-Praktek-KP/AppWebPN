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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nip')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('role', ['super_admin', 'pemberi_laporan', 'pengawas', 'koordinator_pengawas', 'pimpinan']);
            $table->enum('bidang', ['Panmud Perdata', 'Panmud Pidana', 'Panmud Tipikor', 'Panmud PHI', 'Panmud Hukum', 'Sub Bag. Perencanaan, TI, dan Pelaporan', 'Sub Bag. Kepegawaian dan Ortala', 'Sub Bag. Umum dan Keuangan']);
            $table->string('profile_picture')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};
