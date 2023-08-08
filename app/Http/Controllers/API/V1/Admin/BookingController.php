<?php

namespace App\Http\Controllers\API\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\Block;
use App\Models\StudentRoom;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BookingController extends Controller
{
    public function getRooms($sessionId = null)
    {
        $rooms = StudentRoom::select(
            'student_rooms.id',
            'student_rooms.user_id',
            'halls.name AS hall',
            'blocks.name AS block',
            'student_rooms.room_no',
            'student_rooms.bed_space',
        )
            ->join('blocks', 'blocks.id', '=', 'student_rooms.block_id')
            ->join('halls', 'halls.id', '=', 'blocks.hall_id');

        $rooms = $sessionId ?
        $rooms->where('student_rooms.session_id', $sessionId)->get() :
        $rooms->get();

        return response([
            'status' => 'successful',
            'message' => 'Retrieved successfully',
            'rooms' => $rooms,
            'vacant' => $rooms->whereNull('user_id')->count(),
            'occupied' => $rooms->whereNotNull('user_id')->count()
        ]);
    } // getRooms




    public function generateRooms()
    {
        $sessionId = currentSessionID();
        if (!$sessionId) {
            return response([
                'status' => 'failed',
                'message' => 'Invalid session ID.',
            ], Response::HTTP_EXPECTATION_FAILED);
        }


        // make sure that you have not enabled the hostel ballot before running this.
        StudentRoom::where('session_id', $sessionId)->delete();

        $blocks = Block::all();

        foreach ($blocks as $block) {
            $blockId = $block['id'];
            $firstRoomNumber = $block['first_room_number'];
            $noOfRooms = $block['no_of_rooms'];
            $roomCapacity = $block['room_capacity'];

            $insert = []; // Initialize the array to accumulate data
            for ($roomNumber = $firstRoomNumber; $roomNumber < $firstRoomNumber + $noOfRooms; $roomNumber++) {
                for ($bedSpace = 1; $bedSpace <= $roomCapacity; $bedSpace++) {
                    $insert[] = [
                        'block_id' => $blockId,
                        'room_no' => $roomNumber,
                        'bed_space' => $bedSpace,
                        'session_id' => $sessionId,
                        'created_at' => now(),
                        'updated_at' => now()
                    ];
                }
            }

            // Insert the accumulated data into the student_rooms table
            StudentRoom::insert($insert);
        }


        return response([
            'status' => 'successful',
            'message' => 'Bedspace generated successfully',
        ], Response::HTTP_CREATED);
    } // generateRooms
}
