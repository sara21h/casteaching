<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideosManageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view ('videos.manage.index',[
            'videos' => Video::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'url' => 'required|url',
        ]);

        $url = $request->input('url');

        $embed_url = $this->convertirAEmbed($url);


        $video = Video::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'url' => $embed_url,
        ]);
        session()->flash('success', 'Video created successfully');
        return redirect()->route('manage.videos');
    }

    private function convertirAEmbed($url)
    {
        $pattern = '/(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/';

        preg_match($pattern, $url, $matches);

        if (isset($matches[1])) {
            return 'https://www.youtube.com/embed/' . $matches[1];
        } else {
            return $url;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $video = Video::findOrFail($id);
        return response()->json($video);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'url' => 'required|url',
        ]);

        $video = Video::findOrFail($id);

        $url = $request->input('url');
        $embed_url = $this->convertirAEmbed($url);

        $video->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'url' => $embed_url,
        ]);

        session()->flash('success', 'Video updated successfully');
        return redirect()->route('manage.videos');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Video::find($id)->delete();
        session()->flash('deleted', 'Video deleted successfully');
        return redirect()->route('manage.videos');
    }
}
