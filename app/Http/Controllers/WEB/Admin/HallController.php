<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Http\Controllers\API\V1\Admin\HallController as AdminHallController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HallController extends Controller
{
    public function index()
    {
        return view('admin.add_hall')->with([]);
    } // index



    public function updateHall(Request $request)
    {
        $api = (new AdminHallController())->updateHall($request);
        $response = json_decode($api->getContent());

        if ($response->status == 'failed') {
            return redirect()->back()->withInput($request->all())
                ->withErrors($response->errors)
                ->with([
                    'fail' => $response->message
                ]);
        }


        return redirect()->back()->with([
            'success' => $response->message
        ]);
    } // updateHall
}
