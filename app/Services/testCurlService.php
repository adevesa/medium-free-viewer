<?php

namespace App\Services;

class testCurlService implements curlServiceContract
{
    public function getHtml(string $url): string
    {
        return file_get_contents(__DIR__.'/a-medium-html-file.html');
    }
}
