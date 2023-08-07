<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Http\Controllers\API\V1\Admin\HallController;
use App\Http\Controllers\API\V1\Admin\UserController as AdminUserController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->id) {
            $user = (new AdminUserController())->user($request);
            $user = json_decode($user->getContent());

            if ($user->status == 'failed') {
                return redirect()->back()->withInput($request->all())
                    ->with([
                        'fail' => $user->message
                    ]);
            }
        }

        $halls = (new HallController())->hallList();
        $halls = json_decode($halls->getContent());

        if ($request->account_type == 'Warden' || $request->segment(2) == 'warden_registration') {
            $view = 'add_warden';
        }

        return view('admin.' . $view)->with([
            'halls' => $halls->halls ?? null,
            'user' => $user->details ?? null
        ]);
    } // index



    public function updateWarden(Request $request)
    {
        $api = (new AdminUserController())->updateWarden($request);
        $response = json_decode($api->getContent());

        if ($response->status == 'failed') {
            return redirect()->back()->withInput($request->all())
                ->withErrors($response->errors ?? null)
                ->with([
                    'fail' => $response->message
                ]);
        }


        return redirect()->back()->with([
            'success' => $response->message
        ]);
    } // updateWarden



    public function userList($account_type)
    {
        $account_type = ucwords($account_type);

        $api = (new AdminUserController())->userList($account_type, true);
        $response = json_decode($api->getContent());

        return view('admin.user_list')->with([
            'users' => $response->users,
            'account_type' => $account_type
        ]);
    } // userList
}
