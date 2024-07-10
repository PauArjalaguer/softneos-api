<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $usermail = $request->usermail;
        $userpassword = $request->userpassword;
        $user = User::where('email', $usermail)->where('password', $userpassword)->firstOrFail();
        return $user;
    }
}
