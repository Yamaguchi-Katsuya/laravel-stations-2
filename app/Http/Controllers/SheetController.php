<?php

namespace App\Http\Controllers;

use App\Models\Sheet;

class SheetController extends Controller
{
    public function index()
    {
        $sheets = Sheet::all();
        return view('front/sheet/index', ['sheets' => $sheets]);
    }
}
