@extends('master')

@section('konten')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0 p-3">
                <div class="card-body">
                    <h3 class="mb-4 fw-bold"><i class="fa fa-user-plus me-2 text-primary"></i>Input Mahasiswa Baru</h3>
                    <hr>
                    <form method="post" action="{{ route('mahasiswa.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-semibold">NIM</label>
                                <input type="text" name="nim" class="form-control"
                                    placeholder="Nomor Induk Mahasiswa" required>
                            </div>
                            <div class="col-md-8 mb-3">
                                <label class="form-label fw-semibold">Nama Lengkap</label>
                                <input type="text" name="nama_mahasiswa" class="form-control"
                                    placeholder="Input nama mahasiswa" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" class="form-control" placeholder="Contoh: Jakarta"
                                    required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" class="form-control" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Alamat Domisili</label>
                            <textarea name="alamat" rows="3" class="form-control" placeholder="Tulis alamat lengkap..." required></textarea>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Nomor WhatsApp</label>
                            <input type="text" name="no_hp" class="form-control" placeholder="0812xxxx" required>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('mahasiswa') }}" class="btn btn-light">Batal</a>
                            <button type="submit" class="btn btn-primary px-5 fw-bold">Simpan Data Mahasiswa</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
