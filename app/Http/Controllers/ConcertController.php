<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Concert;

class ConcertController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $concerts = Concert::orderBy('date', 'asc')->paginate(10);
        return view('concerts.index', compact('concerts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('concerts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'venue' => 'required|string|max:255',
        ]);

        Concert::create($validated);

        return redirect()->route('concerts.index')->with('success', 'Concert created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $concert = Concert::findOrFail($id);
        return view('concerts.show', compact('concert'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $concert = Concert::findOrFail($id);
        return view('concerts.edit', compact('concert'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $concert = Concert::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'venue' => 'required|string|max:255',
        ]);

        $concert->update($validated);

        return redirect()->route('concerts.show', $concert->id)->with('success', 'Concert updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $concert = Concert::findOrFail($id);
        $concert->delete();

        return redirect()->route('concerts.index')->with('success', 'Concert deleted successfully.');
    }
}
