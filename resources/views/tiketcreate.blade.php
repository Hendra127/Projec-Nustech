@extends('layouts.user_type.auth')

@section('content')

<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h4>Form Tambah Data Tiket</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('tiket.store') }}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                            <label>NAMA SITE</label>
                            <input type="text" name="nama_site" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label>PROVINSI</label>
                            <input type="text" name="provinsi" class="form-control" required>
                        </div>

                        <div class="col-md-6 mt-3">
                            <label>KABUPATEN</label>
                            <input type="text" name="kabupaten" class="form-control" required>
                        </div>

                        <div class="col-md-6 mt-3">
                            <label>DURASI</label>
                            <input type="text" name="durasi" class="form-control">
                        </div>

                        <div class="col-md-6 mt-3">
                            <label>KATEGORI</label>
                            <input type="text" name="kategori" class="form-control">
                        </div>

                        <div class="col-md-6 mt-3">
                            <label>TANGGAL REKAP</label>
                            <input type="date" name="tanggal_rekap" class="form-control">
                        </div>

                        <div class="col-md-6 mt-3">
                            <label>BULAN OPEN</label>
                            <input type="text" name="bulan_open" class="form-control">
                        </div>

                        <div class="col-md-6 mt-3">
                            <label>STATUS TIKET</label>
                            <input type="text" name="status_tiket" class="form-control">
                        </div>

                        <div class="col-md-6 mt-3">
                            <label>KENDALA</label>
                            <input type="text" name="kendala" class="form-control">
                        </div>

                        <div class="col-md-6 mt-3">
                            <label>TANGGAL CLOSE</label>
                            <input type="date" name="tanggal_close" class="form-control">
                        </div>

                        <div class="col-md-6 mt-3">
                            <label>BULAN CLOSE</label>
                            <input type="text" name="bulan_close" class="form-control">
                        </div>

                        <div class="col-md-12 mt-3">
                            <label>DETAIL PROBLEM</label>
                            <textarea name="detail_problem" class="form-control" rows="3"></textarea>
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <a href="{{ route('tiket.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

@endsection
