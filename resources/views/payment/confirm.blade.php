@extends('layouts.app')

@section('content')
<div class="container py-5 text-center">
    <h3 class="mb-4">Selesaikan Pembayaran</h3>
    <p>Total yang harus dibayar: <strong>Rp{{ number_format($order->total_price, 0, ',', '.') }}</strong></p>
    <button id="pay-button" class="btn btn-pink">Bayar Sekarang</button>
</div>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script>
    document.getElementById('pay-button').addEventListener('click', function () {
        snap.pay('{{ $snapToken }}', {
            onSuccess: function(result){
                window.location.href = "{{ route('jelajah') }}?success=1";
            },
            onPending: function(result){
                alert("Transaksi sedang diproses");
            },
            onError: function(result){
                alert("Terjadi kesalahan");
            }
        });
    });
</script>
@endsection
