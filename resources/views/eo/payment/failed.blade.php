{{-- resources/views/eo/payment/failed.blade.php --}}
@extends('layouts.app')
@section('content')
<div class="container py-5 text-center">
    <h2 class="text-danger">Pembayaran Gagal</h2>
    <p class="mt-3">Mohon coba lagi atau hubungi admin jika mengalami kendala.</p>
    <a href="{{ route('dashboard.eo') }}" class="btn btn-outline-danger mt-4">Kembali ke Dashboard</a>
</div>
@endsection