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
        Schema::table('profiles', function (Blueprint $table) {
            // Kita beri tanda // di depan agar baris ini DIABAIKAN oleh Laravel
            // $table->text('visi')->after('type')->nullable(); 
            // $table->text('misi')->after('visi')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            // Ini boleh dibiarkan atau dikomentari juga, tidak berpengaruh saat migrate
            $table->dropColumn(['visi', 'misi']);
        });
    }
};