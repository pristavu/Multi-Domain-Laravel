<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */
Route::get( 'set_cookie', function () {
    return response( base64_decode( 'iVBORw0KGgoAAAANSUhEUgAAAAEAAAABAQMAAAAl21bKAAAAA1BMVEUAAACnej3aAAAAAXRSTlMAQObYZgAAAApJREFUCNdjYAAAAAIAAeIhvDMAAAAASUVORK5CYII=' ), 200 )->header( 'Content-Type', 'image/png' );
    /* Returns 1px transparent image */
} );
Route::get( '/demo', 'DemoController@home' )->name( 'home' );
/* GENERAL APP : LOGIN, REGISTRATION AND SIMPLE DASHBOARD*/
Route::group(
    [
        'domain' => 'app.' . config( 'app.domain' ),
        'as'     => 'app.',
    ],
    function () {
        Route::get( '/', 'DashboardController@home' )->name( 'home' );

        Route::get( '/login', 'Auth\LoginController@showLoginForm' )->name( 'login' );
        Route::post( '/login', 'Auth\LoginController@handleLogin' )->name( 'login.post' );
        Route::get( '/registration', 'Auth\RegistrationController@showRegistrationForm' )->name( 'registration' );
        Route::post( '/registration', 'Auth\RegistrationController@handleRegistration' )->name( 'registration.post' );
        Route::post( '/logout', 'Auth\LoginController@logout' )->name( 'logout' );
    }
);

/* SUPER ADMIN : SERVICE MANAGEMENT */
Route::group(
    [
        'domain'     => 'admin.' . config( 'app.domain' ),
        'middleware' => ['auth', 'app.is_admin'],
        'as'         => 'admin.',
    ],
    function () {
        Route::get( '/', 'Admin\DashboardController@home' )->name( 'home' );

        // @todo: Metrics, Billing/Subscription Management, etc
    }
);

/* SITES ROUTES */
Route::group(
    [
        //'domain'     => '{subdomain}.' . config( 'app.domain' ),
        'domain'     => '{domain}',
        'middleware' => 'site.domain',
        'as'         => 'site.',
    ], function () {
        // Site frontend
        Route::get( '/', 'Site\PageController@home' )->name( 'home' );

        // @todo: products, cart, checkout, etc
        // @todo: customer account, orders history, order details, settings

        // Authentication and registration
        Route::get( '/login', 'Site\Auth\LoginController@showLoginForm' )->name( 'login' );
        Route::post( '/login', 'Site\Auth\LoginController@handleLogin' )->name( 'login.post' );
        Route::get( '/registration', 'Site\Auth\RegistrationController@showRegistrationForm' )->name( 'registration' );
        Route::post( '/registration', 'Site\Auth\RegistrationController@handleRegistration' )->name( 'registration.post' );
        Route::post( '/logout', 'Site\Auth\LoginController@logout' )->name( 'logout' );

        // SITES MANAGEMENT
        Route::group(
            [
                'prefix'     => 'admin',
                'middleware' => ['auth', 'site.is_manager'],
                'as'         => 'admin.',
            ],
            function () {

                Route::get( '/', 'Site\Admin\DashboardController@home' )->name( 'home' );

                // @todo: orders, customers, staff members, etc

            }
        );

    }
);
