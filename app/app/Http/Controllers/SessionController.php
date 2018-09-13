<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use \Illuminate\Http\Request;

use \App\User;

class SessionController extends BaseController
{

    public function register(Request $req)
    {
        // Check if the user already exists in the system
        $user = \App\User::where("name", $req->name)->first();

        if (is_null($user)) {
            // User doesn't exist, so we need to create it
            $user = new \App\User;

            $user->name = $req->input("name");

            // Save the new user
            $user->save();
        }

        // Redirect the user to their listening page
        return redirect("registered/{$user->id}");
    }
}
