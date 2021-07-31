<?php

namespace App\Services;

interface curlServiceContract
{
    public function getHtml(string $url): string;
}
