@extends('layouts.app')

@section('title', 'Gabung Jadi EO')

@section('content')
<style>
    a.btn-soft, a.btn-outline-soft {
        text-decoration: none; /* HILANGKAN GARIS BAWAH */
    }

    .btn-soft {
        background-color: #ff85a2;
        color: #fff;
        border: none;
        border-radius: 999px;
        padding: 0.5rem 1.5rem;
        font-weight: 500;
        transition: background-color 0.3s ease;
    }

    .btn-soft:hover {
        background-color: #ff4d79;
        color: #fff;
        text-decoration: none;
    }

    .btn-outline-soft {
        background-color: transparent;
        border: 2px solid #ff85a2;
        color: #ff85a2;
        border-radius: 999px;
        padding: 0.5rem 1.5rem;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn-outline-soft:hover {
        background-color: #ff85a2;
        color: #fff;
        text-decoration: none;
    }
</style>

<main>
    <div class="text-center">
        <h1 class="fw-bold mb-3" style="color:#333;">Bergabung Jadi Event Organizer di HitTix!</h1>
        <p class="mb-4" style="color:#555;">Mulai perjalanan seru bersama kami. Kelola event kamu dengan mudah dan jangkau lebih banyak pengunjung!</p>

        <div class="d-flex justify-content-center gap-3 flex-wrap">
            <a href="{{ route('eo.login.form') }}" class="btn-outline-soft">
                Saya Sudah Punya Akun
            </a>
            <a href="{{ route('eo.register.form') }}" class="btn-soft">
                Daftar Sebagai EO Baru
            </a>
        </div>
    </div>
</main>

@endsection
