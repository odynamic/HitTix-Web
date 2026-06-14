@extends('layouts.eo')

@section('title', 'Tiket Terjual')

@section('content')
<h2>Data Penjualan Tiket</h2>
<table border="1" width="100%">
    <thead>
        <tr>
            <th>Event</th>
            <th>Tiket Terjual</th>
            <th>Total Pendapatan</th>
        </tr>
    </thead>
    <tbody>
        @foreach($sales as $sale)
        <tr>
            <td>{{ $sale->event_name }}</td>
            <td>{{ $sale->tickets_sold }}</td>
            <td>Rp {{ number_format($sale->revenue, 0, ',', '.') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection