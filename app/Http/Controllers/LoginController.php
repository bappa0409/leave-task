<?php

namespace App\Http\Controllers;


class LoginController extends Controller
{
    public function showLoginPage()
    {
        return view('auth.login');
    }
}
