@extends('layouts.eo')

@section('title', 'Tiket Terjual')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 fw-bold">Tiket Terjual</h2>

    {{-- Filter Tanggal Pembelian (opsional) --}}
    <form method="GET" action="{{ route('dashboard.eo.tickets') }}" class="row g-3 mb-4">
        <div class="col-md-3">
            <label for="start_date" class="form-label">Dari Tanggal</label>
            <input type="date" name="start_date" id="start_date" class="form-control"
                   value="{{ request('start_date') }}">
        </div>
        <div class="col-md-3">
            <label for="end_date" class="form-label">Sampai Tanggal</label>
            <input type="date" name="end_date" id="end_date" class="form-control"
                   value="{{ request('end_date') }}">
        </div>
        <div class="col-md-3 align-self-end">
            <button type="submit" class="btn btn-primary">Filter</button>
<a href="{{ route('dashboard.eo.tickets') }}" class="btn btn-outline-secondary">Reset</a>
        </div>
    </form>

    {{-- Tabel Tiket Terjual --}}
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Nama Event</th>
                <th>Tanggal</th>
                <th>Jumlah Tiket Terjual</th>
                <th>Total Pendapatan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($events as $event)
                <tr>
                    <td>{{ $event->name }}</td>
                    <td>{{ \Carbon\Carbon::parse($event->event_date)->format('d M Y') }}</td>
                    <td>{{ $event->orders->sum('quantity') }}</td>
                    <td>Rp {{ number_format($event->orders->sum('total_price'), 0, ',', '.') }}</td>
                    <td>
<a href="{{ route('eo.tickets.detail', $event->id) }}" class="btn btn-sm btn-primary">Lihat Detail</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Belum ada data event atau tiket terjual.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
