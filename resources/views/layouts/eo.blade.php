<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard EO - HitTix')</title>

    {{-- Bootstrap + Icon --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f9f9f9;
        }

        .sidebar {
            height: 100vh;
            background-color: #C2185B;
            padding: 2rem 1rem;
            color: #fff;
            position: fixed;
            top: 0;
            left: 0;
            width: 240px;
        }

        .sidebar h4 {
            margin-bottom: 1.5rem;
        }

        .sidebar a {
            color: #fff;
            text-decoration: none;
            display: block;
            margin-bottom: 1rem;
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            transition: background 0.3s;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background-color: #ad1457;
            color: #fff;
        }

        .main-content {
            margin-left: 240px;
            padding: 2rem;
        }

        .logout-btn {
            background-color: #fff;
            color: #C2185B;
            border: none;
            width: 100%;
            margin-top: 2rem;
        }

        .logout-btn:hover {
            background-color: #ffcdd2;
        }
    </style>
</head>
<body>
    {{-- Layout --}}
    <div class="sidebar">
        <h4 class="fw-bold">HitTix EO</h4>
        <hr style="border-color: #fff;">

        <a href="{{ route('dashboard.eo') }}" class="{{ request()->routeIs('dashboard.eo') ? 'active' : '' }}">
            <i class="bi bi-house-door"></i> Beranda Dashboard
        </a>
        <a href="{{ route('events.index') }}" class="{{ request()->routeIs('events.index') ? 'active' : '' }}">
            <i class="bi bi-calendar-event"></i> Daftar Event
        </a>
        <a href="{{ route('events.create') }}" class="{{ request()->routeIs('events.create') ? 'active' : '' }}">
            <i class="bi bi-plus-circle"></i> Tambah Event
        </a>
        <a href="{{ route('dashboard.eo.tickets') }}" class="{{ request()->routeIs('dashboard.eo.tickets') ? 'active' : '' }}">
            <i class="bi bi-ticket-perforated"></i> Tiket Terjual
        </a>
        <a href="{{ route('dashboard.eo.payments') }}" class="{{ request()->routeIs('dashboard.eo.payments') ? 'active' : '' }}">
            <i class="bi bi-credit-card"></i> Pembayaran
        </a>
        <a href="{{ route('profile.edit') }}" class="{{ request()->routeIs('profile.edit') ? 'active' : '' }}">
            <i class="bi bi-person-circle"></i> Profil Akun
        </a>

        <form action="{{ route('eo.logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn logout-btn">
                <i class="bi bi-box-arrow-right"></i> Logout
            </button>
        </form>
    </div>

    <div class="main-content">
        @yield('content')
    </div>

    {{-- Scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
