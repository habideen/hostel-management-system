<?php

namespace App\Http\Controllers\API\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hall;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class HallController extends Controller
{
    public function updateHall(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'id' => ['nullable', 'integer', 'exists:halls'],
            'name' => ['required', 'string', 'min:2', 'max:50', 'regex:/^[A-Za-z0-9\-\_ ]{2,50}$/']
        ]);


        if ($validate->fails()) {
            return response([
                'status' => 'failed',
                'message' => 'Invalid inputs',
                'errors' => $validate->errors(),
            ], Response::HTTP_EXPECTATION_FAILED);
        }


        if ($request->id) {
            $save = Hall::find($request->id);
        } else {
            $save = new Hall;
            $save->created_by = Auth::user()->id; 
        }

        $save->name = $request->name;
        $save->save();


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
    } // updateHall



    public function hallList($isPaginate = false)
    {
        return response([
            'status' => 'successful',
            'message' => 'Retrieved successfully',
            'halls' => $isPaginate ? Hall::paginate(PAGINATION) : Hall::select('id', 'name')->get()
        ]);
    } // hallList



    public function hallDetails($id)
    {
        return response([
            'status' => 'successful',
            'message' => 'Retrieved successfully',
            'details' => Hall::select('id', 'name')->where('id', $id)->first()
        ]);
    } // hallList
}
