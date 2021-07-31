<?php

namespace App\Http\Controllers;

use App\Actions\AllowMediumPost;
use App\Actions\CompresionHtml;
use App\Http\Rules\MediumRule;
use App\Services\curlServiceContract;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class MediumController extends Controller
{
    public function __invoke(Request $request, curlServiceContract $curl)
    {
        $this->validate($request, [
            'url' => ['required','url', new MediumRule]
        ]);

        $url = $request->url;

        $htmlCompressed = Cache::get($url);

        if(!$htmlCompressed) {
            $content = $curl->getHtml($url);
            $htmlCompressed = CompresionHtml::compress($content);
            Cache::put($url, $htmlCompressed, Carbon::now()->addDays(5));
        }

        $html = CompresionHtml::uncompress($htmlCompressed);
        $html = AllowMediumPost::transform($html);

        return view('home', ['resultado' => $html]);
    }
}
