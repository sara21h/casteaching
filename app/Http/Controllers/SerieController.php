<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use Illuminate\Http\Request;

class SerieController extends Controller
{
    public function show($id)
    {
        return view('series.show',[
            'serie' => Serie::findOrFail($id)
        ]);
    }
}
