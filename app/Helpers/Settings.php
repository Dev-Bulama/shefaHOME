<?php

namespace App\Helpers;

use App\Models\SiteSetting;
use Illuminate\Support\Facades\Cache;

class Settings
{
    public static function get(string $key, $default = null)
    {
        return Cache::remember("setting_{$key}", 3600, function () use ($key, $default) {
            return SiteSetting::where('key', $key)->value('value') ?? $default;
        });
    }

    public static function set(string $key, $value, string $group = 'general'): void
    {
        SiteSetting::updateOrCreate(
            ['key' => $key],
            ['value' => $value, 'group' => $group]
        );
        Cache::forget("setting_{$key}");
    }

    public static function all(string $group = null): array
    {
        $query = SiteSetting::query();
        if ($group) {
            $query->where('group', $group);
        }
        return $query->pluck('value', 'key')->toArray();
    }
}
