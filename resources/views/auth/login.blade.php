@extends('layouts.app')

@section('title', 'Masuk EO | HitTix')

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
    <h2 class="text-center fw-bold mb-4">Masuk sebagai EO</h2>

    @if(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('eo.login.submit') }}">
        @csrf

        <div class="mb-3">
            <label for="email">Email</label>
            <input id="email" name="email" type="email" class="form-control" value="{{ old('email') }}" required autofocus>
        </div>

        <div class="mb-3">
            <label for="password">Password</label>
            <input id="password" name="password" type="password" class="form-control" required>
        </div>

        <div class="d-grid mb-3">
            <button type="submit" class="btn btn-pink">Login</button>
        </div>
    </form>

    <p class="text-center mt-3">
        Belum punya akun? <a href="{{ route('eo.register.form') }}" class="link-pink">Daftar di sini</a>
    </p>
</div>

<script>
    window.onload = function () {
        document.querySelector('form').reset();
    }
</script>
@endsection
