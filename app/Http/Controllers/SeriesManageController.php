<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use Illuminate\Http\Request;

class SeriesManageController extends Controller
{
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
            'imatge_url' => 'nullable|url',
        ]);

        $imatge_url = $request->input('imatge_url') ?? 'https://www.wfla.com/wp-content/uploads/sites/71/2023/05/GettyImages-1389862392.jpg?w=2560&h=1440&crop=1';

        $serie = Serie::create([
            'nom' => $request->input('nom'),
            'descripcio' => $request->input('descripcio'),
            'imatge_url' => $imatge_url
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
    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required|string',
            'descripcio' => 'nullable|string',
            'imatge_url' => 'nullable|url',
        ]);

        $serie = Serie::findOrFail($id);

        $imatge_url = $request->input('imatge_url') ?? 'https://www.wfla.com/wp-content/uploads/sites/71/2023/05/GettyImages-1389862392.jpg?w=2560&h=1440&crop=1';

        $serie->update([
            'nom' => $request->input('nom'),
            'descripcio' => $request->input('descripcio'),
            'imatge_url' => $imatge_url
        ]);

        session()->flash('success', 'Serie actualitzada correctament');
        return redirect()->route('manage.series');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Serie::findOrFail($id)->delete();
        session()->flash('deleted', 'Serie eliminada correctament');
        return redirect()->route('manage.series');
    }
}
