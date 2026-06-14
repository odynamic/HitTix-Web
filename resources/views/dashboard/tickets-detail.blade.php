@extends('layouts.eo')

@section('title', 'Detail Tiket Event')

@section('content')
<div class="container py-4">
    <h2 class="fw-bold mb-4">Detail Transaksi - {{ $event->name }}</h2>

    <div class="mb-3">
        <strong>Tanggal Event:</strong> {{ \Carbon\Carbon::parse($event->event_date)->format('d M Y') }}<br>
        <strong>Total Tiket Terjual:</strong> {{ $orders->sum('quantity') }}<br>
        <strong>Total Pendapatan:</strong> Rp {{ number_format($orders->sum('total_price'), 0, ',', '.') }}
    </div>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Pembeli</th>
                <th>Jumlah Tiket</th>
                <th>Total Harga</th>
                <th>Tanggal Beli</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $order->user->name ?? 'Unknown' }}</td>
                    <td>{{ $order->quantity }}</td>
                    <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                    <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d M Y H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">Belum ada transaksi.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <a href="{{ route('dashboard.eo.tickets') }}" class="btn btn-secondary mt-3">← Kembali ke Daftar Event</a>
</div>
@endsection
