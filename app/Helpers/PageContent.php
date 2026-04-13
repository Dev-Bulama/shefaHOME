<?php
namespace App\Helpers;

use App\Models\PageContent as PageContentModel;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;

class PageContent
{
    protected static array $cache = [];

    public static function get(string $page, string $key, string $default = ''): string
    {
        $cacheKey = "{$page}.{$key}";

        if (!isset(static::$cache[$cacheKey])) {
            try {
                if (!Schema::hasTable('page_contents')) {
                    return $default;
                }
                [$section, $field] = array_pad(explode('.', $key, 2), 2, $key);
                $record = PageContentModel::where('page', $page)
                    ->where('section', $section)
                    ->where('key', $field ?? $section)
                    ->first();
                static::$cache[$cacheKey] = $record ? ($record->value ?? $default) : $default;
            } catch (\Throwable $e) {
                return $default;
            }
        }

        return static::$cache[$cacheKey];
    }

    public static function getPage(string $page): array
    {
        try {
            if (!Schema::hasTable('page_contents')) {
                return [];
            }
            $rows = PageContentModel::where('page', $page)->orderBy('sort_order')->get();
            $data = [];
            foreach ($rows as $row) {
                $data[$row->section][$row->key] = $row->value;
            }
            return $data;
        } catch (\Throwable $e) {
            return [];
        }
    }

    public static function flushCache(): void
    {
        static::$cache = [];
    }
}
