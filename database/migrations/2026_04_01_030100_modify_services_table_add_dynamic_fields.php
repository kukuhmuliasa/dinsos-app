<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->foreignId('category_id')->nullable()->after('id')
                  ->constrained('service_categories')->nullOnDelete();
            $table->text('short_description')->nullable()->after('slug');
            $table->string('badge_text')->nullable()->after('icon');
            $table->string('badge_color')->default('yellow')->after('badge_text');
            $table->text('contact_info')->nullable()->after('badge_color');
            $table->boolean('is_featured')->default(false)->after('is_active');
            $table->integer('sort_order')->default(0)->after('is_featured');
        });

        Schema::table('services', function (Blueprint $table) {
            $table->longText('description')->nullable()->change();
            $table->text('requirements')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropColumn([
                'category_id', 'short_description', 'badge_text',
                'badge_color', 'contact_info', 'is_featured', 'sort_order'
            ]);
        });
    }
};
