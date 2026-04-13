<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('navigation_menus', function (Blueprint $table) {
            $table->id();
            $table->string('label');
            $table->string('url');
            $table->string('location')->default('header'); // header | footer | both
            $table->unsignedBigInteger('parent_id')->nullable(); // for sub-items
            $table->integer('sort_order')->default(0);
            $table->boolean('opens_new_tab')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('navigation_menus');
    }
};
