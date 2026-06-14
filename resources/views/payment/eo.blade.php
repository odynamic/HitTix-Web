@extends('layouts.app')

@section('title', 'Gabung Jadi EO')

@section('content')
<style>
    body, html {
        height: 100%;
        margin: 0;
    }

    .main-wrapper {
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }

    main {
        flex: 1;
    }

    .btn-eo {
        background-color: #c2185b;
        color: white;
        border: 2px solid #c2185b;
        padding: 0.6rem 1.8rem;
        border-radius: 2rem;
        transition: all 0.3s ease;
    }

    .btn-eo:hover {
        background-color: white;
        color: #c2185b;
    }

    footer {
        background-color: #c2185b;
        color: white;
        text-align: center;
        padding: 1rem 0;
    }
</style>

<div class="main-wrapper">
    <main class="container py-5 text-center">
        <h2 class="fw-bold text-dark mb-3">Ingin Menjadi Event Organizer?</h2>
        <p class="lead text-secondary mb-4">
            Yuk gabung bersama <strong class="text-danger">HitTix</strong> dan mulai kelola event-mu sendiri!
        </p>

        <div class="d-flex justify-content-center gap-4 flex-wrap">
            <a href="{{ route('login') }}" class="btn btn-eo">Saya sudah punya akun (Login)</a>
            <a href="{{ route('eo.register') }}" class="btn btn-eo">Daftar Sebagai EO Baru</a>
        </div>
    </main>

    <footer>
        &copy; {{ date('Y') }} HitTix. All rights reserved.
    </footer>
</div>
@endsection
