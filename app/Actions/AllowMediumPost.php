<?php

namespace App\Actions;

use Illuminate\Support\Str;

class AllowMediumPost
{
    public static function transform(string $html): string
    {
        $identifier = Str::match('/main\.([abcdef0-9]+)\.js/', $html);

        $jsIntruder = "main.$identifier.js";
        $html = Str::replace($jsIntruder, "" , $html);

        return $html;
    }
}
