@extends('layouts.app')

@section('content')
<style>
    .event-header {
        text-align: center;
        margin-bottom: 2rem;
    }

    .event-title {
        color: #d63384;
        font-weight: bold;
    }

    .event-img {
        max-height: 350px;
        object-fit: cover;
        border-radius: 16px;
        width: 100%;
    }

    .ticket-card {
        background-color: #fff0f5;
        border-radius: 12px;
        padding: 1rem;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
        margin-bottom: 1rem;
    }

    .ticket-name {
        font-weight: 600;
        font-size: 1.1rem;
    }

    .ticket-status {
        font-size: 0.85rem;
        font-weight: 500;
        color: #6c757d;
    }

    .badge-status {
        font-size: 0.75rem;
        padding: 0.25rem 0.6rem;
        border-radius: 50px;
    }

    .badge-sale {
        background-color: #d63384;
        color: #fff;
    }

    .badge-sold {
        background-color: #999;
        color: #fff;
    }
</style>

<div class="container py-4">
    <div class="event-header">
        <h2 class="event-title">{{ $event->name }}</h2>
        <p class="text-muted">{{ $event->venue }} | {{ \Carbon\Carbon::parse($event->event_date)->translatedFormat('d F Y') }}</p>
    </div>

    @if ($event->image)
        <div class="mb-4">
            <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->name }}" class="event-img">
        </div>
    @endif

    <div class="mb-4">
        <h5>Deskripsi Acara</h5>
        <p>{{ $event->description }}</p>
    </div>

    <div class="mb-4">
        <h5>Waktu</h5>
        @if ($event->start_time && $event->end_time)
            <p>{{ \Carbon\Carbon::parse($event->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($event->end_time)->format('H:i') }}</p>
        @else
            <p class="text-muted">Waktu belum ditentukan</p>
        @endif
    </div>

    <div class="mb-4">
        <h5>Daftar Tiket</h5>

@forelse ($event->tickets as $ticket)
    <div class="ticket-card">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <div class="ticket-name">{{ $ticket->name }}</div>
                <div class="ticket-status">
                    Harga: Rp{{ number_format($ticket->price, 0, ',', '.') }} <br>
                    Kuota: {{ $ticket->quota }}
                </div>
            </div>
            <div class="text-end">
                @if($ticket->quota > 0)
                    <a href="{{ route('orders.create', ['event' => $event->id, 'ticket' => $ticket->id]) }}"
                       class="btn btn-sm btn-primary mt-2">
                        Beli Tiket
                    </a>
                @else
                    <span class="badge badge-sold">Habis</span>
                @endif
            </div>
        </div>
    </div>
@empty
    <p class="text-muted">Belum ada tiket yang tersedia.</p>
@endforelse

    </div>

    <div class="mb-4">
        <h5>Informasi Tambahan</h5>
        <ul class="list-unstyled">
            <li><strong>Venue:</strong> {{ $event->venue }}</li>
            <li><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($event->event_date)->translatedFormat('d F Y') }}</li>
            @if ($event->contact_person)
                <li><strong>Kontak:</strong> {{ $event->contact_person }}</li>
            @endif
            @if ($event->type)
                <li><strong>Tipe Acara:</strong> {{ ucfirst($event->type) }}</li>
            @endif
            @if ($event->category?->name)
                <li><strong>Kategori:</strong> {{ $event->category->name }}</li>
            @endif
            @if ($event->eo?->name)
                <li><strong>EO Penyelenggara:</strong> {{ $event->eo->name }}</li>
            @endif
        </ul>
    </div>
</div>
@endsection
