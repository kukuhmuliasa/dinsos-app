<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('service_legal_bases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained()->cascadeOnDelete();
            $table->string('regulation_number');    // Kepmen No 79/HUK/2025
            $table->string('regulation_title');
            $table->string('regulation_type')->default('Kepmen'); // Kepmen/Perda/PP/UU
            $table->integer('year')->nullable();
            $table->string('document_url')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_legal_bases');
    }
};
