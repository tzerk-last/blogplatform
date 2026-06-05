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
    Schema::create('tenant_users', function (Blueprint $table) {
        $table->string('tenant_id');
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->foreign('tenant_id')->references('id')->on('tenants')->onDelete('cascade');
        $table->primary(['tenant_id', 'user_id']);
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenant_users');
    }
};
