@extends('layouts.eo')

@section('title', 'Riwayat Pembayaran')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 fw-bold">Riwayat Pembayaran</h2>

    @if ($orders->count())
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Event</th>
                    <th>Jumlah Tiket</th>
                    <th>Total Harga</th>
                    <th>Tanggal Pembelian</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->event->name }}</td>
                        <td>{{ $order->quantity }}</td>
                        <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                        <td>{{ $order->created_at->format('d M Y H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-muted">Belum ada transaksi pembayaran.</p>
    @endif
</div>
@endsection
