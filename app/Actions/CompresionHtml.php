<?php

namespace App\Actions;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class CompresionHtml
{
    public static function compress(string $html): string
    {
        return gzcompress($html);
    }

    public static function uncompress(string $htmlCompressed): string
    {
        return gzuncompress($htmlCompressed);
    }
}
