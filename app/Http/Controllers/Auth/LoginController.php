<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function redirectTo()
    {
        switch (auth()->user()->role->name) {
            case 'admin':
                return '/admin';
                break;
            case 'customer':
                return '/';
                break;
            default:
                return '/login';
                break;
        }
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function authenticated(Request $request, $user)
    {
        if ($request->route()->getName() != 'register') {
            if ($user->hasRole('admin')) {
                return redirect()->route('admin');
            } else {
                return redirect()->route('index');
            }
        }

        return redirect()->route('register');
    }
}
