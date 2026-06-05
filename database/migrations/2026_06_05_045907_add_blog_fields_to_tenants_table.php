<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tenants', function (Blueprint $table) {
            $table->string('blog_name')->nullable();
            $table->text('bio')->nullable();
            $table->string('avatar')->nullable();
            $table->string('bg_color')->default('#ffffff');
            $table->string('text_color')->default('#111111');
            $table->string('accent_color')->default('#3b82f6');
            $table->string('font')->default('Inter');
            $table->boolean('is_active')->default(true);
        });
    }

    public function down(): void
    {
        Schema::table('tenants', function (Blueprint $table) {
            $table->dropColumn([
                'blog_name', 'bio', 'avatar',
                'bg_color', 'text_color', 'accent_color',
                'font', 'is_active'
            ]);
        });
    }
};