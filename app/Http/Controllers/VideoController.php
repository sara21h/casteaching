<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function show($id)
    {
        return view('videos.show',[
            'video' => Video::find($id)
            ]);
    }
}
