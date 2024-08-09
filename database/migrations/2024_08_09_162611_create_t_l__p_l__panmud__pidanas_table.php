<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('t_l__p_l__panmud__pidanas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_laporan');
            $table->enum('jenis', ['Laporan Mingguan', 'Laporan Bulanan', 'TLHP Mingguan', 'TLHP Bulanan']);
            $table->string('file_path');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_l__p_l__panmud__pidanas');
    }
};
