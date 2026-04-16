<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

/**
 * Ensures plot_sizes for all properties is stored as a clean JSON array of strings.
 * Handles cases where values were double-encoded or stored in non-standard formats.
 */
return new class extends Migration
{
    public function up(): void
    {
        $properties = DB::table('properties')->whereNotNull('plot_sizes')->get(['id', 'plot_sizes']);

        foreach ($properties as $property) {
            $raw = $property->plot_sizes;

            // Decode once
            $decoded = json_decode($raw, true);

            if (!is_array($decoded)) {
                // Not an array after one decode — skip
                continue;
            }

            // Re-decode each element if it's itself a JSON string (double-encoded elements)
            $clean = [];
            foreach ($decoded as $item) {
                if (is_string($item)) {
                    $inner = json_decode($item, true);
                    if (is_string($inner)) {
                        // Was double-encoded string like "\"300sqm\""
                        $clean[] = trim($inner, '"');
                    } elseif (is_array($inner)) {
                        // Was a JSON array string like "[\"300sqm\"]"
                        foreach ($inner as $sub) {
                            $clean[] = is_string($sub) ? $sub : (string)$sub;
                        }
                    } else {
                        // Normal string
                        $clean[] = trim($item, '"');
                    }
                } else {
                    $clean[] = (string)$item;
                }
            }

            $newJson = json_encode(array_values(array_filter($clean)));

            if ($newJson !== $raw) {
                DB::table('properties')->where('id', $property->id)->update(['plot_sizes' => $newJson]);
            }
        }
    }

    public function down(): void {}
};
