<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Http\Controllers\API\V1\Admin\BlockController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $api = (new BlockController())->blockList(true);
        $response = json_decode($api->getContent());

        return view('admin.index')->with([
            'blocks' => $response->blocks
        ]);
    } // index
}
