<?php

namespace App\Http\Controllers\WEB\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        return view('student.book')->with([]);
    } // index
}
