<?php

namespace App\Http\Controllers\API\V1\Admin;

use App\Http\Controllers\Controller;
use App\Imports\StudentsImport;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends Controller
{
    public function uploadStudent(Request $request)
    {
        Excel::import(new StudentsImport, $request->file);

        return response([
            'status' => 'successful',
            'message' => '<p>Students uploaded successfully.</p><p>Default student password is surname in small case.</p>',
        ], Response::HTTP_CREATED);
    } // uploadStudent
}
