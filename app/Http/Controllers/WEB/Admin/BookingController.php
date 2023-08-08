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



    public function roomInfo(Request $request)
    {
        $roomInfo = (new AdminBookingController())->roomInfo($request->roomID);
        $roomInfo = json_decode($roomInfo->getContent());

        if ($roomInfo->status == 'failed') {
            return redirect()->back()->with([
                'fail' => $roomInfo->message
            ]);
        }

        if (!$roomInfo->room) {
            return redirect()->back()->with([
                'fail' => 'Room does not exist.'
            ]);
        }

        if (!$roomInfo->room->user_id) {
            return redirect()->back()->with([
                'fail' => 'Room is not occupied.'
            ]);
        }


        return view('admin.room_info')->with([
            'room' => $roomInfo->room
        ]);
    } // roomInfo
}
