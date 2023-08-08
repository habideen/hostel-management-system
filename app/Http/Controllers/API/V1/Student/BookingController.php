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



    public function roomInfo($roomID)
    {
        return response([
            'status' => 'successful',
            'message' => 'Retrieved successfully',
            'room' => StudentRoom::select(
                'student_rooms.id',
                'student_rooms.user_id',
                'users.matric_no',
                'users.last_name',
                'users.first_name',
                'users.middle_name',
                'users.gender',
                'halls.name AS hall',
                'blocks.name AS block',
                'student_rooms.room_no',
                'student_rooms.bed_space',
                'sessions.session'
            )
                ->join('blocks', 'blocks.id', '=', 'student_rooms.block_id')
                ->join('halls', 'halls.id', '=', 'blocks.hall_id')
                ->join('sessions', 'sessions.id', '=', 'student_rooms.session_id')
                ->leftJoin('users', 'users.id', '=', 'student_rooms.user_id')
                ->where('student_rooms.id', $roomID)
                ->where('student_rooms.user_id', Auth::user()->id)->first(),
        ]);
    } // roomInfo



    public function myHostels()
    {
        return response([
            'status' => 'successful',
            'message' => 'Retrieved successfully',
            'rooms' => StudentRoom::select(
                'student_rooms.id',
                'halls.name AS hall',
                'blocks.name AS block',
                'student_rooms.room_no',
                'student_rooms.bed_space',
                'sessions.session'
            )
                ->join('blocks', 'blocks.id', '=', 'student_rooms.block_id')
                ->join('halls', 'halls.id', '=', 'blocks.hall_id')
                ->join('sessions', 'sessions.id', '=', 'student_rooms.session_id')
                ->where('student_rooms.user_id', Auth::user()->id)->get(),
        ]);
    } // myHostels
}
