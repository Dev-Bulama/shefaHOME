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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->foreignId('property_type_id')->constrained('property_types')->cascadeOnDelete();
            $table->foreignId('estate_id')->nullable()->constrained('estates')->nullOnDelete();
            $table->text('short_description');
            $table->longText('description');
            $table->string('state');
            $table->string('lga');
            $table->string('address');
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->decimal('price_from', 15, 2);
            $table->decimal('price_to', 15, 2)->nullable();
            $table->string('plot_sizes')->nullable();
            $table->text('payment_plans')->nullable();
            $table->string('cover_image');
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->enum('status', ['available', 'sold_out', 'coming_soon'])->default('available');
            $table->string('virtual_tour_url')->nullable();
            $table->string('video_url')->nullable();
            $table->integer('total_units')->nullable();
            $table->integer('available_units')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
