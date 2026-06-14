<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureEoHasPaid
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::user()->has_paid) { // atau cek dari tabel EO Subscription / Payment Status
            return redirect()->route('eo.payment.options')
                ->with('warning', 'Silakan selesaikan pembayaran terlebih dahulu untuk membuat event.');
        }

        return $next($request);
    }
}
