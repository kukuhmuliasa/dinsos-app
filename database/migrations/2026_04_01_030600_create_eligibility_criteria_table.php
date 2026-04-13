<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('eligibility_criteria', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained()->cascadeOnDelete();
            $table->string('criteria_name');        // Desil, Penghasilan, Usia, dll
            $table->string('criteria_type');         // desil, income, age, status
            $table->string('operator')->default('<='); // <=, >=, ==, between
            $table->string('value');                 // 1-4, 5000000, 60
            $table->text('display_label')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('eligibility_criteria');
    }
};
