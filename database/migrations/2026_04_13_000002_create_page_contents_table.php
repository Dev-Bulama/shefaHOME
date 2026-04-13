<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('page_contents', function (Blueprint $table) {
            $table->id();
            $table->string('page');          // e.g. home, about, services
            $table->string('section');       // e.g. hero, why-us, cta
            $table->string('key');           // e.g. title, subtitle, body
            $table->string('label');         // human-readable label for admin
            $table->longText('value')->nullable();
            $table->string('type')->default('text'); // text | textarea | html | image | url
            $table->integer('sort_order')->default(0);
            $table->timestamps();

            $table->unique(['page','section','key']);
            $table->index(['page','section']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('page_contents');
    }
};
