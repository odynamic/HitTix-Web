@extends('layouts.eo')

@section('title', 'Dashboard EO')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 fw-bold">Beranda Dashboard</h2>

    {{-- Ringkasan Statistik --}}
    <div class="row g-4 mb-5">
        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5 class="card-title text-muted">Jumlah Event</h5>
                    <h3 class="fw-bold">{{ $totalEvents }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5 class="card-title text-muted">Tiket Terjual</h5>
                    <h3 class="fw-bold">{{ $totalTickets }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5 class="card-title text-muted">Total Penghasilan</h5>
                    <h3 class="fw-bold">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5 class="card-title text-muted">Event Mendatang</h5>
                    <h3 class="fw-bold">{{ $upcomingEvents }}</h3>
                </div>
            </div>
        </div>
    </div>

    {{-- Daftar Event --}}
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h5 class="fw-bold mb-3">Daftar Event & Tiket Terjual</h5>
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            @if($eventData->count())
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Nama Event</th>
                        <th>Tanggal</th>
                        <th>Paket</th>
                        <th>Status</th>
                        <th>Tiket Terjual</th>
                        <th>Total Pendapatan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($events as $event)
                        <tr>
                            <td>{{ $event->name }}</td>
                            <td>{{ \Carbon\Carbon::parse($event->event_date)->format('d M Y') }}</td>
                            <td>{{ $event->package_type ?? '-' }}</td>
                            <td>
                                @if ($event->status === 'draft')
                                    <span class="badge bg-warning">Draft</span><br>
                                    <form action="{{ route('events.publish', $event->id) }}" method="POST" class="d-inline mt-2">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success mt-1">Publikasikan</button>
                                    </form>
                                @elseif ($event->status === 'published')
                                    <span class="badge bg-success">Live</span>
                                @else
                                    <span class="badge bg-secondary">{{ ucfirst($event->status ?? '-') }}</span>
                                @endif
                            </td>
                            <td>{{ $eventData->where('name', $event->name)->first()->tickets_sold ?? 0 }}</td>
                            <td>Rp {{ number_format($eventData->where('name', $event->name)->first()->revenue ?? 0, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @else
                <p class="text-muted">Belum ada event.</p>
            @endif
        </div>
    </div>

    {{-- Grafik Penjualan --}}
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="fw-bold mb-3">Grafik Penjualan Tiket per Event</h5>
            <canvas id="ticketChart"></canvas>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('ticketChart').getContext('2d');
    const ticketChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($chartLabels),
            datasets: [{
                label: 'Tiket Terjual',
                data: @json($chartData),
                backgroundColor: [
                    '#0d6efd', '#198754', '#dc3545', '#ffc107', '#6f42c1',
                    '#fd7e14', '#20c997', '#6610f2', '#0dcaf0', '#198754'
                ],
                borderRadius: 6
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection
