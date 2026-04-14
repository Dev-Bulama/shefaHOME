<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

/**
 * Repair page_contents rows whose type was incorrectly overwritten
 * with 'text' by the PageContentController save action.
 *
 * Rules applied by key name (same logic used in the seeders):
 *   key = 'visible'    → type = 'boolean'
 *   key = 'image'      → type = 'image'
 *   key = 'button_url' → type = 'url'
 *   key ends in '_url' → type = 'url'
 *   key = 'description'→ type = 'textarea'
 *   key = 'subtitle'   → type = 'textarea'  (only if currently 'text')
 */
return new class extends Migration
{
    public function up(): void
    {
        // Boolean fields
        DB::table('page_contents')
            ->where('key', 'visible')
            ->where('type', 'text')
            ->update(['type' => 'boolean']);

        // Image fields
        DB::table('page_contents')
            ->where('key', 'image')
            ->where('type', 'text')
            ->update(['type' => 'image']);

        // URL fields
        DB::table('page_contents')
            ->where('key', 'button_url')
            ->where('type', 'text')
            ->update(['type' => 'url']);

        // Textarea fields — description
        DB::table('page_contents')
            ->where('key', 'description')
            ->where('type', 'text')
            ->update(['type' => 'textarea']);

        // Textarea fields — subtitle (only the ones that are multi-line by convention)
        // Use sort_order > 30 to avoid accidentally changing single-line subtitles
        DB::table('page_contents')
            ->where('key', 'subtitle')
            ->where('type', 'text')
            ->where('sort_order', '>', 30)
            ->update(['type' => 'textarea']);
    }

    public function down(): void
    {
        // Not reversible — restoring to 'text' would break the picker again
    }
};
