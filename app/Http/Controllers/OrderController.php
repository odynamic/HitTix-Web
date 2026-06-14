<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Ticket;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Midtrans\Snap;
use Midtrans\Config;

class OrderController extends Controller
{
    // Menampilkan form pembelian tiket
public function showBuyForm(Request $request, Event $event)
{
    $ticketId = $request->query('ticket'); // Ambil dari URL ?ticket=...

    $tickets = $event->tickets()->active()->available()->get();
    $selectedTicket = $tickets->where('id', $ticketId)->first();

    return view('orders.buy', compact('event', 'tickets', 'selectedTicket'));
}

    // Proses pembelian tiket
    public function store(Request $request, Event $event)
    {
        $request->validate([
            'ticket_id' => 'required|exists:tickets,id',
            'jumlah_tiket' => 'required|integer|min:1',
        ]);

        $ticket = Ticket::findOrFail($request->ticket_id);
        $jumlahTiket = $request->jumlah_tiket;

        // Validasi sisa tiket
        if ($ticket->remaining_tickets < $jumlahTiket) {
            return back()->withErrors(['jumlah_tiket' => 'Sisa tiket tidak mencukupi.'])->withInput();
        }

        $total = $jumlahTiket * $ticket->price;

        // Buat order
        $order = Order::create([
            'user_id' => Auth::check() ? Auth::id() : null,
            'order_number' => Order::generateOrderNumber(),
            'total_amount' => $total,
            'status' => 'pending',
        ]);

        // Tambah order item
        if (method_exists($order, 'orderItems')) {
            $order->orderItems()->create([
                'ticket_id' => $ticket->id,
                'jumlah' => $jumlahTiket,
                'harga_satuan' => $ticket->price,
            ]);
        }

        // Update tiket terjual
        $ticket->increment('sold', $jumlahTiket);

        // Konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = false; // Set true jika produksi
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // Data transaksi ke Midtrans
        $params = [
            'transaction_details' => [
                'order_id' => $order->order_number,
                'gross_amount' => $order->total_amount,
            ],
            'customer_details' => [
                'first_name' => Auth::check() ? Auth::user()->name : 'Guest',
                'email' => Auth::check() ? Auth::user()->email : 'guest@example.com',
            ],
            'callbacks' => [
                'finish' => route('dashboard.eo.payments'),
            ]
        ];

        // Dapatkan Snap Token
        $snapToken = Snap::getSnapToken($params);

        return view('orders.payment', compact('snapToken', 'order', 'event'));
    }

    // Optional: Menampilkan halaman sukses
    public function success()
    {
        return view('orders.success');
    }

    // Optional: Menampilkan halaman gagal
    public function failed()
    {
        return view('orders.failed');
    }
}
