<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Midtrans\Snap;
use Midtrans\Config;

class EoPaymentController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function showOptions()
    {
        $events = Event::where('user_id', Auth::id())->get();
        return view('eo.payment.options', compact('events'));
    }

public function index(Event $event, Request $request)
{
    $this->authorize('view', $event);

    $package = $request->query('package');

    if (!in_array($package, ['basic', 'pro'])) {
        abort(404, 'Paket tidak valid.');
    }

    $price = $package === 'pro' ? 200000 : 100000;
    $packageName = $package === 'pro' ? 'Paket Pro' : 'Paket Basic';

    return view('eo.payment.package-options', compact('event', 'package', 'price', 'packageName'));
}
public function checkout(Request $request)
{
    $validated = $request->validate([
        'event_id' => 'required|exists:events,id',
        'package' => 'required|in:basic,pro'
    ]);

    $event = Event::where('id', $validated['event_id'])
                 ->where('user_id', Auth::id())
                 ->firstOrFail();

    $price = $validated['package'] === 'pro' ? 200000 : 100000;
    $orderId = 'EO-' . $event->id . '-' . time();

    $params = [
        'transaction_details' => [
            'order_id' => $orderId,
            'gross_amount' => $price,
        ],
        'customer_details' => [
            'first_name' => Auth::user()->name,
            'email' => Auth::user()->email,
        ]
    ];

    $snapToken = \Midtrans\Snap::getSnapToken($params);

    \App\Models\Payment::create([
        'user_id' => Auth::id(),
        'event_id' => $event->id,
        'order_id' => $orderId,
        'amount' => $price,
        'status' => 'pending',
        'type' => 'event_package',
        'package' => $validated['package'],
    ]);

    return view('eo.payment.midtrans-pro', compact('snapToken', 'event'));
}
    public function paymentSuccess(Event $event)
    {
        return view('eo.payment.success', compact('event'));
    }

    public function paymentFailed()
    {
        return view('eo.payment.failed');
    }
}
