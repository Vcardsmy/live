<?php

namespace App\Http\Middleware;

use App\Models\Analytic;
use App\Models\Vcard;
use Closure;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
use Stevebauman\Location\Facades\Location;

class Analytics
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $uri = str_replace($request->root(), '', $request->url()) ?: '/';
        $data = explode('/', $uri);
        $vcardId = Vcard::select('id')->where('url_alias', $data[2])->pluck('id')->toArray();
        if (! $vcardId) {
            return (abort('404'));
        }

        $agent = new Agent();
        if (! $agent->isRobot()) {
            $agent->setUserAgent($request->headers->get('user-agent'));
            $agent->setHttpHeaders($request->headers);
            $sessionExists = Analytic::where('session', $request->session()->getId())->exists();
            if ($sessionExists) {
                return $next($request);
            }

            $items = implode($agent->languages());
            $lang = substr($items, 0, 2);

            Analytic::create([
                'session'          => $request->session()->getId(),
                'vcard_id'         => $vcardId[0],
                'uri'              => $uri,
                'source'           => $request->headers->get('referer'),
//                'country'          => Location::get($request->ip())->countryName,
                'browser'          => $agent->browser() ?? null,
                'device'           => $agent->deviceType(),
                'operating_system' => $agent->platform(),
                'ip'               => $request->ip(),
                'language'         => $lang,
                'meta'             => json_encode(Location::get($request->ip())),
            ]);

            return $next($request);
        }

        return $next($request);
    }
}
