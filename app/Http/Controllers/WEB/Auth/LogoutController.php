<?php

namespace App\Http\Controllers\WEB\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function logout(Request $request)
    {
        //$this->guard()->logout();
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $request->session()->flush();

        return redirect('/');
    }
}
