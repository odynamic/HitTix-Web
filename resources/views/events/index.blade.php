@extends('layouts.app')

@section('title', 'Jelajah Event')

@section('content')
<style>
    .form-control,
    .form-select {
        border-radius: 8px;
        font-size: 14px;
    }

    .card-img-top {
        height: 110px;
        object-fit: cover;
    }

    .card {
        transition: 0.3s ease;
        font-size: 13px;
        padding: 0.5rem;
    }

    .card:hover {
        transform: scale(1.02);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
    }

    .card-body {
        padding: 0.75rem;
    }

    .card h6 {
        font-size: 14px;
        margin-bottom: 6px;
    }

    .card p {
        margin-bottom: 4px;
    }

    .btn-sm {
        font-size: 12px;
        padding: 4px 8px;
    }

        .btn-pink {
        background-color: #ff85a2;
        color: white;
        border: none;
    }

    .btn-pink:hover {
        background-color: #ff6d8c;
        color: white;
    }

    .text-pink {
        color: #ff85a2;
    }

</style>

<div class="container py-4">
    <div class="row">
        {{-- Sidebar Filter --}}
        <div class="col-lg-3 mb-4">
            <form method="GET" action="{{ route('jelajah') }}" class="bg-light p-3 rounded">
                <h5 class="fw-bold mb-3">Cari & Filter</h5>

                <div class="mb-3">
                    <input type="text" name="q" class="form-control" placeholder="Cari nama event..." value="{{ request('q') }}">
                </div>

                <div class="mb-3">
                    <select name="lokasi" class="form-select">
                        <option value="">Pilih Kota</option>
                        @php
                            $cities = ['Jakarta', 'Bandung', 'Surabaya', 'Yogyakarta', 'Semarang', 'Medan', 'Denpasar', 'Makassar'];
                        @endphp
                        @foreach($cities as $city)
                            <option value="{{ $city }}" {{ request('lokasi') == $city ? 'selected' : '' }}>{{ $city }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal Mulai</label>
                    <input type="date" name="date_start" class="form-control" value="{{ request('date_start') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal Akhir</label>
                    <input type="date" name="date_end" class="form-control" value="{{ request('date_end') }}">
                </div>

                <div class="mb-3">
                    <input type="number" name="harga" class="form-control" placeholder="Harga Maksimal" value="{{ request('harga') }}">
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-pink w-100">Terapkan</button>
                    <a href="{{ route('jelajah') }}" class="btn btn-secondary w-100">Reset</a>
                </div>
            </form>
        </div>

        {{-- Daftar Event --}}
        <div class="col-lg-9">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="fw-bold mb-0">Jelajah Event</h4>

                <form method="GET" action="{{ route('jelajah') }}" class="d-flex align-items-center gap-2">
                    {{-- Hidden filters agar tetap saat sort diubah --}}
                    <input type="hidden" name="q" value="{{ request('q') }}">
                    <input type="hidden" name="lokasi" value="{{ request('lokasi') }}">
                    <input type="hidden" name="date_start" value="{{ request('date_start') }}">
                    <input type="hidden" name="date_end" value="{{ request('date_end') }}">
                    <input type="hidden" name="harga" value="{{ request('harga') }}">

                    <label for="sort" class="mb-0 me-1">Urutkan:</label>
                    <select name="sort" id="sort" class="form-select w-auto" onchange="this.form.submit()">
                        <option value="">Pilih</option>
                        <option value="termurah" {{ request('sort') == 'termurah' ? 'selected' : '' }}>Harga Termurah</option>
                        <option value="terbaru" {{ request('sort') == 'terbaru' ? 'selected' : '' }}>Tanggal Terbaru</option>
                    </select>
                </form>
            </div>

            <div class="row g-2">
                @forelse($events as $event)
                    <div class="col-6 col-md-3">
                        <div class="card h-100 border-0 shadow-sm rounded-3">
                            <img src="{{ asset('storage/' . $event->image) }}" class="card-img-top rounded-top-3" alt="{{ $event->name }}">
                            <div class="card-body d-flex flex-column">
                                <h6 class="fw-semibold">{{ $event->name }}</h6>
                                <p class="text-muted small">
                                    <i class="bi bi-geo-alt-fill me-1"></i> {{ $event->venue }}
                                </p>
                                <p class="small">
                                    <i class="bi bi-calendar3 me-1"></i> {{ \Carbon\Carbon::parse($event->event_date)->format('d M Y') }}
                                </p>
                                <p class="fw-bold text-pink">
                                    Rp{{ number_format($event->price, 0, ',', '.') }}
                                </p>
                                <a href="{{ route('events.show', $event) }}" class="btn btn-pink btn-sm mt-auto">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-muted text-center">Tidak ada event ditemukan.</p>
                    </div>
                @endforelse
            </div>

            <div class="d-flex justify-content-center mt-4">
                {{ $events->withQueryString()->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
