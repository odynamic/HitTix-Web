@extends('layouts.app')

@section('title', 'Pembayaran Tiket - ' . $event->title)

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Pembayaran Tiket</h2>

    <div class="card">
        <div class="card-body">
            <p><strong>Event:</strong> {{ $event->title }}</p>
            <p><strong>Order ID:</strong> {{ $order->order_number }}</p>
            <p><strong>Total Bayar:</strong> Rp{{ number_format($order->total_amount) }}</p>
            <button id="pay-button" class="btn btn-success mt-3">Bayar Sekarang</button>
        </div>
    </div>
</div>

<!-- Midtrans Snap JS -->
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>

<script>
    document.getElementById('pay-button').addEventListener('click', function () {
        snap.pay('{{ $snapToken }}', {
            onSuccess: function(result) {
                alert("Pembayaran berhasil!");
                console.log(result);
                window.location.href = "{{ route('dashboard.eo.payments') }}";
            },
            onPending: function(result) {
                alert("Pembayaran tertunda. Silakan selesaikan pembayaran.");
                console.log(result);
            },
            onError: function(result) {
                alert("Terjadi kesalahan saat pembayaran.");
                console.log(result);
            },
            onClose: function() {
                alert('Anda menutup popup pembayaran.');
            }
        });
    });
</script>
@endsection
