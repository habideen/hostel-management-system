<?php

namespace App\Http\Controllers\WEB\Student;

use App\Http\Controllers\API\V1\Student\BookingController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $api = (new BookingController())->myHostels();
        $response = json_decode($api->getContent());

        return view('student.index')->with([
            'rooms' => $response->rooms
        ]);
    } // index
}
