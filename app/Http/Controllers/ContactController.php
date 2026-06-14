<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function kontak()
    {
        return view('contact'); // Mengarah ke resources/views/contact.blade.php
    }
}
