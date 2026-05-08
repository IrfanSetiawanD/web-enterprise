<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register - Sistem Informasi Mahasiswa</title>
    <!-- Bootstrap 5.3 & FontAwesome 6 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Inter', sans-serif;
        }

        .register-container {
            margin-top: 50px;
            margin-bottom: 50px;
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
            padding: 10px 12px;
            border-radius: 8px;
        }

        .form-label {
            font-weight: 600;
            font-size: 0.9rem;
            color: #495057;
        }
    </style>
</head>

<body>
    <div class="container register-container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card p-4">
                    <div class="card-body">
                        <h3 class="text-center mb-2"><b>DAFTAR AKUN</b></h3>
                        <p class="text-muted text-center mb-4">Sistem Informasi Mahasiswa (SIMA)</p>
                        <hr>

                        @if (session('message'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fa fa-check-circle me-2"></i> {{ session('message') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        <form action="{{ route('actionregister') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label"><i class="fa fa-envelope me-1"></i> Email</label>
                                <input type="email" name="email" class="form-control"
                                    placeholder="nama@perusahaan.com" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label"><i class="fa fa-user me-1"></i> Username</label>
                                <input type="text" name="username" class="form-control" placeholder="Username Anda"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label"><i class="fa fa-key me-1"></i> Password</label>
                                <input type="password" name="password" class="form-control"
                                    placeholder="Minimal 6 karakter" required>
                            </div>

                            <div class="mb-4">
                                <label class="form-label"><i class="fa fa-id-badge me-1"></i> Role</label>
                                <input type="text" name="role" class="form-control bg-light" value="Guest"
                                    readonly>
                                <div class="form-text text-info">Role otomatis diatur sebagai Guest untuk pendaftar
                                    baru.</div>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fa fa-user-plus me-1"></i> Buat Akun Sekarang
                            </button>
                        </form>

                        <hr class="my-4">
                        <p class="text-center mb-0">Sudah punya akun? <a href="{{ route('login') }}"
                                class="text-decoration-none fw-semibold">Login Disini!</a></p>
                    </div>
                </div>
                <p class="text-center text-muted mt-4" style="font-size: 0.8rem;">&copy; 2026 SIMA Enterprise Edition
                </p>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
