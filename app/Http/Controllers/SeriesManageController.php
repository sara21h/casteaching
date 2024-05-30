<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use Illuminate\Http\Request;

class SeriesManageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('series.manage.index', [
            'series' => Serie::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('series.manage.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string',
            'descripcio' => 'nullable|string',
            'videos_id' => 'nullable|exists:videos,id'
        ]);

        $serie = Serie::create([
            'nom' => $request->input('nom'),
            'descripcio' => $request->input('descripcio'),
            'videos_id' => $request->input('videos_id')
        ]);

        session()->flash('success', 'Serie creada correctament');
        return redirect()->route('manage.series');
    }

    /**
     * Display the specified resource.
     */
    public function show(Serie $serie)
    {
        return view('series.manage.show', compact('serie'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Serie $serie)
    {
        return view('series.manage.edit', compact('serie'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Serie $serie)
    {
        $request->validate([
            'nom' => 'required|string',
            'descripcio' => 'nullable|string',
            'videos_id' => 'nullable|exists:videos,id'
        ]);

        $serie->update([
            'nom' => $request->input('nom'),
            'descripcio' => $request->input('descripcio'),
            'videos_id' => $request->input('videos_id')
        ]);

        session()->flash('success', 'Serie actualitzada correctament');
        return redirect()->route('manage.series');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Serie $serie)
    {
        $serie->delete();
        session()->flash('deleted', 'Serie eliminada correctament');
        return redirect()->route('manage.series');
    }
}