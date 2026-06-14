@extends('layouts.eo')

@section('title', 'Edit Profil | Dashboard EO')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 fw-bold">Edit Profil Akun</h2>

    {{-- Notifikasi Sukses --}}
    @if (session('success'))
        <div class="alert alert-success rounded">{{ session('success') }}</div>
    @endif

    {{-- Validasi Error --}}
    @if ($errors->any())
        <div class="alert alert-danger rounded">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form Edit Profil --}}
    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="row g-4">
        @csrf
        @method('PUT')

        {{-- Nama --}}
        <div class="col-md-6">
            <label for="name" class="form-label">Nama Lengkap</label>
            <input type="text" name="name" class="form-control" required
                   value="{{ old('name', Auth::user()->name) }}">
        </div>

        {{-- Username --}}
        <div class="col-md-6">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" class="form-control" required
                   value="{{ old('username', Auth::user()->username) }}">
        </div>

        {{-- Email --}}
        <div class="col-md-6">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required
                   value="{{ old('email', Auth::user()->email) }}">
        </div>

        {{-- No HP --}}
        <div class="col-md-6">
            <label for="phone" class="form-label">No. HP</label>
            <input type="text" name="phone" class="form-control"
                   value="{{ old('phone', Auth::user()->phone) }}">
        </div>

        {{-- Foto Profil --}}
        <div class="col-md-6">
            <label for="profile_photo" class="form-label">Foto Profil</label>
            <input type="file" name="profile_photo" class="form-control">
            @if(Auth::user()->profile_photo)
                <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}"
                     alt="Foto Profil" class="img-thumbnail mt-2" style="max-width: 100px;">
            @endif
        </div>

        <hr class="my-4">

        {{-- Judul Section Password --}}
        <h5 class="fw-bold">Ganti Password (Opsional)</h5>

        {{-- Password Saat Ini --}}
        <div class="col-md-6">
            <label for="current_password" class="form-label">Password Saat Ini</label>
            <input type="password" name="current_password" class="form-control">
        </div>

        {{-- Password Baru --}}
        <div class="col-md-6">
            <label for="new_password" class="form-label">Password Baru</label>
            <input type="password" name="new_password" class="form-control">
        </div>

        {{-- Konfirmasi Password --}}
        <div class="col-md-6">
            <label for="new_password_confirmation" class="form-label">Konfirmasi Password Baru</label>
            <input type="password" name="new_password_confirmation" class="form-control">
        </div>

        {{-- Tombol Simpan --}}
        <div class="col-12 mt-4">
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection
