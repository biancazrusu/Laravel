<?php

namespace App\Http\Middleware;

use App\Models\Website;
use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;

class WebsiteLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $website = $this->getWebsite($request);
        $this->setLocale($website->locale);

        return $next($request);
    }

    protected function getWebsite($request)
    {
        $website = Website::first();
        foreach (Website::all() as $website) {
            if (URL::to('/') == $website->url) {
                return $website;
            }
        }
        return $website;
    }

    protected function setLocale($locale)
    {
        App::setLocale($locale);
    }
}
