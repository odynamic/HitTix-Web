@extends('layouts.eo')

@section('title', 'Riwayat Pembayaran')

@section('content')
<h2>Paket Langganan & Penghasilan</h2>
<h4>Paket Langganan:</h4>
<ul>
    <li>Paket saat ini: {{ $packageName ?? 'Belum berlangganan' }}</li>
    <li>Status pembayaran: {{ $paymentStatus ?? '-' }}</li>
</ul>
<h4>Penghasilan Akan Dicairkan:</h4>
<ul>
    <li>Total: Rp {{ number_format($earnings, 0, ',', '.') }}</li>
</ul>
@endsection