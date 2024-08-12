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
        if (!Schema::hasTable('t_l__p_w__sub__bag__perencanaan__t_i_dan__pelaporans')) {
            Schema::create('t_l__p_w__sub__bag__perencanaan__t_i_dan__pelaporans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Menambahkan kolom user_id
            $table->string('nama')->nullable(); // Menambahkan kolom nama
            $table->string('nip')->nullable();  // Menambahkan kolom nip
            $table->string('bidang')->nullable(); // Menambahkan kolom bidang
            $table->string('role')->nullable(); // Menambahkan kolom role
            $table->string('nama_laporan');
            $table->enum('jenis', ['Laporan Mingguan', 'Laporan Bulanan']);
            $table->string('bulan');
            $table->string('minggu')->nullable();
            $table->string('file_path');
            $table->timestamps();
            });
        }
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_l__p_w__sub__bag__perencanaan__t_i_dan__pelaporans');
    }
};
