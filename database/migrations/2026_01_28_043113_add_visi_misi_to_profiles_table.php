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
        // Menambahkan kolom visi dan misi ke tabel yang sudah ada
        $table->text('visi')->after('type')->nullable(); 
        $table->text('misi')->after('visi')->nullable();
    });
}

public function down(): void
{
    Schema::table('profiles', function (Blueprint $table) {
        $table->dropColumn(['visi', 'misi']);
    });
}
};
