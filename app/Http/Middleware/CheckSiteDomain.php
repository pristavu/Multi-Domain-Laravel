<?php

namespace App\Http\Middleware;

use Closure;

class CheckSiteDomain {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle( $request, Closure $next ) {

        $domain = $request->route( 'domain' );

        $site = \App\Site::where( 'domain', $domain )->first();

        if ( ! $site ) {
            // @todo redirect to not exists page
            return redirect()->route( 'app.home' );
        }

        // @todo:

        // 1. Is not active -> redirect to not active page
        // 2. Is not exists ->
        //   if (!$shop->is_active) {
        //       return 'NOT ACTIVE';
        //   }

        return $next( $request );
    }
}
