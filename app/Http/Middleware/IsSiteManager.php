<?php

namespace App\Http\Middleware;

use Closure;

class IsSiteManager {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle( $request, Closure $next ) {
        $domain = $request->route( 'domain' );

        if ( auth()->check() && auth()->user()->isSiteManager() ) {
            return $next( $request );
        }

        if ( $domain ) {
            return redirect()->route( 'site.home', ['domain' => $domain] );
        }

        return redirect()->route( 'app.home' );
    }
}
