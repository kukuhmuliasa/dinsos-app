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
    Schema::create('profiles', function (Blueprint $table) {
        $table->id();
        $table->string('type'); // Untuk membedakan 'visi_misi' atau 'struktur_organisasi'
        $table->string('title');
        $table->text('visi')->nullable(); // Kolom khusus Visi
        $table->text('misi')->nullable(); // Kolom khusus Misi
        $table->string('image')->nullable(); // Untuk foto struktur organisasi
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
