{{-- resources/views/eo/payment/midtrans-pro.blade.php --}}
@extends('layouts.app')
@section('content')
<div class="container py-5 text-center">
    <h2 class="mb-4">Memproses Pembayaran</h2>
    <p>Silakan tunggu, sedang mengarahkan ke Midtrans...</p>
</div>
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script>
    window.snap.pay("{{ $snapToken }}", {
        onSuccess: function(result) {
            window.location.href = "{{ route('eo.payment.success', $event->id) }}";
        },
        onPending: function(result) {
            console.log('pending');
        },
        onError: function(result) {
            window.location.href = "{{ route('eo.payment.failed') }}";
        },
        onClose: function() {
            alert('Pembayaran dibatalkan.');
        }
    });
</script>
@endsection