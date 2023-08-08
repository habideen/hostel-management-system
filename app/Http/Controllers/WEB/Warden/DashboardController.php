<?php

namespace App\Http\Controllers\WEB\Warden;

use App\Http\Controllers\API\V1\Warden\BookingController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $api = (new BookingController())->blockList(true);
        $response = json_decode($api->getContent());

        return view('admin.index')->with([
            'blocks' => $response->blocks
        ]);
    } // index
}
