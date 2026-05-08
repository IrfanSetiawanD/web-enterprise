<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login - Sistem Informasi Mahasiswa</title>
    <!-- Menggunakan Bootstrap 5.3 untuk UI yang lebih clean -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Inter', sans-serif;
        }

        .login-container {
            margin-top: 100px;
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
        }

        .btn-primary {
            background-color: #0d6efd;
            border: none;
            padding: 12px;
            border-radius: 8px;
            font-weight: 600;
        }

        .form-control {
            padding: 12px;
            border-radius: 8px;
        }
    </style>
</head>

<body>
    <div class="container login-container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card p-4">
                    <div class="card-body">
                        <h2 class="text-center mb-2"><b>SIMA</b></h2>
                        <p class="text-muted text-center mb-4">Sistem Informasi Mahasiswa</p>
                        <hr>

                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <b>Opps!</b> {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        <form action="{{ route('actionlogin') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Alamat Email</label>
                                <input type="email" name="email" class="form-control"
                                    placeholder="nama@perusahaan.com" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="••••••••"
                                    required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Masuk ke Sistem</button>
                        </form>

                        <div class="mt-4 text-center">
                            <p class="mb-0 text-muted">Belum punya akun? <a href="{{ route('register') }}"
                                    class="text-decoration-none">Daftar Sekarang</a></p>
                        </div>
                    </div>
                </div>
                <p class="text-center text-muted mt-4" style="font-size: 0.8rem;">&copy; 2026 Web Enterprise Inc.</p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
