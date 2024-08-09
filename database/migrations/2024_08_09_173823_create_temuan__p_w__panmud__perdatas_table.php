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
        Schema::create('temuan__p_w__panmud__perdatas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_temuan');
            $table->enum('jenis', ['Temuan Mingguan', 'Temuan Bulanan']);
            $table->string('file_path');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('temuan__p_w__panmud__perdatas');
    }
};
