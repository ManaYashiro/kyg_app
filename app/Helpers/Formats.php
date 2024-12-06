<?php

namespace App\Helpers;


class Formats
{
    public static $baseTitle = 'Laravel';

    public static function title(): string
    {
        $title = config('app.title', self::$baseTitle);
        if ($title === self::$baseTitle) {
            $title = config('app.name', self::$baseTitle);
        }
        return $title;
    }
}
