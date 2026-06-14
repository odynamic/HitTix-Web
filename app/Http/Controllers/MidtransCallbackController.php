<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Log;
use Midtrans\Notification;

class MidtransCallbackController extends Controller
{
    public function handle(Request $request)
    {
        // Inisialisasi notifikasi dari Midtrans
        $notif = new Notification();

        $transactionStatus = $notif->transaction_status;
        $paymentType = $notif->payment_type;
        $orderId = $notif->order_id;
        $fraudStatus = $notif->fraud_status;

        // Logging buat debug
        Log::info('Midtrans Callback', [
            'order_id' => $orderId,
            'transaction_status' => $transactionStatus,
            'payment_type' => $paymentType,
            'fraud_status' => $fraudStatus,
        ]);

        // Temukan order dari database
        $order = Order::where('order_number', $orderId)->first();

        if (!$order) {
            return response()->json(['message' => 'Order not found.'], 404);
        }

        // Update status sesuai status transaksi dari Midtrans
        if ($transactionStatus == 'capture') {
            if ($paymentType == 'credit_card') {
                if ($fraudStatus == 'challenge') {
                    $order->status = 'challenge';
                } else {
                    $order->status = 'success';
                }
            }
        } elseif ($transactionStatus == 'settlement') {
            $order->status = 'success';
        } elseif ($transactionStatus == 'pending') {
            $order->status = 'pending';
        } elseif (in_array($transactionStatus, ['deny', 'expire', 'cancel'])) {
            $order->status = 'failed';
        }

        $order->save();

        return response()->json(['message' => 'Callback handled.']);
    }
}
