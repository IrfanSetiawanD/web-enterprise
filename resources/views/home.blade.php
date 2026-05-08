@extends('master')

@section('konten')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <h3>Selamat Datang, <b>{{ Auth::user()->name }}</b></h3>
                <p>Anda login sebagai: <span class="badge bg-info text-dark">{{ Auth::user()->role }}</span></p>
                <hr>

                {{-- BAGIAN KHUSUS ADMIN --}}
                @if (Auth::user()->role == 'Admin')
                    {{-- 1. Form Input Data --}}
                    <div class="card mb-4 shadow-sm border-primary">
                        <div class="card-header bg-primary text-white fw-bold">
                            <i class="fa fa-plus-circle me-2"></i>Tambah Data Mahasiswa (Wajib: Nama, NIM, Jurusan)
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
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">No. HP</label>
                                        <input type="text" name="no_hp" class="form-control" placeholder="0812...">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Alamat</label>
                                        <textarea name="alamat" class="form-control" rows="1" placeholder="Alamat lengkap..."></textarea>
                                    </div>
                                    <div class="col-md-4 mb-3 d-flex align-items-end">
                                        <button type="submit" class="btn btn-success w-100 fw-bold">
                                            <i class="fa fa-save me-2"></i>SIMPAN DATA KE DATABASE
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    {{-- 2. Tabel Tampil Data --}}
                    <div class="card shadow-sm">
                        <div class="card-header bg-dark text-white fw-bold">
                            <i class="fa fa-table me-2"></i>Daftar Mahasiswa Terdaftar
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th width="50">No</th>
                                        <th>NIM</th>
                                        <th>Nama Mahasiswa</th>
                                        <th>Jurusan</th> {{-- Penyesuaian: Tambah Kolom --}}
                                        <th>No. HP</th>
                                        <th>Alamat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no = 1; @endphp
                                    @foreach ($mahasiswa as $m)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td><b>{{ $m->nim }}</b></td>
                                            <td>{{ $m->nama_mahasiswa }}</td>
                                            <td><span class="badge bg-secondary">{{ $m->jurusan }}</span></td>
                                            <td>{{ $m->no_hp }}</td>
                                            <td>{{ $m->alamat }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- BAGIAN JIKA BUKAN ADMIN --}}
                @else
                    <div class="alert alert-warning border-warning shadow-sm">
                        <i class="fa fa-exclamation-triangle me-2"></i>
                        Halo <b>{{ Auth::user()->name }}</b>, menu pengelolaan data mahasiswa hanya dapat diakses oleh
                        <b>Administrator</b>.
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection
