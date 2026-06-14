{{-- resources/views/eo/payment/success.blade.php --}}
@extends('layouts.app')
@section('content')
<div class="container py-5 text-center">
    <h2 class="text-success">Pembayaran Berhasil!</h2>
    <p class="mt-3">Terima kasih, event Anda telah dipublikasikan.</p>
    <a href="{{ route('dashboard.eo') }}" class="btn btn-outline-success mt-4">Kembali ke Dashboard</a>
</div>
@endsection
