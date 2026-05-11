@extends('master')

@section('konten')
    <div class="container mt-4">
        <div class="card shadow">
            <div class="card-header bg-warning text-dark fw-bold">
                <i class="fa fa-edit me-2"></i>Edit Profil Mahasiswa
            </div>
            <div class="card-body">
                <form action="{{ route('mahasiswa.update', $mhs->id_mahasiswa) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="fw-bold">NIM
                                {{ Auth::user()->role !== 'Admin' ? '(Tidak dapat diubah)' : '' }}</label>
                            {{-- Admin bisa edit, Mahasiswa readonly --}}
                            <input type="text" name="nim"
                                class="form-control {{ Auth::user()->role !== 'Admin' ? 'bg-light' : '' }}"
                                value="{{ old('nim', $mhs->nim) }}" {{ Auth::user()->role !== 'Admin' ? 'readonly' : '' }}
                                required>
                            @error('nim')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="fw-bold">Nama Mahasiswa</label>
                            <input type="text" name="nama_mahasiswa" class="form-control"
                                value="{{ old('nama_mahasiswa', $mhs->nama_mahasiswa) }}" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="fw-bold">Jurusan</label>
                            <input type="text" name="jurusan" class="form-control"
                                value="{{ old('jurusan', $mhs->jurusan) }}" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="fw-bold">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" class="form-control"
                                value="{{ old('tempat_lahir', $mhs->tempat_lahir) }}">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="fw-bold">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" class="form-control"
                                value="{{ old('tanggal_lahir', $mhs->tanggal_lahir) }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="fw-bold">No. HP</label>
                            <input type="text" name="no_hp" class="form-control"
                                value="{{ old('no_hp', $mhs->no_hp) }}">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="fw-bold">Alamat</label>
                        <textarea name="alamat" class="form-control" rows="3">{{ old('alamat', $mhs->alamat) }}</textarea>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('home') }}" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary px-5 fw-bold">UPDATE DATA</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
