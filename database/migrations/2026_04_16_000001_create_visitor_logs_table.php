<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('visitor_logs', function (Blueprint $table) {
            $table->id();
            $table->string('session_id', 64)->nullable();
            $table->string('ip', 45)->nullable();
            $table->string('country', 100)->nullable()->default('Nigeria');
            $table->string('state', 100)->nullable();
            $table->string('city', 100)->nullable();
            $table->string('page', 500)->nullable();
            $table->string('page_title', 255)->nullable();
            $table->string('referrer', 500)->nullable();
            $table->string('browser', 100)->nullable();
            $table->string('device', 50)->nullable();
            $table->boolean('is_bot')->default(false);
            $table->timestamps();
            $table->index(['created_at']);
            $table->index(['session_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visitor_logs');
    }
};
