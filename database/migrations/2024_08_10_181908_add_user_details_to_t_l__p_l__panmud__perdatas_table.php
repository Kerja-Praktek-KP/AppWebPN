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
        Schema::table('t_l__p_l__panmud__perdatas', function (Blueprint $table) {
            $table->string('nama')->nullable();
            $table->string('nip')->nullable();
            $table->string('bidang')->nullable();
            $table->string('role')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('t_l__p_l__panmud__perdatas', function (Blueprint $table) {
            $table->dropColumn(['nama', 'nip', 'bidang', 'role']);
        });
    }
};
