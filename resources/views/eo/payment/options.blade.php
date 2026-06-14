{{-- resources/views/eo/payment/options.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-xl font-bold">Pilih Paket Publikasi</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="p-4 border rounded-xl shadow">
            <h3 class="text-lg font-semibold">Basic</h3>
            <p class="mt-2">Publikasi event selama 7 hari.</p>
            <p class="font-bold mt-2">Rp 25.000</p>
            <form action="{{ route('eo.payment.checkout', $event->id) }}" method="POST">
                @csrf
                <input type="hidden" name="package" value="basic">
                <button class="mt-3 px-4 py-2 bg-blue-600 text-white rounded">Pilih Paket</button>
            </form>
        </div>

        <div class="p-4 border rounded-xl shadow">
            <h3 class="text-lg font-semibold">Pro</h3>
            <p class="mt-2">Publikasi event selama 30 hari + featured.</p>
            <p class="font-bold mt-2">Rp 75.000</p>
            <form action="{{ route('eo.payment.checkout', $event->id) }}" method="POST">
                @csrf
                <input type="hidden" name="package" value="pro">
                <button class="mt-3 px-4 py-2 bg-blue-600 text-white rounded">Pilih Paket</button>
            </form>
        </div>
    </div>
</div>
@endsection