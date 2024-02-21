<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Tests\Feature\Videos\VideoTest;

class VideoController extends Controller
{
    public function testedBy(){
        return VideoTest::class;
    }
    public function show($id)
    {
        return view('videos.show',[
            'video' => Video::findOrFail($id)
            ]);
    }
}
