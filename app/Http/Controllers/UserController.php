<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class UserController extends Controller
{
     /**
     * Edit Profile a new user instance after a valid registration.
     *
     * @param  Request
     * @return \App\User
     */
    public function profile($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit',compact('user'));
    }
}
