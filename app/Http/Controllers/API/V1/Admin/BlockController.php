<?php

namespace App\Http\Controllers\API\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\Block;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class BlockController extends Controller
{
    public function updateBlock(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'id' => ['nullable', 'integer', 'exists:blocks'],
            'name' => ['required', 'string', 'min:2', 'max:50', 'regex:/^[A-Za-z0-9\-\_ ]{2,50}$/'],
            'hall_id' => ['required', 'integer', 'exists:halls,id'],
            'first_room_number' => ['required', 'integer', 'min:1'],
            'no_of_rooms' => ['required', 'integer', 'min:1'],
            'room_capacity' => ['required', 'integer', 'min:1'],
            'gender' => ['required', 'string', Rule::in(['Male', 'Female'])]
        ]);


        if ($validate->fails()) {
            return response([
                'status' => 'failed',
                'message' => 'Invalid inputs',
                'errors' => $validate->errors(),
            ], Response::HTTP_EXPECTATION_FAILED);
        }


        if (!$request->id) {
            $input = $request->except(['_token', 'id']);
            $input['created_by'] = Auth::user()->id;
            $input['name'] = preg_replace('!\s+!', ' ', $input['name']);
            $save = Block::updateOrCreate(
                ['hall_id' => $input['hall_id'], 'name' => $input['name']],
                $input
            );
        } else {
            $save = Block::where('id', $request->id)->update($request->except(['_token', 'id']));
        }


        if (!$save) {
            return response([
                'status' => 'failed',
                'message' => SERVER_ERROR,
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response([
            'status' => 'successful',
            'message' => $request->id ? ENTRY_UPDATED : ENTRY_CREATED,
        ], Response::HTTP_CREATED);
    } // updateBlock



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
        ->join('halls', 'halls.id', '=', 'blocks.hall_id');

        return response([
            'status' => 'successful',
            'message' => 'Retrieved successfully',
            'blocks' => $isPaginate ? $blocks->paginate(PAGINATION) : $blocks->get()
        ]);
    } // hallList



    public function blockDetails($id)
    {
        return response([
            'status' => 'successful',
            'message' => 'Retrieved successfully',
            'details' => Block::select(
                'id',
                'hall_id',
                'name',
                'first_room_number',
                'no_of_rooms',
                'room_capacity',
                'gender'
            )->where('id', $id)->first()
        ]);
    } // blockDetails
}
