<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EoController extends Controller
{
    public function index()
    {
        return view('eo.dashboard');
    }
}
