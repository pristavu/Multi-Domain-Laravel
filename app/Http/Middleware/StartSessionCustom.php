<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Session\Middleware\StartSession;

class StartSessionCustom extends StartSession {

	/**
	 * @var mixed
	 */
	protected $init_cookie = false;
	/**
	 * @param $request
	 * @param Closure $next
	 * @return mixed
	 */
	public function handle( $request, Closure $next ) {
		$this->sessionHandled = true;

		if ( $this->sessionConfigured() ) {
			$session = $this->startSession( $request );
			$request->setSession( $session );
			/*CUSTOM CODE STARTS HERE */
			\Session::forget( 'init_cookie' );

			if ( $this->init_cookie ) {
				session( ['init_cookie' => 1] );
			}

			/* CUSTOM CODE ENDS HERE */
			$this->collectGarbage( $session );
		}

		$response = $next( $request );

		if ( $this->sessionConfigured() ) {
			$this->storeCurrentUrl( $request, $session );
			$this->addCookieToResponse( $response, $session );
		}

		return $response;
	}

	/**
	 * @param Request $request
	 * @return mixed
	 */
	public function getSession( Request $request ) {
		$session = $this->manager->driver();
		/*CUSTOM CODE STARTS HERE */

		if ( $request->has( 'ck' ) ) {
			$session->setId( \Crypt::decrypt( $request->ck ) );
		} else {
			$cookie_from_request = $request->cookies->get( $session->getName() );

			if ( empty( $cookie_from_request ) ) {
				$this->init_cookie = true;
			}

			$session->setId( $cookie_from_request );
		}

		/*CUSTOM CODE ENDS HERE */

		return $session;
	}
}
