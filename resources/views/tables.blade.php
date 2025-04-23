@extends('layouts.user_type.auth')

@section('content')

<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
    <div class="content">
        <div class="card card-info card-outline">
            <div class="card-header">
                <!-- Tombol Tambah, Export, Import -->
                <div class="d-flex flex-wrap mb-3">
                    <div style="margin-right: 20px">
                        <a href="{{ route('datacreate') }}" class="btn btn-primary mr-5 mb-3">Tambah</a>
                        <a href="{{ route('dataexport') }}" class="btn btn-success mr-5 mb-3">Export</a>
                        <a href="#" class="btn btn-info mb-3" data-toggle="modal" data-target="#exampleModalLong">Import</a>
                    </div>
                </div>

                <!-- Form Search -->
                <form action="{{ route('tables') }}" method="GET">
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
                <!-- Tabel dengan scroll horizontal yang selalu aktif -->
                <div class="table-responsive" style="overflow-x: auto; -webkit-overflow-scrolling: touch;">
                    <table class="table table-bordered table-striped" style="min-width: 1000px;"> <!-- Minimum width untuk memaksa scroll muncul -->
                        <thead class="thead-dark">
                            <tr>
                                <th>NO</th>
                                <th>ID SITE</th>
                                <th>SITE NAME</th>
                                <th>TIPE</th>
                                <th>BATCH</th>
                                <th>LATITUDE</th>
                                <th>LONGITUDE</th>
                                <th>PROVINSI</th>
                                <th>KABUPATEN</th>
                                <th>KECAMATAN</th>
                                <th>KELURAHAN</th>
                                <th>ALAMAT</th>
                                <th>NAMA PIC</th>
                                <th>NOMOR PIC</th>
                                <th>SUMBER LISTRIK</th>
                                <th>GATEWAY AREA</th>
                                <th>BEAM</th>
                                <th>HUB</th>
                                <th>KODEFIKASI</th>
                                <th>SN ANTENA</th>
                                <th>SN MODEM</th>
                                <th>SN ROUTER</th>
                                <th>SN AP1</th>
                                <th>SN AP2</th>
                                <th>SN TRANCIEVER</th>
                                <th>SN STABILIZER</th>
                                <th>SN RAK</th>
                                <th>IP MODEM</th>
                                <th>IP ROUTER</th>
                                <th>IP AP1</th>
                                <th>IP AP2</th>
                                <th>EXPECTED SQF</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($site as $index => $item)
                            <tr>
                                <td>{{ $site->firstItem() + $index }}</td>
                                <td>{{ $item->site_id }}</td>
                                <td>{{ $item->sitename }}</td>
                                <td>{{ $item->tipe }}</td>
                                <td>{{ $item->batch }}</td>
                                <td>{{ $item->latitude }}</td>
                                <td>{{ $item->longitude }}</td>
                                <td>{{ $item->provinsi }}</td>
                                <td>{{ $item->kab }}</td>
                                <td>{{ $item->kecamatan }}</td>
                                <td>{{ $item->kelurahan }}</td>
                                <td>{{ $item->alamat_lokasi }}</td>
                                <td>{{ $item->nama_pic }}</td>
                                <td>{{ $item->nomor_pic }}</td>
                                <td>{{ $item->sumber_listrik }}</td>
                                <td>{{ $item->gateway_area }}</td>
                                <td>{{ $item->beam }}</td>
                                <td>{{ $item->hub }}</td>
                                <td>{{ $item->kodefikasi }}</td>
                                <td>{{ $item->sn_antena }}</td>
                                <td>{{ $item->sn_modem }}</td>
                                <td>{{ $item->sn_router }}</td>
                                <td>{{ $item->sn_ap1 }}</td>
                                <td>{{ $item->sn_ap2 }}</td>
                                <td>{{ $item->sn_tranciever }}</td>
                                <td>{{ $item->sn_stabilizer }}</td>
                                <td>{{ $item->sn_rak }}</td>
                                <td>{{ $item->ip_modem }}</td>
                                <td>{{ $item->ip_router }}</td>
                                <td>{{ $item->ip_ap1 }}</td>
                                <td>{{ $item->ip_ap2 }}</td>
                                <td>{{ $item->expected_sqf }}</td>
                                <td>
                                    <a href="/dataupdate/{{ $item->id }}">
                                        <button class="btn btn-primary">Update</button>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Sticky Pagination -->
                <div class="position-sticky bottom-0 end-0 bg-white py-3" style="z-index: 1000;">
                    <div class="d-flex justify-content-end pe-3">
                        {{ $site->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Import -->
    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('dataimport') }}" method="post" enctype="multipart/form-data">
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

</main>
@endsection
