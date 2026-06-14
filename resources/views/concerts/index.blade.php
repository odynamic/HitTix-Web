<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Daftar Konser - HitTix</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        html, body {
            height: 100%;
            margin: 0;
        }
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        main {
            flex: 1;
        }
        footer {
            background-color: #212529; /* bg-dark */
            color: #f8f9fa; /* text-light */
            text-align: center;
            padding: 1rem 0;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">HitTix</a>
            <button
              class="navbar-toggler"
              type="button"
              data-bs-toggle="collapse"
              data-bs-target="#navbarNav"
              aria-controls="navbarNav"
              aria-expanded="false"
              aria-label="Toggle navigation"
            >
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#">About</a></li>
                <li class="nav-item"><a class="nav-link active" href="#">Daftar Konser</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
              </ul>
            </div>
        </div>
    </nav>

    <main class="container my-5">
        <h2 class="mb-3">Daftar Konser</h2>
        <p class="lead mb-4">Lihat konser-konser terbaru dan paling seru. Cari konser favoritmu dan pesan tiket sekarang!</p>

        <div class="row row-cols-1 row-cols-md-3 g-4">
            {{-- Contoh data konser --}}
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <img src="https://via.placeholder.com/400x250?text=Concert+1" class="card-img-top" alt="Concert 1" />
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Concert Amazing Band</h5>
                        <p class="card-text mb-1"><strong>Tanggal:</strong> 25 Jun 2025</p>
                        <p class="card-text mb-3"><strong>Lokasi:</strong> Jakarta Convention Center</p>
                        <a href="#" class="btn btn-primary mt-auto">Pesan Tiket</a>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card h-100 shadow-sm">
                    <img src="https://via.placeholder.com/400x250?text=Concert+2" class="card-img-top" alt="Concert 2" />
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Festival Jazz Night</h5>
                        <p class="card-text mb-1"><strong>Tanggal:</strong> 10 Jul 2025</p>
                        <p class="card-text mb-3"><strong>Lokasi:</strong> Bandung Convention Hall</p>
                        <a href="#" class="btn btn-primary mt-auto">Pesan Tiket</a>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card h-100 shadow-sm">
                    <img src="https://via.placeholder.com/400x250?text=Concert+3" class="card-img-top" alt="Concert 3" />
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Pop Music Gala</h5>
                        <p class="card-text mb-1"><strong>Tanggal:</strong> 5 Aug 2025</p>
                        <p class="card-text mb-3"><strong>Lokasi:</strong> Surabaya Grand Theater</p>
                        <a href="#" class="btn btn-primary mt-auto">Pesan Tiket</a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer>
        &copy; 2025 HitTix. All rights reserved.
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
