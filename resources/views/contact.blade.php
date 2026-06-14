{{-- resources/views/contact.blade.php --}}
@extends('layouts.app')

@section('title', 'Hubungi Kami | HitTix')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="fw-bold text-danger" style="font-size: 2.5rem;">Pojok HitTix</h1>
        <p class="text-muted mx-auto" style="max-width: 700px;">
            Ada pertanyaan, masukan, atau kendala? Tim HitTix siap membantumu. Jangan ragu untuk menghubungi kami melalui formulir di bawah ini.
        </p>
    </div>

    <div class="row g-4">
        <!-- Kontak Informasi -->
        <div class="col-md-5">
            <div class="bg-white shadow-sm rounded p-4 h-100">
                <h5 class="text-danger fw-bold mb-3">Info Kontak</h5>
                <ul class="list-unstyled text-muted">
                    <li class="mb-2"><i class="bi bi-geo-alt-fill me-2 text-danger"></i>Blater, Purbalingga, Jawa Tengah</li>
                    <li class="mb-2"><i class="bi bi-telephone-fill me-2 text-danger"></i>+62 812 3456 7890</li>
                    <li class="mb-2"><i class="bi bi-envelope-fill me-2 text-danger"></i>pojok@hittix.com</li>
                    <li><i class="bi bi-clock-fill me-2 text-danger"></i>Senin - Jumat, 07.30 - 17.00 WIB</li>
                </ul>
            </div>
        </div>

        <!-- Form Kontak -->
        <div class="col-md-7">
            <div class="bg-white shadow-sm rounded p-4">
                <form>
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="name" placeholder="Masukkan nama kamu" required />
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Masukkan email aktif kamu" required />
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Pesan</label>
                        <textarea class="form-control" id="message" rows="4" placeholder="Tulis pesan kamu di sini..." required></textarea>
                    </div>
                    <button type="submit" class="btn btn-danger px-4">Kirim Pesan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
