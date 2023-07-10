<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Film;
use Illuminate\Http\Request;

class FilmsController extends Controller
{
    public function show(Request $request) {
        $genre = $request->query('genre');
        if(Genre::contains($genre)) {
            return view("films.show", [
                "route" => "show",
                "genres_count" => Genre::count(),
                "films_count" => Film::count(),
                "films" => Film::where(["genre" => $genre])->paginate(1),
                "genres" => Genre::all(),
                "filter_genre" => $genre
            ]);
        }

        return view("films.show", [
            "route" => "show",
            "genres_count" => Genre::count(),
            "films_count" => Film::count(),
            "films" => Film::paginate(1),
            "genres" => Genre::all(),
            "filter_genre" => null
        ]);
    }

    public function add() {
        return view("films.add", [
            "route" => "addfilm",
            "genres" => Genre::all()
        ]);
    }

    public function find($id) {
        if(Film::where('id', $id )->exists()) {
            return view("films.ajax.premiere", [
                "finded" => true,
                "film" => Film::get($id)
            ]);
        }

        return view("films.ajax.premiere", [
            "finded" => false
        ]); 
    }

    public function remove($id) {
        Film::findOrFail($id)->delete();
        return redirect(route("film.show"));
    }

    public function status($id,$status) {
        $film = Film::findOrFail($id);
        $film->update([
            "status" => $status
        ]);

        return redirect(route("film.show"));
    }
    public function edit($id) {
        $film = Film::findOrFail($id);

        return view("films.edit", [
            "route" => "edit",
            "film" => $film
        ]);
    }

    public function editcheck(Request $request) {
        
        $validate = $request->validate([
            "fname" => "required|min:4|max:64",
            "poster" => 'nullable|image',
            "genre" => "required|exists:App\Models\Genre,id"
        ]);
        
        $film = Film::findOrFail($request->id);

        if(!Genre::exists($request->genre)) {
            return "This genre not found";
        }

        if($request->poster == null) {
            $film->update([
                "name" => $request->fname,
                "genre" => $request->genre
            ]);
        } else {
            $imageName = time().'.'.$request->poster->extension();
            $request->poster->move(public_path('images'), $imageName);
            $film->update([
                "name" => $request->fname,
                "genre" => $request->genre,
                "poster" => $imageName
            ]);
        }

        return redirect(route("film.show"));
    }

    public function check(Request $request) {
        
        $validate = $request->validate([
            "fname" => "required|min:3|max:64|unique:App\Models\Film,name",
            "poster" => 'nulled|image',
            "genre" => "required|exists:App\Models\Genre,id"
        ]);

        if($request->poster == null) {
            $imageName = "not_found.png";
        } else {
            $imageName = time().'.'.$request->poster->extension();
            $request->poster->move(public_path('images'), $imageName);
        }

        Film::create([
            "name" => $request->fname,
            "poster" => $imageName,
            "genre" => $request->genre
        ]);

        return redirect(route("film.show"));
    }
}
