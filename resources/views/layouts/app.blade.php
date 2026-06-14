<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'HitTix')</title>

    <!-- Fonts & CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/style.css') }}" rel="stylesheet">

    <style>
        html, body {
            height: 100%;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background-color: #FFFDF8;
            color: #4a4a4a;
            display: flex;
            flex-direction: column;
        }

        .main-wrapper {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        main {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .navbar {
            background-color: #C2185B !important;
        }

        .navbar .nav-link,
        .navbar .navbar-brand {
            color: #fff !important;
            font-weight: 500;
        }

        .navbar .nav-link:hover {
            color: #FFDDE2 !important;
        }

        .btn-primary-custom {
            background-color: #C2185B;
            border: none;
            color: #fff;
        }

        .btn-primary-custom:hover {
            background-color: #AD1457;
        }

        .hero-section {
            background: linear-gradient(135deg, #C2185B 20%, #F8BBD0 100%);
            min-height: 70vh;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 20px;
            color: white;
            text-align: center;
            padding: 4rem 1rem;
            width: 100%;
        }

        .hero-content {
            max-width: 1100px;
            margin: 0 auto;
            padding: 1rem;
        }

        footer {
            background-color: #C2185B;
            padding: 1rem 0;
            text-align: center;
            font-size: 0.9rem;
            color: #FFFDF8;
        }

        .section-light {
            background-color: #FFFDF8;
            padding: 2.5rem 0;
        }

        .step-icon {
            font-size: 3rem;
            color: #AD1457;
        }

        .step-title {
            font-weight: 600;
            margin-top: 1rem;
            font-size: 1.2rem;
        }

        .step-desc {
            font-size: 0.95rem;
            color: #6c757d;
        }

        .hero-section h1 {
            font-size: 3rem;
            font-weight: 700;
        }

        .hero-section p {
            font-size: 1.2rem;
        }

        .btn-danger {
            background-color: #f06292;
            border-color: #f06292;
        }
        .btn-outline-danger {
            color: #f06292;
            border-color: #f06292;
        }
        .btn-outline-danger:hover {
            background-color: #f06292;
            color: #fff;
        }

        a.btn:hover {
            background-color: white !important;
            color: #c2185b !important;
            border: 1px solid #c2185b !important;
        }

        .card {
        height: 100%;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}

        .card-body {
        flex: 1;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
        }

        .card-title {
        font-size: 16px;
        font-weight: 600;
        }

        .card .btn-primary-custom {
        background-color: #3b49df;
        color: white;
        font-weight: 600;
        border-radius: 8px;
        }

        .btn-outline-light:hover {
            background-color: #ffffff22;
            color: #fff;
            border-color: #fff;
            transition: background-color 0.2s ease-in-out, color 0.2s ease-in-out;
        }

        .form-label {
    font-weight: 600;
    color: #333;
}

input.form-control,
select.form-control,
textarea.form-control {
    border-radius: 10px;
    padding: 0.6rem 0.75rem;
    font-size: 0.95rem;
    border-color: #e0e0e0;
}

input.form-control:focus {
    border-color: #C2185B;
    box-shadow: 0 0 0 0.1rem rgba(194, 24, 91, 0.25);
}

.card:hover {
    transform: translateY(-5px);
    transition: all 0.2s ease-in-out;
}

.form-control:focus {
    border-color: #f06292;
    box-shadow: 0 0 0 0.2rem rgba(240, 98, 146, 0.25);
}


    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ url('/') }}">HitTix</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-center gap-3">
                    <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/jelajah') }}">Jelajah</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/tentang-kami') }}">Tentang Kami</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/hubungi-kami') }}">Hubungi Kami</a></li>
                    @auth
                        <li class="nav-item">
                            <a href="{{ route('events.create') }}" class="btn btn-light border-0 shadow-sm px-2 py-1 rounded-2 d-flex align-items-center gap-2" style="background-color: #ff85a2; color: white;">
                                <i class="bi bi-plus-circle-fill"></i>
                                Tambah Event
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <button class="btn btn-outline-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Hi, {{ Auth::user()->name }}!
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="{{ route('dashboard.eo') }}">Dashboard</a>
                                </li>
                                <li>
                                    <form method="POST" action="{{ route('eo.logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a href="{{ route('gabung.eo') }}" class="btn btn-outline-light btn-sm">Gabung Jadi EO</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <main class="container py-4">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer>
        &copy; {{ date('Y') }} HitTix. All rights reserved.
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
