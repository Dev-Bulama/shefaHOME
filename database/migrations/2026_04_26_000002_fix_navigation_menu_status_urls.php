<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        DB::table('navigation_menus')
            ->where('url', '/properties?status=for_sale')
            ->update(['url' => '/properties?status=buy']);

        DB::table('navigation_menus')
            ->where('url', '/properties?status=for_rent')
            ->update(['url' => '/properties?status=rent']);
    }

    public function down(): void
    {
        DB::table('navigation_menus')
            ->where('url', '/properties?status=buy')
            ->whereIn('label', ['For Sale'])
            ->update(['url' => '/properties?status=for_sale']);

        DB::table('navigation_menus')
            ->where('url', '/properties?status=rent')
            ->whereIn('label', ['For Rent'])
            ->update(['url' => '/properties?status=for_rent']);
    }
};
