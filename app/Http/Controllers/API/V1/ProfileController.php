<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function updateProfile(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'matric_no' => [
                'nullable', 
                Rule::requiredIf(Auth::user()->account_type == 'Student'),
                'string', 'min:12', 'max:12', 
                'regex:/^[A-Z]{3}\/\d{4}\/\d{3}$/'],
            'last_name' => ['required', 'min:2', 'max:30', 'regex:/^[a-zA-Z\-]{2,30}$/'],
            'first_name' => ['required', 'min:2', 'max:30', 'regex:/^[a-zA-Z\-]{2,30}$/'],
            'middle_name' => ['nullable', 'min:2', 'max:30', 'regex:/^[a-zA-Z\-]{2,30}$/'],
            'gender' => ['nullable', Rule::in(GENDER)],
            'phone_1' => [
                'nullable', 'regex:/^[+]{0,1}[0-9]{6,19}$/',
                Rule::unique('users', 'phone_1')->ignore(Auth::user()->id),
                Rule::unique('users', 'phone_2')
            ]
        ]);


        if ($validate->fails()) {
            return response([
                'status' => 'failed',
                'message' => 'Invalid inputs',
                'errors' => $validate->errors(),
            ], Response::HTTP_EXPECTATION_FAILED);
        }

        $update = User::where('id', Auth::user()->id)->update($request->except(('_token')));

        if (!$update) {
            return response([
                'status' => 'failed',
                'message' => SERVER_ERROR,
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }


        Auth::setUser(User::find(Auth::user()->id));

        return response([
            'status' => 'successful',
            'message' => ENTRY_UPDATED,
        ], Response::HTTP_CREATED);
    } // updateProfile
}
