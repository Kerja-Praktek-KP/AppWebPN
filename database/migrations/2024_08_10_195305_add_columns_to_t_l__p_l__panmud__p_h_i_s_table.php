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
        Schema::table('t_l__p_l__panmud__p_h_i_s', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->after('file_path'); // Menambahkan kolom user_id
            $table->string('nama')->nullable()->after('user_id'); // Menambahkan kolom nama
            $table->string('nip')->nullable()->after('nama'); // Menambahkan kolom nip
            $table->string('bidang')->nullable()->after('nip'); // Menambahkan kolom bidang
            $table->string('role')->nullable()->after('bidang'); // Menambahkan kolom role

            // Menambahkan foreign key constraint (Opsional)
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('t_l__p_l__panmud__p_h_i_s', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn(['user_id', 'nama', 'nip', 'bidang', 'role']);
        });
    }
};
