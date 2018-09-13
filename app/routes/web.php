<?php
// use App\Events\TestEvent;
use App\User;
use App\Message;

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

// Base page for "clients" to visit
// Allows for a user to register their session
Route::get('/', function () {
    return view('register');
});

// Base page for "admins" to visit
// Allows for a user to send messages and review previous messages
Route::get('/admin', function() {
    return view("admin", [
        "users" => \App\User::all(),
        "messages" => \App\Message::orderBy('created_at', 'desc')->get()
    ]);
});

// Page for registered "clients"
// This page listens for event broadcasts to individual users
Route::get('registered/{user}', function (User $user) {
    return view('client', ["user" => $user]);
});

// Functionality to actually register the "client" session in the system
Route::post('register-session', "SessionController@register");

// Functionality to actually process/send the messages from the Admin dashboard
Route::post('send-message', "MessageController@send");
