<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Http\Controllers\API\V1\Admin\SessionController as AdminSessionController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function index()
    {
        $sessions = (new AdminSessionController())->sessions();
        $sessions = json_decode($sessions->getContent());
        
        return view('admin.update_session')->with([
            'sessions' => $sessions->sessions
        ]);
    } //index
    
    
    
    
    public function updateSession(Request $request)
    {
        $api = (new AdminSessionController())->updateSession($request);
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
    } // updateSession
}
