<?php

namespace App\Http\Controllers\WEB\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }




    public function login(Request $request)
    {
        $invalid = 'Username or password is incorrect';

        // $input = [
        //     'email' => $request->email,
        //     'password' => $request->password
        // ];

        $credentials = Validator::make($request->all(), [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);


        if ($credentials->fails()) {
            return redirect()->back()->with([
                'fail' => 'Username or password is incorrect'
            ]);
        }

        //limit failed attempt /min to 5
        $executed = RateLimiter::attempt('web_auth:' . $request->ip(), $perMinute = 5, function () {
        });

        if (!$executed)
            return redirect()->back()->with('fail', 'Too many attempt. Please tray again');

        if (!Auth::attempt($request->except('_token')))
            return redirect()->back()->with('fail', 'Username or password is incorrect');


        // check if account is disabled
        if (Auth::user()->disabled) {
            Auth::logoutOtherDevices($request->password);

            $request->session()->invalidate();
            $request->session()->regenerateToken();
            $request->session()->flush();

            return redirect()->back()->with('fail', 'This account is disabled. Please contact support.');
        }


        $request->session()->regenerate();

        RateLimiter::clear('web_auth:' . $request->ip());


        return redirect()->intended(strtolower(Auth::user()->account_type) . '/dashboard');
    }
}
