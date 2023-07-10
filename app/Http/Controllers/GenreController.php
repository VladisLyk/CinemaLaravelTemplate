<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Film;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function add() {
        return view("genre.add", [
            "route" => "addgenre",
        ]);
    }

    public function show() {
        return view("genre.show", [
            "route" => "showgenre",
            "genres_count" => Genre::count(),
            "genres" => Genre::all()
        ]);
    }

    public function check(Request $request) {
        
        $validate = $request->validate([
            "name" => "required|min:4|max:64|unique:genres"
        ]);

        Genre::create([
            "name" => $request->name
        ]);

        return redirect(route("genre.show"));
    }

    public function remove($id) {
        $genre = Genre::findOrFail($id);
        $films = Film::all();
        foreach ($films as $film) {
            if($film->genre == $genre->id) {
                $film->delete();
            }
        }
        $genre->delete();

        return redirect(route("genre.show"));
    }
}
