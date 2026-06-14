<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Support\Carbon;

class LandingController extends Controller
{
    public function index()
    {
        $events = Event::where('event_date', '>=', Carbon::today())
            ->orderBy('event_date', 'asc')
            ->take(4)
->get(['id', 'image', 'location', 'event_date']);
        return view('home', compact('events'));
    }
}
