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
                                    <a href="#" class="btn btn-info mr-3 mb-3" data-toggle="modal" onclick="openEditModal({{ $item->id }})">Detail</a>
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
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
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
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Import</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalDetailDataSite" tabindex="-1" role="dialog" aria-labelledby="modalDetailDataSiteLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form id="tiketForm" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalDetailDataSiteLabel">Detail Site</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body row">
                        <div id="formMethod"></div>
                        <div class="form-group col-md-6">
                            <label>ID Site</label>
                            <input type="text" name="id_site" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Site Name</label>
                            <input type="text" name="sitename" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Tipe</label>
                            <input type="text" name="tipe" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Batch</label>
                            <input type="text" name="batch" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Latitude</label>
                            <input type="text" name="latitude" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Longitude</label>
                            <input type="text" name="longitude" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Provinsi</label>
                            <input type="text" name="provinsi" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Kabupaten</label>
                            <input type="text" name="kabupaten" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Kecamatan</label>
                            <input type="text" name="kecamatan" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Kelurahan</label>
                            <input type="text" name="kelurahan" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Alamat</label>
                            <input type="text" name="alamat" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Nama PIC</label>
                            <input type="text" name="nama_pic" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Nomor PIC</label>
                            <input type="text" name="nomor_pic" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Sumber Listrik</label>
                            <input type="text" name="sumber_listrik" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Gateway Area</label>
                            <input type="text" name="gateway_area" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Beam</label>
                            <input type="text" name="beam" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Hub</label>
                            <input type="text" name="hub" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Kodefikasi</label>
                            <input type="text" name="kodefikasi" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label>SN Antena</label>
                            <input type="text" name="sn_antena" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label>SN Modem</label>
                            <input type="text" name="sn_modem" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label>SN Router</label>
                            <input type="text" name="sn_router" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label>SN AP1</label>
                            <input type="text" name="sn_ap1" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label>SN AP2</label>
                            <input type="text" name="sn_ap2" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label>SN Tranciever</label>
                            <input type="text" name="sn_tranciever" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label>SN Stabilizer</label>
                            <input type="text" name="sn_stabilizer" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label>SN Rak</label>
                            <input type="text" name="sn_rak" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label>IP Modem</label>
                            <input type="text" name="ip_modem" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label>IP Router</label>
                            <input type="text" name="ip_router" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label>IP AP1</label>
                            <input type="text" name="ip_ap1" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label>IP AP2</label>
                            <input type="text" name="ip_ap2" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Expected SQF</label>
                            <input type="text" name="expected_sqf" class="form-control" disabled>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</main>
@endsection

@section('scripts')
<script>

    function openEditModal(id) {
        $.ajax({
            url: `/api/datasites/${id}`,
            method: "GET",
            success: function (response) {
                if (response.success) {
                    $('#modalDetailDataSite').modal('show');
                    $("input[name='id_site']").val(response.data.site_id);
                    $("input[name='sitename']").val(response.data.sitename);
                    $("input[name='tipe']").val(response.data.tipe);
                    $("input[name='batch']").val(response.data.batch);
                    $("input[name='latitude']").val(response.data.latitude);
                    $("input[name='longitude']").val(response.data.longitude);
                    $("input[name='provinsi']").val(response.data.provinsi);
                    $("input[name='kabupaten']").val(response.data.kabupaten);
                    $("input[name='kecamatan']").val(response.data.kecamatan);
                    $("input[name='kelurahan']").val(response.data.kelurahan);
                    $("input[name='alamat']").val(response.data.alamat);
                    $("input[name='nama_pic']").val(response.data.nama_pic);
                    $("input[name='nomor_pic']").val(response.data.nomor_pic);
                    $("input[name='sumber_listrik']").val(response.data.sumber_listrik);
                    $("input[name='gateway_area']").val(response.data.gateway_area);
                    $("input[name='beam']").val(response.data.beam);
                    $("input[name='hub']").val(response.data.hub);
                    $("input[name='kodefikasi']").val(response.data.kodefikasi);
                    $("input[name='sn_antena']").val(response.data.sn_antena);
                    $("input[name='sn_modem']").val(response.data.sn_modem);
                    $("input[name='sn_router']").val(response.data.sn_router);
                    $("input[name='sn_ap1']").val(response.data.sn_ap1);
                    $("input[name='sn_ap2']").val(response.data.sn_ap2);
                    $("input[name='sn_tranciever']").val(response.data.sn_tranciever);
                    $("input[name='sn_stabilizer']").val(response.data.sn_stabilizer);
                    $("input[name='sn_rak']").val(response.data.sn_rak);
                    $("input[name='ip_modem']").val(response.data.ip_modem);
                    $("input[name='ip_router']").val(response.data.ip_router);
                    $("input[name='ip_ap1']").val(response.data.ip_ap1);
                    $("input[name='ip_ap2']").val(response.data.ip_ap2);
                    $("input[name='expected_sqf']").val(response.data.expected_sqf);
                    $('#modalTambahTiketLabel').text('Detail Tiket');
                }
            },
            error: function () {
                // alert("Gagal ambil data site.");
            },
        });
    }
</script>
@endsection
