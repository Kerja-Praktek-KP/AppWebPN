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
        Schema::table('t_l__p_l__sub__bag__umum_dan__keuangans', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->after('file_path');
            $table->string('nama')->nullable()->after('user_id');
            $table->string('nip')->nullable()->after('nama');
            $table->string('bidang')->nullable()->after('nip');
            $table->string('role')->nullable()->after('bidang');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('t_l__p_l__sub__bag__umum_dan__keuangans', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn(['user_id', 'nama', 'nip', 'bidang', 'role']);
        });
    }
};
