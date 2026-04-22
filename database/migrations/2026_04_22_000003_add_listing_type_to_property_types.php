<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('property_types', function (Blueprint $table) {
            $table->string('listing_type', 20)->nullable()->default(null)
                  ->after('description')
                  ->comment('Categorises this type: rent | buy | buy_and_rent | shortlet | null = all');
        });
    }

    public function down(): void
    {
        Schema::table('property_types', function (Blueprint $table) {
            $table->dropColumn('listing_type');
        });
    }
};
