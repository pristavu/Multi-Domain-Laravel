<?php

namespace App\Http\Controllers;

use App\Item as Item;
use App\User as User;
use App\Message as Message;

class DemoController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        // $this->middleware('auth');

    }

    public function home() {
        // $users      = User::all();
        // $user       = new User;
        // $user->name = 'John';
        // $user->save();
        // exit;

        // $user = Demo::first();

        // print_r( $user );

        // $message = new Message( ['title' => 'TEST'] );
        // // $item->save();

        $user = User::first();

        // $item = $user->items()->save( $item );
        // // or
        $message = $user->messages()->create( ['title' => 'A Game of Thrones'] );

        $message = $user->messages()->first();


        // $items = Item::where( 'title', 'TEST' )->get();
        // print_R( $items->count( true ) );
        // $item = $items->first();
        // print_r( $item );

        // $item->title = 'A Game of Thrones 2';

        // $item->save();

        return $message;
        // return view('app.dashboard', ['user' => auth()->user()]);
    }
}
