<?php

namespace App\Http\Controllers\API\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\Session;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class SessionController extends Controller
{
    public function sessions($isPaginate = false)
    {
        return response([
            'status' => 'successful',
            'message' => 'Retrieved successfully',
            'sessions' => $isPaginate ? Session::paginate(PAGINATION) : Session::take(10)->get()
        ]);
    } // sessions


    public function updateSession(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'session' => ['required', 'regex:/^[0-9]{4,4}[\/][0-9]{4,4}$/']
        ]);


        if ($validate->fails()) {
            return response([
                'status' => 'failed',
                'message' => 'Invalid inputs',
                'errors' => $validate->errors(),
            ], Response::HTTP_EXPECTATION_FAILED);
        }


        $lastSession = Session::select('session')->latest()->first();

        if ($lastSession && $lastSession->session == $request->session) {
            return response([
                'status' => 'failed',
                'message' => 'Current session is same as input submitted',
            ], Response::HTTP_EXPECTATION_FAILED);
        }


        $save = new Session;
        $save->session = $request->session;
        $save->save();


        if (!$save) {
            return response([
                'status' => 'failed',
                'message' => SERVER_ERROR,
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response([
            'status' => 'successful',
            'message' => ENTRY_UPDATED,
        ], Response::HTTP_CREATED);
    } // updateSession
}
