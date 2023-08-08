<?php

namespace App\Http\Controllers\WEB\Student;

use App\Http\Controllers\API\V1\Student\BookingController as StudentBookingController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        return view('student.book')->with([]);
    } // index



    public function bookNow()
    {
        $api = (new StudentBookingController())->bookNow();
        $response = json_decode($api->getContent());

        if ($response->status == 'failed') {
            return redirect()->back()->with([
                    'fail' => $response->message
                ]);
        }
        

        return redirect()->back()->with([
            'success' => $response->message
        ]);
    } // bookNow



    public function myHostels()
    {
        $api = (new StudentBookingController())->myHostels();
        $response = json_decode($api->getContent());

        return view('student.manage_room')->with([
            'rooms' => $response->rooms
        ]);
    } // myHostels




    public function roomInfo(Request $request)
    {
        $roomInfo = (new StudentBookingController())->roomInfo($request->roomID);
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


        return view('shared.room_info')->with([
            'room' => $roomInfo->room
        ]);
    } // roomInfo
}
