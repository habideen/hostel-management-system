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
}
