<?php

if ( ! function_exists( 'site' ) ) {
    /**
     * Get site by domain
     *
     * @param null $domain
     * @return \App\Site
     */

    function site( $domain = null ) {
        $domain = $domain ?: request()->route( 'domain' );
        $site   = \App\Site::where( 'domain', $domain )->first();

        if ( ! $site ) {
            return new \App\Site;
        }

        return $site;
    }
}

if ( ! function_exists( 'domain' ) ) {
    /**
     * Get current domain
     *
     * @param null $domain
     * @return \App\Shop
     */

    function domain() {
        $domain = request()->route( 'domain' );

        return $domain;
    }
}

if ( ! function_exists( 'domain_route' ) ) {
    /**
     * Generate the URL to a named route.
     * This is a modified version of Laravel's route() function
     * Pass domain value automatically
     *
     * @param  array|string $name
     * @param  mixed $parameters
     * @param  bool $absolute
     * @return string
     */
    function domain_route( $name, $parameters = [], $absolute = true ) {
        $parameters['domain'] = request()->route( 'domain' );

        return app( 'url' )->route( $name, $parameters, $absolute );
    }
}
