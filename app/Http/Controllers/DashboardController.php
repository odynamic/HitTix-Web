<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
class DashboardController extends Controller
{
    public function index()
    {
        $eoId = Auth::id();

        // Ambil semua event milik EO ini
        $events = Event::where('user_id', $eoId)->get();

        // Total event
        $totalEvents = $events->count();

        // Event mendatang
        $upcomingEvents = $events->where('event_date', '>', now())->count();

        // Ambil semua orders dari event milik EO
        $eventIds = $events->pluck('id');
        $orders = Order::whereIn('event_id', $eventIds)->get();

        // Total tiket terjual
        $totalTickets = $orders->sum('quantity'); // pastikan ada kolom quantity di orders

        // Total pendapatan
        $totalRevenue = $orders->sum('total_price');

        // Data untuk grafik
        $chartLabels = [];
        $chartData = [];

        foreach ($events as $event) {
            $chartLabels[] = $event->name;
            $ticketsSold = $orders->where('event_id', $event->id)->sum('quantity');
            $chartData[] = $ticketsSold;
        }

        // Data per event untuk tabel
        $eventData = $events->map(function ($event) use ($orders) {
            $eventOrders = $orders->where('event_id', $event->id);
            return (object) [
                'name' => $event->name,
                'event_date' => $event->event_date,
                'tickets_sold' => $eventOrders->sum('quantity'),
                'revenue' => $eventOrders->sum('total_price'),
            ];
        });

        return view('dashboard.index', compact(
    'totalEvents',
    'upcomingEvents',
    'totalTickets',
    'totalRevenue',
    'chartLabels',
    'chartData',
    'eventData',
    'events' 
));

    }

    public function tickets()
{
    $eoId = auth()->id();

    // Ambil event milik EO yang sedang login, beserta order-nya
    $events = \App\Models\Event::with(['orders' => function ($query) {
        $query->select('id', 'event_id', 'quantity', 'total_price');
    }])
    ->where('user_id', $eoId)
    ->get();

    return view('dashboard.tickets', compact('events'));
}


public function ticketDetail($eventId)
{
    $eoId = auth()->id();

    $event = \App\Models\Event::with(['orders.user']) // jika order ada relasi ke user
        ->where('id', $eventId)
        ->where('user_id', $eoId)
        ->firstOrFail();

    $orders = $event->orders;

    return view('dashboard.tickets-detail', compact('event', 'orders'));
}

public function payments()
{
    $eoId = auth()->id();

    // Ambil semua event milik EO
    $events = \App\Models\Event::where('user_id', $eoId)->get();

    // Ambil semua order dari event-event tersebut
    $eventIds = $events->pluck('id');
    $orders = \App\Models\Order::whereIn('event_id', $eventIds)
        ->with('event')
        ->orderByDesc('created_at')
        ->get();

    return view('dashboard.payments', compact('orders'));
}


}
