<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Event;
use App\Models\Payment;
use Carbon\Carbon;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::query()->where('status', 'live');

        // Filter
        if ($request->filled('q')) {
            $query->where('name', 'like', '%' . $request->q . '%');
        }

        if ($request->filled('ticket_status')) {
            $query->where('ticket_status', $request->ticket_status);
        }

        if ($request->filled('lokasi')) {
            $query->where('venue', 'like', '%' . $request->lokasi . '%');
        }

        if ($request->filled('date_start') && $request->filled('date_end')) {
            $query->whereBetween('event_date', [
                Carbon::parse($request->date_start)->startOfDay(),
                Carbon::parse($request->date_end)->endOfDay()
            ]);
        } elseif ($request->filled('date_start')) {
            $query->whereDate('event_date', '>=', Carbon::parse($request->date_start));
        } elseif ($request->filled('date_end')) {
            $query->whereDate('event_date', '<=', Carbon::parse($request->date_end));
        }

        if ($request->filled('harga')) {
            $query->where('price', '<=', $request->harga);
        }

        // Sorting
        switch ($request->sort) {
            case 'termurah':
                $query->orderBy('price', 'asc');
                break;
            case 'terbaru':
                $query->orderBy('event_date', 'desc');
                break;
            default:
                $query->orderBy('event_date', 'asc');
        }

        $events = $query->paginate(10)->appends($request->all());

        return view('events.index', compact('events'));
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'event_date'  => 'required|date',
            'venue'       => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tickets'     => 'required|array|min:1',
            'tickets.*.name'   => 'required|string|max:255',
            'tickets.*.price'  => 'required|numeric|min:0',
            'tickets.*.status' => 'required|in:On Sale,Sold Out',
        ]);

        $imagePath = $request->hasFile('image') ? $request->file('image')->store('events', 'public') : null;

        $prices = collect($request->tickets)->pluck('price')->filter()->sort()->values();
        $lowestPrice = $prices->first() ?? 0;

        $event = Event::create([
            'name'        => $request->name,
            'event_date'  => $request->event_date,
            'venue'       => $request->venue,
            'description' => $request->description,
            'price'       => $lowestPrice,
            'image'       => $imagePath,
            'user_id'     => Auth::id(),
            'status'      => 'draft',
        ]);

        foreach ($request->tickets as $ticketData) {
            $event->tickets()->create([
                'name'        => $ticketData['name'],
                'price'       => $ticketData['price'],
                'description' => $ticketData['description'] ?? null,
                'quantity'    => $ticketData['quantity'] ?? 0,
                'sold'        => 0,
                'is_active'   => $ticketData['status'] === 'On Sale',
            ]);
        }

        // Redirect ke pemilihan paket di EoPaymentController
        return redirect()->route('eo.payment.choose', $event->id);
    }

    public function show($id)
    {
        $event = Event::findOrFail($id);
        return view('events.show', compact('event'));
    }

    public function eoIndex()
    {
        $events = Event::where('user_id', Auth::id())->get();
        return view('events.eo_index', compact('events'));
    }

    public function edit($id)
    {
        $event = Event::findOrFail($id);

        abort_if($event->user_id !== Auth::id(), 403);

        return view('events.edit', compact('event'));
    }

    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        abort_if($event->user_id !== Auth::id(), 403);

        $request->validate([
            'name'        => 'required|string|max:255',
            'event_date'  => 'required|date',
            'venue'       => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('events', 'public');
            $event->image = $imagePath;
        }

        $event->fill([
            'name'        => $request->name,
            'event_date'  => $request->event_date,
            'venue'       => $request->venue,
            'description' => $request->description,
            'price'       => $request->price,
        ])->save();

        return redirect()->route('dashboard.eo')->with('success', 'Event berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);

        abort_if($event->user_id !== Auth::id(), 403);

        if ($event->image) {
            Storage::disk('public')->delete($event->image);
        }

        $event->delete();

        return redirect()->route('dashboard.eo')->with('success', 'Event berhasil dihapus!');
    }

    public function publish($id)
    {
        $event = Event::findOrFail($id);

        abort_if($event->user_id !== Auth::id(), 403);

        $payment = Payment::where('event_id', $event->id)->where('status', 'paid')->first();

        if ($payment) {
            $event->update(['status' => 'live']);
            return redirect()->route('dashboard.eo')->with('success', 'Event berhasil dipublikasikan!');
        }

        return redirect()->route('eo.payment.checkout', ['event' => $event->id]);
    }
}