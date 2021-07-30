<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;

class MediumController extends Controller
{

    public function index()
    {
        $url = request()->get('url');
        $resultado = Cache::get($url);
        if(!$resultado) {
            $resultado = $this->getHtml($url);
        }
        $resultado = gzuncompress($resultado);
        $identifier = Str::match('/main\.([abcdef0-9]+)\.js/', $resultado);
        $jsIntruder = "main.$identifier.js";
        $resultado = Str::replace($jsIntruder, "" , $resultado);
        return view('home', ['resultado' => $resultado]);
    }

    private function getHtml($url)
    {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION , $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $resp = curl_exec($curl);
        curl_close($curl);

        $comprimido = gzcompress($resp);
        Cache::put($url, $comprimido, Carbon::now()->addDays(5));
        return $comprimido;
    }
}
