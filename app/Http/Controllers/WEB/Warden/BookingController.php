<?php

namespace App\Http\Controllers\WEB\Warden;

use App\Http\Controllers\API\V1\Warden\BookingController as WardenBookingController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $rooms = (new WardenBookingController())->getRooms($request->session ?? currentSessionID());
        $rooms = json_decode($rooms->getContent());


        return view('warden.manage_room')->with([
            'rooms' => $rooms->rooms,
            'session' => $request->session ? sessionFromId($request->session) : currentSession(),
            'vacant' => $rooms->vacant,
            'occupied' => $rooms->occupied
        ]);
    } // index
}
