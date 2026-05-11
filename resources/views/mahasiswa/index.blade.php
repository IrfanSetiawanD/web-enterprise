@extends('master')

@section('konten')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow border-0">
                    <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"><i class="fa fa-user-circle me-2"></i>Data Profil Mahasiswa</h5>
                        @if (session('message'))
                            <span class="badge bg-success">{{ session('message') }}</span>
                        @endif
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-hover">
                            @foreach ($mahasiswa as $m)
                                <tr>
                                    <th width="30%">NIM</th>
                                    <td>: {{ $m->nim }}</td>
                                </tr>
                                <tr>
                                    <th>Nama Lengkap</th>
                                    <td>: {{ $m->nama_mahasiswa }}</td>
                                </tr>
                                <tr>
                                    <th>Jurusan</th>
                                    <td>: {{ $m->jurusan }}</td>
                                </tr>
                                <tr>
                                    <th>Tempat, Tanggal Lahir</th>
                                    <td>: {{ $m->tempat_lahir }},
                                        {{ \Carbon\Carbon::parse($m->tanggal_lahir)->format('d F Y') }}</td>
                                </tr>
                                <tr>
                                    <th>Nomor HP</th>
                                    <td>: {{ $m->no_hp ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Alamat</th>
                                    <td>: {{ $m->alamat ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Status Akun</th>
                                    <td>:
                                        <span class="badge {{ $m->status == 'Active' ? 'bg-success' : 'bg-danger' }}">
                                            {{ $m->status }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Aksi</th>
                                    <td>
                                        {{-- PERBAIKAN DI SINI: Menambahkan $m->id --}}
                                        <a href="{{ route('mahasiswa.edit', $m->id_mahasiswa) }}"
                                            class="btn btn-warning btn-sm">
                                            <i class="fa fa-edit"></i> Perbarui Profil
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
