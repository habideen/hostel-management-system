<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Http\Controllers\API\V1\Admin\HallController as AdminHallController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HallController extends Controller
{
    public function index(Request $request)
    {
        if ($request->id) {
            $hall = (new AdminHallController())->hallDetails($request->id);
            $hall = json_decode($hall->getContent());
        }

        return view('admin.add_hall')->with([
            'hall' => $hall->details ?? null
        ]);
    } // index



    public function updateHall(Request $request)
    {
        $api = (new AdminHallController())->updateHall($request);
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
    } // updateHall



    public function hallList()
    {
        $api = (new AdminHallController())->hallList(true);
        $response = json_decode($api->getContent());

        return view('admin.hall_list')->with([
            'halls' => $response->halls
        ]);
    } // hallList
}
