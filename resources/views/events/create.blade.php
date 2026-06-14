@extends('layouts.app')

@section('content')
<style>
    .form-container {
        background-color: #fff0f5;
        padding: 2rem;
        border-radius: 16px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.06);
    }

    .form-title {
        color: #d63384;
        font-weight: bold;
        margin-bottom: 1.5rem;
        text-align: center;
    }

    .form-label {
        font-weight: 500;
        margin-bottom: 0.3rem;
    }

    .form-control, .form-select {
        border-radius: 8px;
        border: 1px solid #ccc;
        font-size: 0.95rem;
    }

    .form-control:focus, .form-select:focus {
        border-color: #d63384;
        box-shadow: 0 0 0 0.15rem rgba(214, 51, 132, 0.25);
    }

    .ticket-row {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
    }

    .ticket-row > * {
        flex: 1;
        min-width: 120px;
    }

    .btn-add {
        background-color: #ff69b4;
        color: white;
        font-weight: 500;
        border: none;
        border-radius: 50px;
        padding: 0.4rem 1rem;
        font-size: 0.85rem;
    }

    .btn-add:hover {
        background-color: #e0559f;
    }

    .btn-primary {
        background-color: #d63384;
        border-radius: 50px;
        padding: 0.5rem 2rem;
        font-weight: 500;
        border: none;
    }

    .btn-primary:hover {
        background-color: #b02a6f;
    }
</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <div class="form-container">
                <h2 class="form-title">Buat Event</h2>

                <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Event</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea name="description" id="description" rows="3" class="form-control" required></textarea>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label for="event_date" class="form-label">Tanggal</label>
                            <input type="date" name="event_date" id="event_date" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="venue" class="form-label">Lokasi</label>
                            <input type="text" name="venue" id="venue" class="form-control" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Banner</label>
                        <input type="file" name="image" id="image" class="form-control">
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Tiket</label>
                        <div id="tickets-container" class="vstack gap-2">
                            <div class="ticket-row">
                                <input type="text" name="tickets[0][name]" class="form-control" placeholder="Ex: VIP" required>
                                <input type="number" name="tickets[0][price]" class="form-control" placeholder="Harga" required>
                                <input type="number" name="tickets[0][quota]" class="form-control" placeholder="Kuota" required>
                            </div>
                        </div>

                        <button type="button" id="add-ticket-btn" class="btn btn-add mt-2">+ Jenis Tiket</button>
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary">Simpan Event</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        let ticketIndex = 1;

        document.getElementById('add-ticket-btn').addEventListener('click', () => {
            const container = document.getElementById('tickets-container');
            const row = document.createElement('div');
            row.className = 'ticket-row';

            row.innerHTML = `
                <input type="text" name="tickets[${ticketIndex}][name]" class="form-control" placeholder="Contoh: Reguler" required>
                <input type="number" name="tickets[${ticketIndex}][price]" class="form-control" placeholder="Harga" required>
                <input type="number" name="tickets[${ticketIndex}][quota]" class="form-control" placeholder="Kuota" required>
                <select name="tickets[${ticketIndex}][status]" class="form-select">
                    <option value="On Sale">On Sale</option>
                    <option value="Sold Out">Sold Out</option>
                </select>
            `;
            container.appendChild(row);
            ticketIndex++;
        });
    });
</script>
@endsection
