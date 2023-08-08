<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Http\Controllers\API\V1\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $rooms = (new AdminBookingController())->getRooms($request->session ?? currentSessionID());
        $rooms = json_decode($rooms->getContent());


        return view('admin.manage_room')->with([
            'rooms' => $rooms->rooms,
            'session' => $request->session ? sessionFromId($request->session) : currentSession(),
            'vacant' => $rooms->vacant,
            'occupied' => $rooms->occupied
        ]);
    } // index



    public function generateRooms()
    {
        $api = (new AdminBookingController())->generateRooms();
        $response = json_decode($api->getContent());

        if ($response->status == 'failed') {
            return redirect()->back()->with([
                'fail' => $response->message
            ]);
        }

        return redirect()->back()->with([
            'success' => $response->message
        ]);
    } // generateRooms
}
