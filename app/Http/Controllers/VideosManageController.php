<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use App\Models\Video;
use Illuminate\Http\Request;

class VideosManageController extends Controller
{
    public function index()
    {
        return view('videos.manage.index', [
            'videos' => Video::all(),
            'series' => Serie::all(),
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        // Validate form data
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'url' => 'required|url',
            'serie_id' => 'nullable|integer',
        ]);

        // Create a new video
        $video = Video::create([
            'title' => $request->title,
            'description' => $request->description,
            'url' => $request->url,
            'serie_id' => $request->serie_id,
        ]);

        // Redirect with success message
        session()->flash('success', 'Video creat correctament');
        return redirect()->route('manage.videos');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $video = Video::findOrFail($id);
        return response()->json($video);
    }

    public function update(Request $request, $id)
    {
        // Validate form data
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'url' => 'required|url',
            'serie_id' => 'nullable|integer',
        ]);

        $video = Video::findOrFail($id);

        // Update video
        $video->update([
            'title' => $request->title,
            'description' => $request->description,
            'url' => $request->url,
            'serie_id' => $request->serie_id,
        ]);

        // Redirect with success message
        session()->flash('success', 'Video actualizat correctament');
        return redirect()->route('manage.videos');
    }

    public function destroy($id)
    {
        Video::findOrFail($id)->delete();
        session()->flash('deleted', 'Video borrat correctament');
        return redirect()->route('manage.videos');
    }
}
