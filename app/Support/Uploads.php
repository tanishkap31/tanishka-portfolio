<?php

namespace App\Support;

use Illuminate\Support\Facades\Storage;

/**
 * Small helper for files uploaded from the admin panel.
 * Files are saved on the "public" disk (storage/app/public) and served from /storage.
 */
class Uploads
{
    public static function delete(?string $path): void
    {
        if ($path) {
            Storage::disk('public')->delete($path);
        }
    }

    public static function url(?string $path): ?string
    {
        // asset() uses the address the visitor opened, so images also work on php artisan serve (port 8000).
        return $path ? asset('storage/' . $path) : null;
    }
}
