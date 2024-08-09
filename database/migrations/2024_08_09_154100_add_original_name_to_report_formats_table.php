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
        Schema::table('report_formats', function (Blueprint $table) {
            $table->string('original_name')->nullable(); // Menambahkan kolom original_name yang dapat bernilai NULL
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('report_formats', function (Blueprint $table) {
            $table->dropColumn('original_name'); // Menghapus kolom jika migrasi dibatalkan
        });
    }
};
