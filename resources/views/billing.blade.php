@extends('layouts.user_type.auth')

@section('content')
<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
    <div class="content">
        <div class="card card-info card-outline">
            <div class="card-header">
                <!-- Tombol Tambah, Export, Import -->
                <div class="d-flex flex-wrap mb-3">
                    <div style="margin-right: 20px">
                        <a href="#" class="btn btn-primary mr-3 mb-3" data-toggle="modal" data-target="#modalTambahTiket">Tambah Data</a>
                        <a href="{{ route('tiketexport') }}" class="btn btn-success mr-3 mb-3">Export</a>
                        <a href="#" class="btn btn-info mb-3" data-toggle="modal" data-target="#exampleModalLong">Import</a>
                    </div>
                </div>

                <!-- Form Search -->
                <form action="{{ route('billing') }}" method="GET">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" name="query" class="form-control" placeholder="Search by Site Name or Province" value="{{ request()->query('query') }}">
                        </div>
                        <div class="col-md-6 text-right">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="card-body">
                <!-- Tabel dengan scroll horizontal -->
                <div class="table-responsive" style="overflow-x: auto; -webkit-overflow-scrolling: touch;">
                    <table class="table table-bordered table-striped" style="min-width: 1000px;">
                        <thead class="thead-dark">
                            <tr>
                                <th>No</th>
                                <th>NAMA SITE</th>
                                <th>PROVINSI</th>
                                <th>KABUPATEN</th>
                                <th>DURASI</th>
                                <th>KATEGORI</th>
                                <th>TANGGAL REKAP</th>
                                <th>BULAN OPEN</th>
                                <th>STATUS TIKET</th>
                                <th>KENDALA</th>
                                <th>TANGGAL CLOSE</th>
                                <th>BULAN CLOSE</th>
                                <th>DETAIL PROBLEM</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tiket as $index => $item)
                            <tr>
                                <td>{{ $tiket->firstItem() + $index }}</td>
                                <td>{{ $item->nama_site }}</td>
                                <td>{{ $item->provinsi }}</td>
                                <td>{{ $item->kabupaten }}</td>
                                <td>{{ $item->durasi }}</td>
                                <td>{{ $item->kategori }}</td>
                                <td>{{ $item->tanggal_rekap }}</td>
                                <td>{{ $item->bulan_open }}</td>
                                <td>
                                    <form action="{{ route('tiket.updateStatus', $item->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <select name="status_tiket" class="form-control form-control-sm" onchange="this.form.submit()">
                                            <option value="OPEN" {{ $item->status_tiket === 'OPEN' ? 'selected' : '' }}>OPEN</option>
                                            <option value="CLOSE" {{ $item->status_tiket === 'CLOSE' ? 'selected' : '' }}>CLOSE</option>
                                        </select>
                                    </form>
                                </td>
                                <td>{{ $item->kendala }}</td>
                                <td>{{ $item->tanggal_close }}</td>
                                <td>{{ $item->bulan_close }}</td>
                                <td>{{ $item->detail_problem }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Sticky Pagination -->
                <div class="position-sticky bottom-0 end-0 bg-white py-3" style="z-index: 1000;">
                    <div class="d-flex justify-content-end pe-3">
                        {{ $tiket->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Import -->
    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('tiketimport') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Import Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="file">Pilih File Excel:</label>
                            <input type="file" name="file" class="form-control-file" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Import</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Data Tiket -->
    <div class="modal fade" id="modalTambahTiket" tabindex="-1" role="dialog" aria-labelledby="modalTambahTiketLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form action="{{ route('tiket.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTambahTiketLabel">Tambah Data Tiket</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body row">
                        <div class="form-group col-md-6">
                            <label>Nama Site</label>
                            <input type="text" name="nama_site" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Provinsi</label>
                            <input type="text" name="provinsi" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Kabupaten</label>
                            <input type="text" name="kabupaten" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Durasi</label>
                            <input type="text" name="durasi" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Kategori</label>
                            <input type="text" name="kategori" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Tanggal Rekap</label>
                            <input type="date" name="tanggal_rekap" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Bulan Open</label>
                            <input type="text" name="bulan_open" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Status Tiket</label>
                            <input type="text" name="status_tiket" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Kendala</label>
                            <input type="text" name="kendala" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Tanggal Close</label>
                            <input type="date" name="tanggal_close" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Bulan Close</label>
                            <input type="text" name="bulan_close" class="form-control">
                        </div>
                        <div class="form-group col-md-12">
                            <label>Detail Problem</label>
                            <textarea name="detail_problem" class="form-control" rows="2"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection
