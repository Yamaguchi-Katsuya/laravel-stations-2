<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Support\Facades\Log;

class MovieController extends Controller
{
    public function index()
    {
        $keyword = request('keyword');
        $is_showing = request('is_showing');

        $movies = Movie::query()
            ->when($keyword, function ($query, $keyword) {
                return $query->where('title', 'like', "%$keyword%")
                    ->orWhere('description', 'like', "%$keyword%");
            })
            ->when(!is_null($is_showing), function ($query) use ($is_showing) {
                return $query->where('is_showing', $is_showing);
            })
            ->paginate(20);

        return view('front/movie/index', ['movies' => $movies, 'keyword' => $keyword, 'is_showing' => $is_showing]);
    }
}
