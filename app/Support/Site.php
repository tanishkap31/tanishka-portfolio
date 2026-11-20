<?php

namespace App\Support;

use App\Models\Profile;
use App\Models\Setting;

/**
 * Gives every page the profile and the website settings, loaded once per request.
 */
class Site
{
    protected static ?array $settings = null;

    protected static ?Profile $profile = null;

    public static function defaults(): array
    {
        return [
            'site_title' => 'Tanishka Patil',
            'meta_description' => 'Portfolio of Tanishka Patil, a frontend and Laravel developer in Mumbai.',
            'footer_text' => '',
            'notify_email' => '',
            'default_theme' => 'auto', // auto, light or dark
            'logo' => '',
        ];
    }

    public static function settings(): array
    {
        if (static::$settings === null) {
            $saved = Setting::pluck('value', 'name')->all();
            $saved = array_filter($saved, fn ($value) => $value !== null && $value !== '');
            static::$settings = array_merge(static::defaults(), $saved);
        }

        return static::$settings;
    }

    public static function setting(string $key, $default = null)
    {
        return static::settings()[$key] ?? $default;
    }

    public static function profile(): Profile
    {
        if (static::$profile === null) {
            static::$profile = Profile::first() ?? new Profile([
                'name' => 'Your Name',
                'headline' => 'Your headline',
                'email' => '',
            ]);
        }

        return static::$profile;
    }

    public static function logoUrl(): ?string
    {
        return Uploads::url(static::setting('logo'));
    }

    public static function flush(): void
    {
        static::$settings = null;
        static::$profile = null;
    }
}
