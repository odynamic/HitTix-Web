@extends('layouts.app')

@section('content')
<div class="container py-5 text-center">
    <h4>Mohon tunggu, Anda sedang diarahkan ke halaman pembayaran...</h4>
</div>

<script type="text/javascript"
    src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="{{ config('midtrans.client_key') }}">
</script>

<script type="text/javascript">
    window.snap.pay('{{ $snapToken }}', {
        onSuccess: function(result) {
            window.location.href = '{{ route("jelajah") }}';
        },
        onPending: function(result) {
            window.location.href = '{{ route("jelajah") }}';
        },
        onError: function(result) {
            alert("Terjadi kesalahan saat memproses pembayaran.");
        }
    });
</script>
@endsection
