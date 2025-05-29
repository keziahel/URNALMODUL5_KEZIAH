<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mata_kuliahs', function (Blueprint $table) {
            $table->id();               // Kolom ID auto increment
            $table->string('nama');     // Kolom nama mata kuliah (string)
            $table->string('kode')->unique(); // Kolom kode mata kuliah, harus unik
            $table->integer('sks');     // Kolom SKS (integer)
            $table->timestamps();       // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mata_kuliahs');
    }
};
