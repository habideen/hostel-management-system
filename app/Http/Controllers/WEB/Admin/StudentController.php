<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Http\Controllers\API\V1\Admin\StudentController as AdminStudentController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.upload_student');
    } // index



    public function uploadStudent(Request $request)
    {
        $api = (new AdminStudentController())->uploadStudent($request);
        $response = json_decode($api->getContent());

        // if ($response->status == 'failed') {
        //     return redirect()->back()->withInput($request->all())
        //         ->withErrors($response->errors ?? null)
        //         ->with([
        //             'fail' => $response->message
        //         ]);
        // }


        return redirect()->back()->with([
            'success' => $response->message
        ]);
    } // uploadStudent
}
