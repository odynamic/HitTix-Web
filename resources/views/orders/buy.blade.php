@extends('layouts.app')

@section('content')
<div class="container mx-auto max-w-lg p-6 bg-dark rounded shadow-lg text-light">
    <h1 class="text-3xl font-semibold mb-5 text-center">Form Pemesanan Tiket</h1>

    <form action="{{ route('order.store', $event->id) }}" method="POST" class="needs-validation" novalidate>
        @csrf

        {{-- Data Pemesan --}}
        <fieldset class="mb-4">
            <legend class="h5 mb-3">Data Pemesan</legend>

            @foreach ([
                'nama_pemesan' => 'Nama Lengkap',
                'email_pemesan' => 'Email',
                'jenis_identitas_pemesan' => 'Jenis Identitas',
                'nomor_identitas_pemesan' => 'Nomor Identitas',
                'wa_pemesan' => 'Nomor WhatsApp'
            ] as $field => $label)
                <div class="mb-3">
                    <label class="form-label">{{ $label }} Pemesan</label>
                    @if(Str::contains($field, 'jenis_identitas'))
                        <select name="{{ $field }}" id="{{ $field }}" class="form-select" required>
                            <option value="" disabled selected>Pilih Jenis Identitas</option>
                            <option value="KTP">KTP</option>
                            <option value="SIM">SIM</option>
                        </select>
                    @else
                        <input type="{{ Str::contains($field, 'email') ? 'email' : 'text' }}"
                               name="{{ $field }}"
                               id="{{ $field }}"
                               class="form-control"
                               required
                               placeholder="{{ $label }} Pemesan">
                    @endif
                    <div class="invalid-feedback">{{ $label }} pemesan wajib diisi.</div>
                </div>
            @endforeach
        </fieldset>

        {{-- Data Pemilik Tiket --}}
        <fieldset class="mb-4">
            <legend class="h5 mb-3 d-flex justify-content-between">
                Data Pemilik Tiket
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="copyData">
                    <label class="form-check-label" for="copyData">Samakan dengan pemesan</label>
                </div>
            </legend>

            @foreach ([
                'nama_pemilik' => 'Nama Lengkap',
                'jenis_identitas_pemilik' => 'Jenis Identitas',
                'nomor_identitas_pemilik' => 'Nomor Identitas',
                'wa_pemilik' => 'Nomor WhatsApp'
            ] as $field => $label)
                <div class="mb-3">
                    <label class="form-label">{{ $label }} Pemilik Tiket</label>
                    @if(Str::contains($field, 'jenis_identitas'))
                        <select name="{{ $field }}" id="{{ $field }}" class="form-select" required>
                            <option value="" disabled selected>Pilih Jenis Identitas</option>
                            <option value="KTP">KTP</option>
                            <option value="SIM">SIM</option>
                        </select>
                    @else
                        <input type="text" name="{{ $field }}" id="{{ $field }}"
                               class="form-control" required
                               placeholder="{{ $label }} Pemilik Tiket">
                    @endif
                    <div class="invalid-feedback">{{ $label }} pemilik tiket wajib diisi.</div>
                </div>
            @endforeach
        </fieldset>

        {{-- Detail Tiket --}}
        <fieldset class="mb-4">
            <legend class="h5 mb-3">Detail Event & Tiket</legend>

            <div class="mb-3">
                <label class="form-label">Tanggal Event</label>
                <input type="text" value="{{ \Carbon\Carbon::parse($event->tanggal)->translatedFormat('d F Y') }}"
                       class="form-control bg-secondary text-light" readonly>
            </div>

            <div class="mb-3">
                <label class="form-label">Pilih Jenis Tiket</label>
                @foreach ($tickets as $ticket)
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="ticket_type_id"
                            id="ticket_{{ $ticket->id }}"
                            value="{{ $ticket->id }}"
                            required
                            data-ticket='@json(["nama" => $ticket->nama, "harga" => $ticket->harga, "people" => $ticket->people_per_package])'
                            onchange="updateTicketDetails(this)">
                        <label class="form-check-label" for="ticket_{{ $ticket->id }}">
                            {{ $ticket->nama }} - Rp {{ number_format($ticket->harga, 0, ',', '.') }} / {{ $ticket->people_per_package }} orang
                        </label>
                    </div>
                @endforeach
                <div class="invalid-feedback">Pilih salah satu jenis tiket.</div>
            </div>

            <div class="mb-3">
                <label for="jumlah_paket" class="form-label">Jumlah Paket</label>
                <input type="number" name="jumlah_paket" id="jumlah_paket" min="1" class="form-control" required>
                <div class="invalid-feedback">Masukkan jumlah paket yang valid.</div>
            </div>

            <div class="mb-3">
                <label class="form-label">Total Orang</label>
                <input type="text" id="total_orang" class="form-control bg-secondary text-light" readonly>
            </div>

            <div class="mb-3">
                <label class="form-label">Total Harga</label>
                <input type="text" id="total_harga" class="form-control bg-secondary text-light" readonly>
            </div>

            <input type="hidden" name="total_amount" id="total_amount">

            <div class="mb-4">
                <label class="form-label">Kode Voucher (Opsional)</label>
                <input type="text" name="voucher" class="form-control" placeholder="Masukkan kode voucher">
            </div>
        </fieldset>

        <button type="submit" class="btn btn-primary w-100 py-3 fw-semibold fs-5">
            Lanjutkan Pembayaran
        </button>
    </form>
</div>

<script>
    let selectedTicket = null;

    function updateTicketDetails(radio) {
        const data = JSON.parse(radio.dataset.ticket);
        selectedTicket = data;
        updateTotal();
    }

    document.getElementById('jumlah_paket').addEventListener('input', updateTotal);

    function updateTotal() {
        const jumlah = parseInt(document.getElementById('jumlah_paket').value) || 0;

        if (selectedTicket) {
            const totalOrang = jumlah * selectedTicket.people;
            const totalHarga = jumlah * selectedTicket.harga;

            document.getElementById('total_orang').value = totalOrang + ' orang';
            document.getElementById('total_harga').value = 'Rp ' + totalHarga.toLocaleString('id-ID');
            document.getElementById('total_amount').value = totalHarga;
        }
    }

    // Copy data pemesan ke pemilik tiket
    document.getElementById('copyData').addEventListener('change', function () {
        const fields = ['nama', 'jenis_identitas', 'nomor_identitas', 'wa'];
        fields.forEach(field => {
            const pemesan = document.getElementById(`${field}_pemesan`);
            const pemilik = document.getElementById(`${field}_pemilik`);
            if (this.checked) {
                pemilik.value = pemesan.value;
            } else {
                pemilik.value = '';
            }
        });
    });

    // Bootstrap validation
    (() => {
        'use strict'
        const forms = document.querySelectorAll('.needs-validation')
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false)
        })
    })();
</script>
@endsection
