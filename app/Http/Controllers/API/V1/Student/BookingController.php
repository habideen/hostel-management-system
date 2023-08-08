<?php

namespace App\Http\Controllers\API\V1\Student;

use App\Http\Controllers\Controller;
use App\Models\Block;
use App\Models\StudentRoom;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function bookNow()
    {
        $sessionID = currentSessionID();
        if (!$sessionID) {
            return response([
                'status' => 'failed',
                'message' => 'We have not fully prepared this semester. Please try again',
            ], Response::HTTP_EXPECTATION_FAILED);
        }

        if (!Auth::user()->matric_no) {
            return response([
                'status' => 'failed',
                'message' => 'Please update your matric number from update profile',
            ], Response::HTTP_EXPECTATION_FAILED);
        }


        $update = StudentRoom::select('id')
            ->where('session_id', $sessionID)
            ->where('user_id', Auth::user()->id)
            ->first();

        if ($update) {
            return response([
                'status' => 'failed',
                'message' => 'One hostel has already been asigned to you!',
            ], Response::HTTP_EXPECTATION_FAILED);
        }


        $update = StudentRoom::select('student_rooms.id')
            ->join('blocks', 'blocks.id', '=', 'student_rooms.block_id')
            ->where('blocks.gender', Auth::user()->gender)
            ->where('student_rooms.session_id', $sessionID)
            ->whereNull('student_rooms.user_id')
            ->inRandomOrder()
            ->first();


        $update = StudentRoom::where('id', $update->id)
            ->whereNull('user_id')
            ->update(['user_id' => Auth::user()->id]);

        if (!$update) {
            return response([
                'status' => 'failed',
                'message' => SERVER_ERROR,
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response([
            'status' => 'successful',
            'message' => 'Room selected successfully'
        ], Response::HTTP_CREATED);
    } // bookNow
}
