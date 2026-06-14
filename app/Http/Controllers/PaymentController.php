<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Ticket;
use Midtrans\Snap;
use Midtrans\Config;
class PaymentController extends Controller
{
    public function showEventPayment(Ticket $ticket)
    {
        return view('payment.event', compact('ticket'));
    }

public function processEventPayment(Request $request)
{
    $ticket = Ticket::findOrFail($request->ticket_id);
    $quantity = (int) $request->quantity;
    $total = $ticket->price * $quantity;

    // Simpan order sementara
    $order = Order::create([
        'user_id' => auth()->id(),
        'event_id' => $request->event_id,
        'ticket_id' => $ticket->id,
        'quantity' => $quantity,
        'total_price' => $total,
    ]);

    // Konfigurasi Midtrans
    Config::$serverKey = config('midtrans.server_key');
    Config::$isProduction = false;
    Config::$isSanitized = true;
    Config::$is3ds = true;

    $params = [
        'transaction_details' => [
            'order_id' => 'ORD-' . $order->id,
            'gross_amount' => $total,
        ],
        'customer_details' => [
            'first_name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]
    ];

    $snapToken = Snap::getSnapToken($params);

    return view('payment.confirm', [
        'snapToken' => $snapToken,
        'order' => $order
    ]);
}

    public function handleMidtransCallback(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $signatureKey = $request->input('signature_key');
        $orderId = $request->input('order_id');
        $statusCode = $request->input('status_code');
        $grossAmount = $request->input('gross_amount');

        $computedSignature = hash('sha512', $orderId . $statusCode . $grossAmount . $serverKey);

        if ($signatureKey !== $computedSignature) {
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        $transactionStatus = $request->input('transaction_status');
        $order = Order::where('order_number', $orderId)->first();

        if ($order) {
            if ($transactionStatus === 'capture' || $transactionStatus === 'settlement') {
                $order->status = 'paid';
                $order->save();
            } elseif (in_array($transactionStatus, ['deny', 'cancel', 'expire'])) {
                $order->status = 'failed';
                $order->save();
            }
        }

        return response()->json(['message' => 'Notification processed']);
    }
}
