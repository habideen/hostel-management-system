<?php

namespace App\Http\Controllers\WEB\Admin;

use App\Http\Controllers\API\V1\Admin\BlockController as AdminBlockController;
use App\Http\Controllers\API\V1\Admin\HallController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlockController extends Controller
{
    public function index(Request $request)
    {
        if ($request->id) {
            $block = (new AdminBlockController())->blockDetails($request->id);
            $block = json_decode($block->getContent());
        }

        $halls = (new HallController())->hallList();
        $halls = json_decode($halls->getContent());

        return view('admin.add_block')->with([
            'halls' => $halls->halls ?? null,
            'block' => $block->details ?? null
        ]);
    } // index



    public function updateBlock(Request $request)
    {
        $api = (new AdminBlockController())->updateBlock($request);
        $response = json_decode($api->getContent());

        if ($response->status == 'failed') {
            return redirect()->back()->withInput($request->all())
                ->withErrors($response->errors)
                ->with([
                    'fail' => $response->message
                ]);
        }


        return redirect()->back()->with([
            'success' => $response->message
        ]);
    } // updateBlock



    public function blockList()
    {
        $api = (new AdminBlockController())->blockList(true);
        $response = json_decode($api->getContent());

        return view('admin.block_list')->with([
            'blocks' => $response->blocks
        ]);
    } // blockList
}
