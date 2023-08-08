<?php

namespace App\Http\Controllers\API\V1\Warden;

use App\Http\Controllers\Controller;
use App\Models\Block;
use App\Models\StudentRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function blockList($isPaginate = false)
    {
        $blocks = Block::select(
            'blocks.id',
            'halls.name AS hall',
            'blocks.name',
            'blocks.first_room_number',
            'blocks.no_of_rooms',
            'blocks.room_capacity',
            'blocks.gender',
            'blocks.created_at',
            'blocks.updated_at'
        )
        ->join('halls', 'halls.id', '=', 'blocks.hall_id')
        ->join('users', 'users.hall_id', '=', 'blocks.hall_id')
        ->where('users.hall_id', Auth::user()->hall_id);

        return response([
            'status' => 'successful',
            'message' => 'Retrieved successfully',
            'blocks' => $isPaginate ? $blocks->paginate(PAGINATION) : $blocks->get()
        ]);
    } // blockList



    public function getRooms($sessionId = null)
    {
        $rooms = StudentRoom::select(
            'student_rooms.id',
            'student_rooms.user_id',
            'halls.name AS hall',
            'blocks.name AS block',
            'student_rooms.room_no',
            'student_rooms.bed_space',
            'users.matric_no'
        )
            ->join('blocks', 'blocks.id', '=', 'student_rooms.block_id')
            ->join('halls', 'halls.id', '=', 'blocks.hall_id')
            ->leftJoin('users', 'users.id', '=', 'student_rooms.user_id');
            // ->join('users AS warden', 'warden.hall_id', '=', 'blocks.hall_id');

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
}
