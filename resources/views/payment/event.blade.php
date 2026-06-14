@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="mb-4 text-center text-pink">Formulir Pembelian Tiket</h2>
            <form action="{{ route('event.payment.process') }}" method="POST">
                @csrf
                <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                <input type="hidden" name="event_id" value="{{ $event->id }}">
                <input type="hidden" name="price" value="{{ $ticket->price }}">

                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">NIK / No. Identitas</label>
                    <input type="text" name="identity" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">No WhatsApp</label>
                    <input type="text" name="phone" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Jumlah Tiket</label>
                    <input type="number" name="quantity" min="1" max="{{ $ticket->quota }}" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-pink w-100">Lanjut Pembayaran</button>
            </form>
        </div>
    </div>
</div>
@endsection
