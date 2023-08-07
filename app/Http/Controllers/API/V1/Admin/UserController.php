<?php

namespace App\Http\Controllers\API\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function user(Request $request)
    {
        if (!$request->id) {
            return response([
                'status' => 'failed',
                'message' => 'Invalid user details supplied!',
            ], Response::HTTP_EXPECTATION_FAILED);
        }

        $user = User::where('id', $request->id)
            ->where('account_type', $request->account_type)->first();
        if (!$user) {
            return response([
                'status' => 'failed',
                'message' => 'Invalid user details supplied!',
            ], Response::HTTP_EXPECTATION_FAILED);
        }

        return response([
            'status' => 'successful',
            'message' => 'Retrieved successfully',
            'details' => $user
        ]);
    } // user



    public function updateWarden(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'id' => ['nullable', 'uuid', 'exists:users'],
            'hall_id' => ['required', 'integer', 'exists:halls,id'],
            'last_name' => ['required', 'min:2', 'max:30', 'regex:/^[a-zA-Z\-]{2,30}$/'],
            'first_name' => ['required', 'min:2', 'max:30', 'regex:/^[a-zA-Z\-]{2,30}$/'],
            'middle_name' => ['nullable', 'min:2', 'max:30', 'regex:/^[a-zA-Z\-]{2,30}$/'],
            'gender' => ['required', Rule::in(GENDER)],
            'phone_1' => [
                'required', 'regex:/^[+]{0,1}[0-9]{6,19}$/',
                Rule::unique('users', 'phone_1')->ignore($request->id),
                Rule::unique('users', 'phone_2')
            ],
            'email' => [
                'required', 'email',
                Rule::unique('users', 'email')->ignore($request->id)
            ]
        ]);


        if ($validate->fails()) {
            return response([
                'status' => 'failed',
                'message' => 'Invalid inputs',
                'errors' => $validate->errors(),
            ], Response::HTTP_EXPECTATION_FAILED);
        }


        // if (!$request->id) {
        $input = $request->except(['_token']);
        $input['created_by'] = Auth::user()->id;
        if (!$request->id) {
            $input['id'] = Str::uuid()->toString();
            $input['password'] = Hash::make(strtolower($input['email']));
            $input['email_verified_at'] = now();
            $input['account_type'] = 'Warden';

            $save = User::insert($input);
        } else {
            $save = User::where('id', $request->id)->update($input);
        }
        // } else {
        //     $save = User::where('id', $request->id)->update($request->except(['_token', 'id']));
        // }


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
    } // updateWarden





    public function userList(String $account_type, $isPaginate = false)
    {
        return response([
            'status' => 'successful',
            'message' => 'Retrieved successfully',
            'users' => $isPaginate ?
                User::where('account_type', $account_type)->paginate(PAGINATION) :
                User::where('account_type', $account_type)->select('id', 'name')->get()
        ]);
    } // userList
}
