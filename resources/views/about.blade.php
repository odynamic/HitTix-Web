@extends('layouts.app')
@section('title', 'Tentang Kami | HitTix')

@section('content')
<div class="container py-5">
    <!-- Hero Section -->
    <div class="text-center mb-5">
        <h1 class="fw-bold" style="color: #C2185B; font-size: 2.7rem;">Temukan & Ciptakan Event di <span class="text-dark">HitTix</span></h1>
        <p class="text-muted mx-auto" style="max-width: 760px; font-size: 1.05rem;">
            HitTix adalah platform digital yang memudahkan siapa pun untuk membeli tiket event favorit, sekaligus mendukung para event creator dalam menjual dan mengelola acaranya secara profesional.
        </p>
    </div>

    <!-- Fitur Dua Arah -->
    <div class="row text-center justify-content-center mb-5">
        <div class="col-md-5 mb-4">
            <div class="p-4 shadow-sm rounded bg-white h-100">
                <h4 class="fw-bold text-danger">Untuk Pengunjung</h4>
                <p class="text-muted">Cari dan beli tiket event favoritmu dengan proses yang cepat dan aman. Temukan konser dan festival terbaru dengan satu klik.</p>
            </div>
        </div>
        <div class="col-md-5 mb-4">
            <div class="p-4 shadow-sm rounded bg-white h-100">
                <h4 class="fw-bold text-danger">Untuk Event Creator</h4>
                <p class="text-muted">Buat event dengan mudah, atur tiket, lacak penjualan, dan promosikan acara kamu melalui satu dashboard yang powerful.</p>
            </div>
        </div>
    </div>

    <!-- Tim Kami -->
    <div class="text-center mb-4">
        <h3 class="fw-bold text-danger mb-2">Tim HitTix</h3>
        <p class="text-muted">Di balik layar pembangunan solusi bagi industri hiburan digital.</p>
    </div>
    <div class="row justify-content-center g-4">
        @php
            $teams = [
                ['name' => 'Dyah', 'role' => 'Backend Developer'],
                ['name' => 'Ayu', 'role' => 'Frontend Developer'],
                ['name' => 'Sasa', 'role' => 'UI/UX Designer'],
            ];
        @endphp

        @foreach ($teams as $member)
        <div class="col-md-3 col-sm-6">
            <div class="card border-0 shadow-sm text-center py-4 px-3 h-100">
                <img src="https://ui-avatars.com/api/?name={{ $member['name'] }}&background=F8BBD0&color=000&size=100"
                     class="rounded-circle mx-auto mb-3" width="90" height="90" alt="{{ $member['name'] }}">
                <h5 class="fw-semibold mb-1">{{ $member['name'] }}</h5>
                <p class="text-muted small">{{ $member['role'] }}</p>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
