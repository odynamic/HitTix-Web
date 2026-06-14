@extends('layouts.app')
@section('title', 'Gabung Jadi EO | HitTix')

@section('content')
<style>
    .form-control {
        border-radius: 10px;
        border: 1px solid #ffc0cb;
    }

    .btn-pink {
        background-color: #ff85a2;
        border: none;
        color: #fff;
        border-radius: 999px;
        padding: 0.5rem 1.5rem;
        font-weight: 500;
        transition: background-color 0.3s ease;
    }

    .btn-pink:hover {
        background-color: #ff4d79;
    }

    .link-pink {
        color: #d63384;
        text-decoration: none;
        font-weight: 500;
    }

    .link-pink:hover {
        color: #b3005c;
        text-decoration: underline;
    }

    .alert-success, .alert-danger {
        border-radius: 10px;
    }
</style>

<div class="container mt-5" style="max-width: 400px;">
    <h2 class="text-center fw-bold mb-4">Gabung Jadi EO</h2>

    @if(session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('eo.register.submit') }}" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nama Lengkap</label>
            <input type="text" name="user_name" value="{{ old('user_name') }}" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Nama Akun (tanpa @)</label>
            <input type="text" name="username" value="{{ old('username') }}" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Alamat Email</label>
            <input type="email" name="user_email" value="{{ old('user_email') }}" class="form-control" autocomplete="off">
        </div>

        <div class="mb-3">
            <label class="form-label">Nomor Telepon</label>
            <input type="text" name="phone" value="{{ old('phone') }}" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Tanggal Lahir</label>
            <input type="date" name="birthdate" value="{{ old('birthdate') }}" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Foto Profil</label>
            <input type="file" name="profile_picture" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="user_password" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Konfirmasi Password</label>
            <input type="password" name="user_password_confirmation" class="form-control">
        </div>

        <div class="d-grid mb-3">
            <button type="submit" class="btn btn-pink w-100">Daftar Sekarang</button>
        </div>

        <p class="text-center">
            Sudah punya akun? <a href="{{ route('eo.login.form') }}" class="link-pink">Login di sini</a>
        </p>
    </form>
</div>

<script>
    // Reset email autofill agar tidak keisi otomatis
    window.onload = function () {
        document.querySelector('form').reset();
    }
</script>
@endsection
