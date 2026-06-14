@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
    <!-- Hero -->
    <section class="hero-section mt-5">
    <div class="hero-content">
        <h1>Where Great Events Begin</h1>
        <p>HitTix— Easily find and book tickets for concerts, festivals, and more.</p>
        <a href="#jelajah" class="btn btn-primary-custom">Jelajahi Sekarang</a>
    </div>
    </section>

    <!-- Section: Apa yang Ditawarkan -->
    <section class="section-light text-center" style="padding-top: 150px;>
        <div class="container">
            <h2 class="mb-5">Kenapa Harus Pilih HitTix?</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <i class="bi bi-ticket-perforated fs-1 text-danger"></i>
                    <h5 class="mt-3">Beli Tiket Online</h5>
                    <p class="text-muted">Pesan tiket kapan saja, di mana saja, dengan sistem pembayaran aman.</p>
                </div>
                <div class="col-md-4">
                    <i class="bi bi-megaphone fs-1 text-danger"></i>
                    <h5 class="mt-3">Promosi Event</h5>
                    <p class="text-muted">Kami bantu promosikan event-mu melalui berbagai kanal.</p>
                </div>
                <div class="col-md-4">
                    <i class="bi bi-calendar-plus fs-1 text-danger"></i>
                    <h5 class="mt-3">Gabung Jadi EO!</h5>
                    <p class="text-muted">Upload dan kelola event sendiri dengan gratis dan mudah!</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Section: Event Populer -->
    <section id="jelajah" class="container mt-5 mb-5" style="padding-top: 75px;">
<h2 class="text-center mb-5">Event Populer</h2>
        <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
    @forelse ($events as $event)
    <div class="col">
        <div class="card border-0 shadow-sm rounded-4">
            <img src="{{ asset('storage/' . $event->image) }}" class="card-img-top"
                style="height: 150px; object-fit: cover; border-radius: 16px 16px 0 0;"
                alt="{{ $event->name }}">
            <div class="card-body">
                <h5 class="card-title">{{ $event->name }}</h5>
                <p class="text-muted small">
                    <i class="bi bi-calendar-event me-1"></i>
                    {{ \Carbon\Carbon::parse($event->event_date)->format('d M Y') }}
                </p>
                <p class="text-muted small">
                    <i class="bi bi-geo-alt me-1"></i>
                    {{ $event->venue ?? 'Lokasi tidak tersedia' }}
                </p>
                <a href="{{ route('events.show', $event->id) }}" class="btn btn-primary-custom w-100 mt-2">Lihat Detail</a>
            </div>
        </div>
    </div>
    @empty
    <p class="text-muted">Belum ada event saat ini.</p>
    @endforelse
</div>
        </div>
    </section>

    <!-- Section: Cara Pesan Tiket -->
    <section class="section-light text-center" style="padding-top: 100px;>
        <div class="container">
            <h2 class="mb-5">Gampangnya Pesan Tiket di HitTix!</h2>
            <div class="row g-5 justify-content-center">
                <div class="col-md-3">
                    <i class="bi bi-search step-icon"></i>
                    <div class="step-title">1. Temukan Event</div>
                    <p class="step-desc">Jelajahi beragam dan temukan event yang sesuai minatmu.</p>
                </div>
                <div class="col-md-3">
                    <i class="bi bi-cart-plus step-icon"></i>
                    <div class="step-title">2. Pilih Tiket</div>
                    <p class="step-desc">Pilih jumlah dan jenis tiket yang kamu inginkan.</p>
                </div>
                <div class="col-md-3">
                    <i class="bi bi-credit-card step-icon"></i>
                    <div class="step-title">3. Lakukan Pembayaran</div>
                    <p class="step-desc">Bayar dengan metode yang tersedia secara aman.</p>
                </div>
                <div class="col-md-3">
                    <i class="bi bi-envelope-open step-icon"></i>
                    <div class="step-title">4. Dapatkan Tiket</div>
                    <p class="step-desc">Tiket langsung dikirim ke email dan siap digunakan.</p>
                </div>
            </div>
        </div>
    </section>
@endsection
