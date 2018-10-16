<?php

namespace App\Http\Middleware;

use Closure;

/**
 * Class RemoveFaqQueryString
 * @package App\Http\Middleware
 * Removes empty query string from url
 */
class RemoveFaqQueryString
{
    public function handle($request, Closure $next)
    {
        if ($request->route()->getName() === 'page.faq') {
            if ($request->has('q')) {
                if (is_null($request->get('q'))) {
                    return redirect()->route('page.faq');
                }

            }
        }

        return $next($request);
    }
}
