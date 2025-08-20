<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Helpers
{
    public static function storeImage($file, $function = 'default', $disk = 'public')
    {
        $date = now()->format('d');
        $month   = now()->format('m');
        $year   = now()->format('Y');

        $folder = "images/{$year}/{$month}/{$date}/{$function}";

        $extension = $file->getClientOriginalExtension();
        $encryptedName = Str::random(40) . '.' . $extension;

        $path = $file->storeAs($folder, $encryptedName, $disk);
        return $path;
    }

    public static function getBadges(array $items, array $colorMap = [], string $defaultClass = 'badge-light-secondary'): string
    {
        $html = '';
        foreach ($items as $item) {
            $class = $colorMap[$item] ?? $defaultClass;
            $html .= '<span class="badge ' . $class . '">' . $item . '</span> ';
        }
        return trim($html);
    }
}
