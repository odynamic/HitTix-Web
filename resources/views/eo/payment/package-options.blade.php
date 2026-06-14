@extends('layouts.app')
@section('content')
<div class="container py-5">
    <h2 class="text-center mb-4">Konfirmasi Paket</h2>
    <div class="card mx-auto" style="max-width: 500px;">
        <div class="card-body">
            <h5 class="card-title">{{ $packageName }}</h5>
            <p class="card-text">Harga: Rp {{ number_format($price, 0, ',', '.') }}</p>
            <form method="POST" action="{{ route('eo.payment.checkout') }}">
                @csrf
                <input type="hidden" name="event_id" value="{{ $event->id }}">
                <input type="hidden" name="package" value="{{ $package }}">
                <button type="submit" class="btn btn-primary btn-block">Lanjutkan ke Pembayaran</button>
            </form>
        </div>
    </div>
</div>
@endsection
