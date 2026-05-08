@extends('master')

@section('konten')
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="fw-bold text-primary"><i class="fa fa-graduation-cap me-2"></i>Data Mahasiswa</h3>
                <a class="btn btn-primary" href="{{ route('mahasiswa.create') }}">
                    <i class="fa fa-plus me-1"></i> Tambah Mahasiswa
                </a>
            </div>

            @if (session('message'))
                <div class="alert alert-success border-0 shadow-sm">{{ session('message') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover mt-3">
                    <thead class="table-light">
                        <tr>
                            <th>NIM</th>
                            <th>Nama Lengkap</th>
                            <th>Tempat Lahir</th>
                            <th>No. HP</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($mahasiswa as $m)
                            <tr>
                                <td><span class="badge bg-secondary">{{ $m->nim }}</span></td>
                                <td>{{ $m->nama_mahasiswa }}</td>
                                <td>{{ $m->tempat_lahir }}</td>
                                <td>{{ $m->no_hp }}</td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-info text-white"><i class="fa fa-edit"></i></button>
                                    <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">Belum ada data mahasiswa.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
