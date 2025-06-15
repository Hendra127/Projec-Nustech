@extends('layouts.user_type.auth')

@section('content')
<style>
  body {
    background: linear-gradient(to bottom right,rgb(209, 215, 231),rgb(134, 173, 229));
    min-height: 100vh;
  }
</style>
<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
    <div class="content">
        <div class="card card-info card-outline">
            <div class="card-header">
            <h4 class="mb-4" style="text-align: center;"> Data Close Tiket</h4>
                <!-- Tombol Tambah, Export, Import -->
                <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
                    <div>
                        <a href="{{ route('tiketexport') }}" class="btn btn-success mr-3 mb-3">
                            <i class="fa fa-file-excel-o"></i> Export
                        </a>
                        <a href="#" class="btn btn-info mb-3" data-toggle="modal" data-target="#exampleModalLong">
                            <i class="fa fa-upload"></i> Import
                        </a>
                    </div>
                    <form action="{{ route('tiket') }}" method="GET" class="d-flex align-items-center mb-3">
                        <input type="text" name="query" class="form-control form-control-sm me-2" placeholder="Enter To Search" value="{{ request()->query('query') }}">
                        <button type="submit" class="btn btn-magenta btn-sm mb-0">Search</button>
                    </form>
                </div>
            </div>

            <div class="card-body">
                <!-- Tabel dengan scroll horizontal -->
                <div class="table-responsive" style="margin-top: -40px;">
                    <table class="table table-bordered table-striped table-sm align-middle text-nowrap">
                        <thead class="table-dark">
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">SITE ID</th>
                                <th class="text-center">NAMA SITE</th>
                                <th class="text-center">PROVINSI</th>
                                <th class="text-center">KABUPATEN</th>
                                <th class="text-center">DURASI</th>
                                <th class="text-center">KATEGORI</th>
                                <th class="text-center">TANGGAL REKAP</th>
                                <th class="text-center">BULAN OPEN</th>
                                <th class="text-center">STATUS TIKET</th>
                                <th class="text-center">KENDALA</th>
                                <th class="text-center">TANGGAL CLOSE</th>
                                <th class="text-center">BULAN CLOSE</th>
                                <th class="text-center">DETAIL PROBLEM</th>
                                <th class="text-center">PLAN ACTIONS</th>
                                <th class="text-center">CE</th>
                                <th class="text-center">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tiket as $index => $item)
                            <tr>
                                <td class="text-center">{{ $tiket->firstItem() + $index }}</td>
                                <td>{{ $item->site_id }}</td>
                                <td>{{ $item->nama_site }}</td>
                                <td>{{ $item->provinsi }}</td>
                                <td>{{ $item->kabupaten }}</td>
                                <td class="text-center">{{ $item->durasi_akhir ?? 0 }} Hari</td>
                                <td class="text-center">{{ $item->kategori }}</td>
                                <td class="text-center">{{ $item->tanggal_rekap }}</td>
                                <td class="text-center">{{ $item->bulan_open }}</td>
                                <td class="text-center">{{ $item->status_tiket }}</td>
                                <td>{{ $item->kendala }}</td>
                                <td class="text-center">{{ $item->tanggal_close }}</td>
                                <td class="text-center">{{ $item->bulan_close }}</td>
                                <td>{{ $item->detail_problem }}</td>
                                <td>{{ $item->plan_actions }}</td>
                                <td>{{ $item->ce }}</td>
                                <td class="d-flex gap-2">
                                    <a href="#" class="btn btn-info mr-3 mb-3 btn-delete" data-id="{{ $item->id }}" data-url="{{ route('tiket.delete', ['id' => $item->id]) }}">
                                        <i class="fa fa-trash"></i> Delete
                                    </a>
                                    <a href="#" class="btn btn-primary mr-3 mb-3" data-toggle="modal" onclick="openEditModal({{ $item->id }})">
                                        <i class="fa fa-info-circle"></i> Detail
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

    <!-- Modal Tambah Data Tiket -->
    <div class="modal fade" id="modalTambahTiket" tabindex="-1" role="dialog" aria-labelledby="modalTambahTiketLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form id="tiketForm" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTambahTiketLabel">Tambah Data Tiket</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body row">
                        <div id="formMethod"></div>
                        <input type="hidden" name="nama_site" class="form-control" disabled>
                        <div class="form-group col-md-6 d-flex flex-column" style="margin-top: 4px;">
                            <label>Nama Site</label>
                            <select class="site-name-modal form-control" required disabled>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Provinsi</label>
                            <input type="text" name="provinsi" class="form-control" required disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Kabupaten</label>
                            <input type="text" name="kabupaten" class="form-control" required disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Durasi</label>
                            <input type="text" name="durasi" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Kategori</label>
                            <input type="text" name="kategori" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Tanggal Rekap</label>
                            <input type="date" name="tanggal_rekap" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Bulan Open</label>
                            <input type="text" name="bulan_open" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Status Tiket</label>
                            <input type="text" name="status_tiket" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Kendala</label>
                            <input type="text" name="kendala" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Tanggal Close</label>
                            <input type="date" name="tanggal_close" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Bulan Close</label>
                            <input type="text" name="bulan_close" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Detail Problem</label>
                            <textarea name="detail_problem" class="form-control" rows="2" disabled></textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Plan Actions</label>
                            <textarea type="text" name="plan_actions" class="form-control" rows="2" disabled></textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Cluster Enginer (CE)</label>
                            <textarea name="ce" class="form-control" rows="2" disabled></textarea>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<style>
    .btn-magenta {
        background-color: #d200aa;
        color: white;
    }
</style>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        $('.btn-delete').click(function (e) {
            e.preventDefault();
            const url = $(this).data('url');
    
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data yang dihapus tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });
        });
    });
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: '{{ session('success') }}',
            timer: 3000,
            timerProgressBar: true,
            showConfirmButton: false
        });
    @endif

    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: '{{ session('error') }}',
            timer: 3000,
            timerProgressBar: true,
            showConfirmButton: true
        }).then(() => {
            // Buka modal kembali setelah notifikasi
            $('#modalTambahTiket').modal('show');
        });
    @endif
    function openCreateModal() {
        $('#siteModal').modal('show');
        $('#modalTitle').text('Create Tiket');
        $('#tiketForm').attr('action', storeUrl);
        $('#tiketForm').trigger('reset');
    }

    function openEditModal(id) {
        $.ajax({
            url: `/api/tiket/datasites/${id}`,
            method: "GET",
            success: function (response) {
                if (response.success) {
                    $('#modalTambahTiket').modal('show');
                    var selectedSite = {
                        id: response.data.id,
                        text: response.data.nama_site
                    };
                    var newOption = new Option(selectedSite.text, selectedSite.id, true, true);
                    $('.site-name-modal').append(newOption).trigger('change');

                    $("input[name='nama_site']").val(response.data.nama_site);
                    $("input[name='provinsi']").val(response.data.provinsi);
                    $("input[name='kabupaten']").val(response.data.kabupaten);
                    $("input[name='durasi']").val(response.data.durasi);
                    $("input[name='kategori']").val(response.data.kategori);
                    $("input[name='tanggal_rekap']").val(
                        response.data.tanggal_rekap
                    );
                    $("input[name='bulan_open']").val(response.data.bulan_open);
                    $("input[name='status_tiket']").val(
                        response.data.status_tiket
                    );
                    $("input[name='kendala']").val(response.data.kendala);
                    $("input[name='tanggal_close']").val(
                        response.data.tanggal_close
                    );
                    $("input[name='bulan_close']").val(
                        response.data.bulan_close
                    );
                    $("textarea[name='detail_problem']").val(
                        response.data.detail_problem
                    );
                    $("textarea[name='plan_actions']").val(
                        response.data.plan_actions
                    );
                    $("textarea[name='ce']").val(
                        response.data.ce
                    );
                    $('#modalTambahTiketLabel').text('Detail Tiket');
                    $('#tiketForm').attr('action', `/tiket/${id}`);
                    $('#formMethod').html('@method("PUT")');
                }
            },
            error: function () {
                alert("Gagal ambil data site.");
            },
        });
    }
</script>
@endsection