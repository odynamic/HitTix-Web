<?php

namespace App\Http\Controllers;

use App\Models\Event;

class HomeController extends Controller
{
    public function index()
{
    $events = Event::orderBy('event_date', 'desc')->limit(3)->get();

    $specials = Event::where('is_featured', 1)->get();

    return view('home', compact('events', 'specials'));
}



}
