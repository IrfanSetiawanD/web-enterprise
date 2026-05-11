@extends('master')

@section('konten')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <h3>Dashboard Admin, <b>{{ Auth::user()->name }}</b></h3>
                <p>Status Panel: <span class="badge bg-primary">Administrator System</span></p>
                <hr>

                @if (Auth::user()->role == 'Admin')
                    {{-- 1. Form Input Data --}}
                    <div class="card mb-4 shadow-sm border-primary">
                        <div class="card-header bg-primary text-white fw-bold">
                            <i class="fa fa-plus-circle me-2"></i>Tambah Data Mahasiswa Baru
                        </div>
                        <div class="card-body">
                            @if (session('message'))
                                <div class="alert alert-success">{{ session('message') }}</div>
                            @endif

                            <form action="{{ route('mahasiswa.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label fw-bold">NIM</label>
                                        <input type="text" name="nim" class="form-control" placeholder="41521..."
                                            required>
                                    </div>
                                    <div class="col-md-5 mb-3">
                                        <label class="form-label fw-bold">Nama Mahasiswa</label>
                                        <input type="text" name="nama_mahasiswa" class="form-control"
                                            placeholder="Nama Lengkap" required>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label fw-bold">Jurusan</label>
                                        <input type="text" name="jurusan" class="form-control"
                                            placeholder="Teknik Informatika" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Tempat Lahir</label>
                                        <input type="text" name="tempat_lahir" class="form-control" placeholder="Jakarta"
                                            required>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Tanggal Lahir</label>
                                        <input type="date" name="tanggal_lahir" class="form-control" required>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">No. HP</label>
                                        <input type="text" name="no_hp" class="form-control" placeholder="0812...">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Alamat</label>
                                        <textarea name="alamat" class="form-control" rows="1" placeholder="Alamat..."></textarea>
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-success w-100 fw-bold">
                                            <i class="fa fa-save me-2"></i>DAFTARKAN MAHASISWA
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    {{-- 2. Tabel Semua Data Mahasiswa --}}
                    <div class="card shadow-sm">
                        <div class="card-header bg-dark text-white fw-bold">
                            <i class="fa fa-users me-2"></i>Master Data Mahasiswa
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover text-center">
                                    <thead class="table-light">
                                        <tr>
                                            <th>No</th>
                                            <th>NIM</th>
                                            <th>Nama Mahasiswa</th>
                                            <th>Jurusan</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($mahasiswa as $m)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td><b>{{ $m->nim }}</b></td>
                                                <td>{{ $m->nama_mahasiswa }}</td>
                                                <td>{{ $m->jurusan }}</td>
                                                <td>
                                                    <span
                                                        class="badge {{ $m->status == 'Active' ? 'bg-success' : 'bg-danger' }}">
                                                        {{ $m->status }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <a href="{{ route('mahasiswa.edit', $m->id_mahasiswa) }}"
                                                        class="btn btn-sm btn-warning">
                                                        <i class="fa fa-edit"></i> Edit
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @else
                    {{-- Tampilan jika Mahasiswa nyasar ke halaman Home --}}
                    <div class="alert alert-warning border-warning shadow-sm py-4">
                        <h4 class="alert-heading"><i class="fa fa-lock me-2"></i>Akses Terbatas</h4>
                        <p>Halaman ini hanya untuk Administrator. Silakan buka menu <b>Data Profil</b> untuk melihat
                            informasi Anda.</p>
                        <hr>
                        <a href="{{ route('mahasiswa.index') }}" class="btn btn-warning">Buka Profil Saya</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
