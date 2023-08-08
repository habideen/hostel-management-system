<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\API\V1\ProfileController as V1ProfileController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        return view(strtolower(Auth::user()->account_type) . '.profile');
    } // index



    public function updateProfile(Request $request)
    {
        $api = (new V1ProfileController())->updateProfile($request);
        $response = json_decode($api->getContent());

        if ($response->status == 'failed') {
            return redirect()->back()->withInput($request->all())
                ->withErrors($response->errors ?? null)
                ->with([
                    'fail' => $response->message
                ]);
        }


        return redirect()->back()->with([
            'success' => $response->message
        ]);
    } // updateProfile
}
