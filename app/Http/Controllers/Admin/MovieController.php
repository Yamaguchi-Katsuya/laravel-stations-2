<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateMovieRequest;
use App\Http\Requests\UpdateMovieRequest;
use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Support\Facades\DB;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::all();
        return view('admin/movie/index', ['movies' => $movies]);
    }

    public function create()
    {
        return view('admin/movie/create');
    }

    public function store(CreateMovieRequest $request)
    {
        $validated = $request->validated();
        DB::transaction(function () use ($validated) {
            $genre = Genre::query()->where('name', $validated['genre'])->first();
            if (!$genre) {
                $genre = Genre::create(['name' => $validated['genre']]);
            }
            unset($validated['genre']);
            $validated['genre_id'] = $genre->id;
            Movie::create($validated);
        });

        return redirect(route('admin.movies.index'));
    }

    public function edit($id)
    {
        $movie = Movie::find($id);
        return view('admin/movie/edit', ['movie' => $movie]);
    }

    public function update(UpdateMovieRequest $request, $id)
    {
        $validated = $request->validated();
        $movie = Movie::find($id);
        DB::transaction(function () use ($validated, $movie) {
            $genre = Genre::query()->where('name', $validated['genre'])->first();
            if (!$genre) {
                $genre = Genre::create(['name' => $validated['genre']]);
            }
            unset($validated['genre']);
            $validated['genre_id'] = $genre->id;
            $movie->update($validated);
        });

        return redirect(route('admin.movies.index'));
    }

    public function destroy($id)
    {
        $movie = Movie::findOrFail($id);
        $movie->delete();

        session()->flash('success', 'Movie was deleted');

        return redirect(route('admin.movies.index'));
    }
}
