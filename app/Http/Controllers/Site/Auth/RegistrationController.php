<?php

namespace App\Http\Controllers\Site\Auth;

use App\User;
use App\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegistrationController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware( 'guest' );
    }

    public function showRegistrationForm() {
        return view( 'site.registration', ['user' => auth()->user()] );
    }

    /**
     * @param Request $request
     */
    public function handleRegistration( Request $request ) {
        $validatedData = $request->validate( [
            'first_name' => 'required|max:255',
            'last_name'  => 'required|max:255',
            'email'      => 'required|email|max:255',
            'password'   => 'required|string|min:6|confirmed',
        ] );

        $user = User::where( [
            ['email', $request->email],
        ] )->first();

        if ( $user ) {
            return redirect()->back();
        }

        $user             = new User;
        $user->first_name = $request->first_name;
        $user->last_name  = $request->last_name;
        $user->email      = $request->email;
        $user->password   = bcrypt( $request->password );
        $user->save();
        

        $customer = new Customer;

        $customer->assignUser( $user );

        site()->customers()->save( $customer );

        auth()->login( $user, true );

        //@todo emit event
        //@todo create new billing - trial period
        //@todo send verification/welcome email

        // authenticate user and redirect

        return redirect()->route( 'site.home', ['domain' => domain()] );
    }
}
