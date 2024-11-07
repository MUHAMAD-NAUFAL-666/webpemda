<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dokumen Peminjaman</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .navbar {
            padding: 0.5rem 1rem; /* Mengatur padding navbar */
        }

        .navbar-brand img {
            height: 100px; /* Mengurangi tinggi logo */
            width: auto;  /* Lebar otomatis agar proporsional */
            margin-right: 1px; /* Jarak antara logo dan teks */
            padding-top: 20px;
        }

        .navbar-brand span {
            font-size: 20px; /* Mengurangi ukuran font untuk teks */
            line-height: 1; /* Mengatur tinggi garis untuk teks */
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <img src="{{ asset('storage/pemda.png') }}" alt="Logo">
            <span>Bpn Karawang</span>
        </a>
    </nav>

    <div class="container mt-4">
        @yield('content')
    </div>
</body>
</html>
