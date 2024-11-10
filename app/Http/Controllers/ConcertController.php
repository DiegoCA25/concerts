<?php

namespace App\Http\Controllers;

use App\Models\Concert;
use App\Models\Artist;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ConcertController extends Controller
{
    public function index()
    {
        return Inertia::render('Concerts/Index',[
            'concerts' => Concert::paginate(10)
        ]);
    }

    public function create()
    {
        return Inertia::render('Concerts/Create',[
            'artists' => Artist::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:30',
            'description' => 'required|max:200',
            'date' => 'required|date',
            'duration' => 'required|date_format:H:i:s',      
            'image' => 'required|file|mimes:png,jpg,gif',
            'artists' => 'required|array'
        ]);
    
        $concert = Concert::create($request->all());
    
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($concert->image);
            $imgName = microtime(true) . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->storeAs('public/storage/img', $imgName);
            $concert->image = '/img/' . $imgName; // Cambiado para que sea idéntico al código de libros
            $concert->save();
        }
        $concert->artists()->sync($request->artists);
        return redirect('concerts/create')->with('success', 'Concert created');
    }
    

    public function show(Concert $concert)
    {
        return Inertia::render('Concerts/Show',[
            'concert' => $concert, 'artists' => $concert->artists
        ]);
    }

    public function edit(Concert $concert)
    {
        return Inertia::render('Concerts/Edit',[
            'artists' => Artist::all(),
            'concert' => $concert,
            'artistsOfConcert' => $concert->artists
        ]);
    }

    public function updateConcert(Request $request, Concert $concert)
    {
        $request->validate([
            'name' => 'required|max:30',
            'description' => 'required|max:200',
            'date' => 'required|date',
            'duration' => 'required|date_format:H:i:s',      
            'id' => 'required|numeric',
        ]);
    
        $concert = Concert::find($request->id);
        $concert->update($request->input());
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($concert->image);
            $imgName = microtime(true) . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->storeAs('public/storage/img', $imgName);
            $concert->image = '/img/' . $imgName; // Cambiado para que sea idéntico al código de libros
            $concert->save();
        }
        $concert->artists()->sync($request->artists);
        return redirect('concerts')->with('success', 'Concert updated');
    }

    public function destroy(Concert $concert)
    {
        $concert->delete();
        return redirect('concerts')->with('success','Concert deleted');
    }
}
