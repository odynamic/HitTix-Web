<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Payment;
use Midtrans\Snap;
use Midtrans\Config;
use Midtrans\Transaction;

class MidtransController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    /**
     * Redirect ke halaman pembayaran Midtrans
     */
    public function redirectToMidtrans()
    {
        $package = session('selected_package');

        if (!in_array($package, ['basic', 'pro'])) {
            return redirect()->route('eo.payment.options')->with('error', 'Paket tidak valid.');
        }

        $user = Auth::user();
        $orderId = strtoupper($package) . '-' . uniqid();
        $price = $package === 'basic' ? 50000 : 100;

        // Simpan data pembayaran ke database
        Payment::create([
            'user_id' => $user->id,
            'order_id' => $orderId,
            'gross_amount' => $price,
            'status' => 'pending',
            'package_type' => $package,
        ]);

        // Simpan sementara jenis paket ke user
        $user->package_type = ucfirst($package);
        $user->save();

        // Data transaksi untuk Midtrans
        $payload = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $price,
            ],
            'customer_details' => [
                'first_name' => $user->name,
                'email' => $user->email,
            ],
        ];

        $snapToken = Snap::getSnapToken($payload);

        return view('payment.pro-checkout', [
            'snapToken' => $snapToken,
            'orderId' => $orderId,
            'package' => ucfirst($package),
        ]);
    }

    /**
     * Callback dari Midtrans (Webhook)
     */
    public function callback(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $hashed = hash('sha512', $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed !== $request->signature_key) {
            Log::warning("Invalid signature key from Midtrans.");
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        try {
            $payment = Payment::where('order_id', $request->order_id)->first();

            if (!$payment) {
                Log::warning("Payment not found for Order ID: " . $request->order_id);
                return response()->json(['message' => 'Payment not found'], 404);
            }

            if (in_array($request->transaction_status, ['settlement', 'capture'])) {
                DB::beginTransaction();

                $payment->status = 'paid';
                $payment->save();

                // Tandai user sebagai EO aktif
                $user = $payment->user;
                $user->is_eo_active = true;
                $user->save();

                DB::commit();
            }

            return response()->json(['status' => 'OK']);
        } catch (\Exception $e) {
            Log::error("Midtrans Callback Error: " . $e->getMessage());
            DB::rollBack();
            return response()->json(['message' => 'Callback failed'], 500);
        }
    }

    /**
     * Manual check status transaksi
     */
public function checkStatus($order_id)
{
    try {
        $status = Transaction::status($order_id);

        Log::info("Cek status: Order $order_id, Status: {$status['transaction_status']}");

        return response()->json([
            'transaction_status' => $status['transaction_status'],
            'order_id' => $status['order_id'],
            'gross_amount' => $status['gross_amount'],
        ]);        } catch (\Exception $e) {
            Log::error("Check Status Error: " . $e->getMessage());
            return response()->json([
                'message' => 'Gagal mengambil status transaksi.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
