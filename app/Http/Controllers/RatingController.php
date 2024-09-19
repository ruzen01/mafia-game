<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function index()
    {
        // Логика получения рейтинга игроков
        return view('rating');
    }
}
