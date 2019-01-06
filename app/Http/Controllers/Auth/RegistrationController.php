<?php

namespace App\Http\Controllers\Auth;

use App\Site;
use App\User;
use App\Manager;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller {

    public function showRegistrationForm() {
        return view( 'app.registration' );
    }

    /**
     * @param Request $request
     */
    public function handleRegistration( Request $request ) {

        $rules = [
            'company_name'   => 'required|max:255',
            'company_domain' => 'required|max:255',
        ];

        if ( auth()->guest() ) {
            $rules['first_name'] = 'required|string|max:255';
            $rules['last_name']  = 'required|string|max:255';
            $rules['email']      = 'required|email|max:255';
            $rules['password']   = 'required|string|min:6|confirmed';
        }

        $validatedData = $request->validate( $rules );

        $site               = new Site;
        $site->domain       = $request->company_domain;
        $site->company_name = $request->company_name;
        $site->is_active    = 1; // @todo: activate the site via email confirmation
        $site->save();

        if ( auth()->check() ) {
            $user = auth()->user();
        } else {
            $user             = new User;
            $user->first_name = $request->first_name;
            $user->last_name  = $request->last_name;
            $user->email      = $request->email;
            $user->password   = bcrypt( $request->password );
            $user->save();
        }

        $owner           = new Manager;
        $owner->is_owner = 1;
        $owner->assignUser( $user );

        $site->owners()->save( $owner );

        auth()->login( $user, true );

        //@todo emit event
        //@todo create new billing - trial period
        //@todo send verification/welcome email etc

        // authenticate user and redirect

        return redirect()->route( 'site.home', ['domain' => $site->domain] );
    }
}
