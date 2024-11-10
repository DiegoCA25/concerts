<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\City;
use Inertia\Inertia;
use Illuminate\Http\Request;

class ArtistController extends Controller
{
   
    public function index()
    {
        $cities= City::all();
        $artists = Artist::with('city:id,city','concerts:name')->get();
        return Inertia::render('Artists/Index',[
            'artists' => $artists,
            'cities' => $cities
        ]);
    }

    
    public function create()
    {
        //
    }

   
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:80',
            'nationality' => 'required|max:80',
            'city_id' => 'required|numeric'
        ]);
        $artist = new Artist($request->input());
        $artist->save();
        return redirect('artists');
    }

    
    public function show(Artist $artist)
    {
        //
    }

   
    public function edit(Artist $artist)
    {
        //
    }

    public function update(Request $request, Artist $artist)
    {
        $request->validate([
            'name' => 'required|max:80',
            'nationality' => 'required|max:80',
            'city_id' => 'required|numeric'
        ]);
        $artist->update($request->input());
        return redirect('artists');
    }


    public function destroy(Artist $artist)
    {
        $artist->delete();
        return redirect('artists');
    }
}
