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
        Schema::create('temuan__p_w__panmud__hukums', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Menambahkan kolom user_id
            $table->string('nama')->nullable(); // Menambahkan kolom nama
            $table->string('nip')->nullable();  // Menambahkan kolom nip
            $table->string('bidang')->nullable(); // Menambahkan kolom bidang
            $table->string('role')->nullable(); // Menambahkan kolom role
            $table->string('nama_temuan');
            $table->string('file_path');
            $table->timestamps();

            // Menambahkan foreign key constraint (Opsional, jika Anda ingin menghubungkannya dengan tabel users)
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('temuan__p_w__panmud__hukums');
    }
};
