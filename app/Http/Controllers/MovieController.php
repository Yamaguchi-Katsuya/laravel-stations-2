<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Support\Facades\Log;

class MovieController extends Controller
{
    public function index()
    {
        $keyword = request('keyword');
        $isShowing = request('is_showing');

        $movies = Movie::query()
            ->with('schedules')
            ->when($keyword, function ($query, $keyword) {
                return $query->where('title', 'like', "%$keyword%")
                    ->orWhere('description', 'like', "%$keyword%");
            })
            ->when(!is_null($isShowing), function ($query) use ($isShowing) {
                return $query->where('is_showing', $isShowing);
            })
            ->paginate(20);

        return view('front/movie/index', [
            'movies' => $movies,
            'keyword' => $keyword,
            'is_showing' => $isShowing
        ]);
    }

    public function show($id)
    {
        $movie = Movie::with('schedules')->findOrFail($id);

        return view('front/movie/show', ['movie' => $movie]);
    }
}
