<?php

namespace App\Support;

class Text
{
    /**
     * Split a text box into lines. Each non-empty line becomes one bullet point.
     */
    public static function lines(?string $text): array
    {
        if ($text === null || trim($text) === '') {
            return [];
        }

        $lines = preg_split('/\r\n|\r|\n/', $text);

        return array_values(array_filter(array_map('trim', $lines), fn ($line) => $line !== ''));
    }

    /**
     * Split "PHP, Laravel, MySQL" into ['PHP', 'Laravel', 'MySQL'].
     */
    public static function csv(?string $text): array
    {
        if ($text === null || trim($text) === '') {
            return [];
        }

        return array_values(array_filter(array_map('trim', explode(',', $text)), fn ($item) => $item !== ''));
    }
}
