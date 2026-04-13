<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ImageService
{
    public static function upload(UploadedFile $file, string $folder = 'uploads', int $maxWidth = 1200): string
    {
        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
        $path = $folder . '/' . $filename;

        try {
            $manager = new ImageManager(new Driver());
            $image   = $manager->read($file->getRealPath());

            if ($image->width() > $maxWidth) {
                $image->scaleDown(width: $maxWidth);
            }

            Storage::disk('public')->put($path, $image->toJpeg(85));
        } catch (\Throwable $e) {
            // Fallback: store as-is (handles missing GD driver or Intervention v2/v3 mismatch)
            Storage::disk('public')->putFileAs($folder, $file, $filename);
        }

        return $path;
    }

    public static function delete(string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }

    public static function uploadMultiple(array $files, string $folder = 'uploads'): array
    {
        $paths = [];
        foreach ($files as $file) {
            if ($file instanceof UploadedFile) {
                $paths[] = self::upload($file, $folder);
            }
        }
        return $paths;
    }
}
