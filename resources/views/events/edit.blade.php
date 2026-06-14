@extends('layouts.app')

@section('title', 'Edit Event')

@section('content')
<div class="container mt-4">
    <h1>Edit Event</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> Ada beberapa masalah dengan inputan Anda:<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nama Event</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $event->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="event_date" class="form-label">Tanggal Event</label>
            <input type="date" class="form-control" id="event_date" name="event_date" value="{{ old('event_date', \Carbon\Carbon::parse($event->event_date)->format('Y-m-d')) }}" required>
        </div>

        <div class="mb-3">
            <label for="venue" class="form-label">Lokasi</label>
            <input type="text" class="form-control" id="venue" name="venue" value="{{ old('venue', $event->venue) }}">
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Harga</label>
            <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ old('price', $event->price) }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="description" name="description" rows="4">{{ old('description', $event->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Gambar Event</label>
            @if ($event->image)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->name }}" style="max-width: 200px;">
                </div>
            @endif
            <input type="file" class="form-control" id="image" name="image" accept="image/*">
            <small class="form-text text-muted">Kosongkan jika tidak ingin mengganti gambar</small>
        </div>

        <button type="submit" class="btn btn-primary">Update Event</button>
    </form>
</div>
@endsection
