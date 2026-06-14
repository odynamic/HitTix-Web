@extends('layouts.app')

@section('title', 'Daftar Event Saya')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 fw-bold">Daftar Event Saya</h2>

    <a href="{{ route('events.create') }}" class="btn btn-primary-custom mb-4">
        <i class="bi bi-plus-circle"></i> Buat Event Baru
    </a>

    @if($events->isEmpty())
        <div class="alert alert-warning text-center">
            Belum ada event yang kamu buat.
        </div>
    @else
        <div class="row g-4">
            @foreach($events as $event)
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-sm">
                        <div class="card-body d-flex flex-column">
                            <div>
                                <h5 class="card-title">{{ $event->name }}</h5>
                                <p class="text-muted small mb-0">ID: {{ $event->id }}</p>
                            </div>

                            <div class="mt-3 d-flex justify-content-between align-items-center">
                                <a href="{{ route('events.edit', $event->id) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>

                                <form action="{{ route('events.destroy', $event->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus event ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
