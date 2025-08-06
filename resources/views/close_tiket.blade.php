@extends('layouts.user_type.auth')

@section('content')
<style>
  body {
    background: linear-gradient(to bottom right,rgb(209, 215, 231),rgb(134, 173, 229));
    min-height: 100vh;
  }
</style>
<style>
  .btn-custom {
    font-size: 0.75rem;
    padding: 0.3rem 1rem;           /* <--- ini yang bikin lebih kecil */
    border-radius: 12px;
    transition: all 0.2s ease-in-out;
  }

  .btn-inactive {
    background-color: transparent;
    border: 2px solid #c026d3;
    color: black;
  }

  .btn-active {
    background-color: #22c55e;
    color: black;
    border: 2px solid #22c55e;
  }

  .btn-inactive:hover {
    background-color: #f0f0f0;
  }
</style>
<!-- Tombol Operasional -->
<div class="d-flex justify-content-center align-items-center mb-3" style="position: absolute; top: 10px; left: 50%; transform: translateX(-50%); z-index: 10;">
  <a href="#" data-bs-toggle="modal" data-bs-target="#operasionalModal" style="text-decoration: none; color: #000;">
    <h6 class="mb-0"><strong>Operasional</strong></h6>
  </a>
</div>

<!-- Modal Operasional -->
<div class="modal fade" id="operasionalModal" tabindex="-1" aria-labelledby="operasionalModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border: none;">
            <div class="modal-header">
                <div class="w-100 text-center mt-2 ">
                    <h5 class="modal-title" id="operasionalModalLabel">Daftar Halaman Operasional</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
            </div>
            <div class="modal-body">
                <div class="d-flex flex-wrap gap-3 justify-content-start ps-6" style="flex-wrap: wrap;">
                    <div style="min-width: 200px;">
                        <div class="fw-bold mb-1">Data Site</div>
                        <div class="ms-2 mb-2">
                            <a href="{{ url('datapass') }}" class="text-decoration-none">Manajemen Password</a>
                        </div>
                    </div>
                    <div style="min-width: 200px;">
                        <div class="fw-bold mb-1">Tiket</div>
                        <div class="ms-2 mb-2">
                            <a href="{{ url('tiket') }}" class="text-decoration-none d-block">Open Tiket</a>
                            <a href="{{ url('close/tiket') }}" class="text-decoration-none d-block">Close Tiket</a>
                            <a href="{{ url('dashboard') }}" class="text-decoration-none d-block">Detail Tiket</a>
                        </div>
                    </div>
                    <div style="min-width: 200px;">
                        <div class="fw-bold mb-1">Log Perangkat</div>
                        <div class="ms-2 mb-2">
                            <a href="{{ url('log_perangkat') }}" class="text-decoration-none d-block">Log Perangkat</a>
                            <a href="{{ url('sparetracker') }}" class="text-decoration-none d-block">Spare Tracker</a>
                        </div>
                    </div>
                    <div style="min-width: 200px;">
                        <div class="fw-bold mb-1">Download</div>
                        <div class="ms-2 mb-2">
                            <a href="{{ url('download_file') }}" class="text-decoration-none d-block">Download File</a>
                        </div>
                    </div>
                    <div style="min-width: 200px;">
                        <div class="fw-bold mb-1">Rekap SLA</div>
                        <div class="ms-2 mb-2">
                            <a href="{{ url('rekap-bmn') }}" class="text-decoration-none d-block">BMN</a>
                            <a href="{{ url('rekap-sl') }}" class="text-decoration-none d-block">SL</a>
                        </div>
                    </div>
                    <div style="min-width: 200px;">
                        <div class="fw-bold mb-1">To Do List</div>
                        <div class="ms-2 mb-2">
                            <a href="{{ url('my-todolist') }}" class="text-decoration-none d-block">My Todo list</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-end" style="border-top: none;">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="position: absolute; top: 10px; right: 10px; filter: invert(1);"></button></div>
        </div>
    </div>
</div>
<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
    <div class="content">
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-lg-12 col-md-12 d-flex justify-content gap-3" style="font-family: 'Quicksand', sans-serif;">
                    <a href="{{ url('tiket') }}"
                        class="btn-custom {{ Request::is('tiket') ? 'btn-active' : 'btn-inactive' }}">
                        Open Tiket
                    </a>
                    <a href="{{ route('close.tiket') }}"
                        class="btn-custom {{ request()->routeIs('close.tiket') ? 'btn-active' : 'btn-inactive' }}">
                        Close Tiket
                    </a>
                    <a href="{{ route('dashboard') }}"
                        class="btn-custom {{ request()->routeIs('dashboard') ? 'btn-active' : 'btn-inactive' }}">
                        Detail Tiket
                    </a>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-end align-items-center mb-3" style="position: absolute; top: 10px; right: 30px; z-index: 10;">
            <div class="dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" title="User Menu">
                    <i class="fa fa-user-circle fa-2x text-primary"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                    <li>
                        <a class="dropdown-item" href="{{ url('user-profile') }}">
                            <i class="fa fa-user me-2"></i> User Profile
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ url('logout') }}">
                            <i class="fa fa-sign-out me-2"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="card card-info card-outline">
            <div class="card-header">
                <div class="row justify-content-between align-items-center mt-2 mb-2">
                    <!-- Cards di tengah -->
                    <div class="col d-flex justify-content-center">
                        @php
                            $cards = [
                                [
                                    'label' => 'Tiket Close All',
                                    'count' => $tiketCloseCount,
                                    'filter' => 'all'
                                ],
                                [
                                    'label' => 'Tiket Close Today',
                                    'count' => $tiketCloseTodayCount,
                                    'filter' => 'today'
                                ],
                            ];
                            $cardBg = 'linear-gradient(to bottom right, rgb(209, 215, 231), rgb(134, 173, 229))';
                        @endphp

                        <div class="d-flex flex-row gap-2 flex-nowrap overflow-auto mb-2 justify-content-center w-100">
                            @foreach($cards as $card)
                                <div class="card" style="min-width:180px; background: {{ $cardBg }}; box-shadow:0 4px 12px 0 rgba(0,0,0,0.12); border-radius:12px;">
                                    <a href="#" class="show-tiket-filter d-block text-decoration-none" data-filter="{{ $card['filter'] }}" style="color: inherit;">
                                        <div class="card-body p-2 d-flex flex-row align-items-center justify-content-center gap-2">
                                            <!-- Label hitam pekat -->
                                            <span class="fw-bolder" style="font-size:10px; color:#000;">{{ $card['label'] }}</span>
                                            <!-- Jumlah tiket warna hijau -->
                                            <span class="fw-bolder" style="font-size:1.5rem; color:#28a745;">{{ $card['count'] }}</span>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                
                <!-- Tombol Tambah, Export, Import -->
                <div class="d-flex justify-content-between align-items-center flex-wrap mt-2">

                {{-- Bagian kiri: tombol download --}}
                <div class="d-flex gap-2 align-items-center mb-2">
                    <a href="{{ route('tiketexport') }}" class="btn btn-outline-success btn-sm" title="Export">
                        <i class="fa fa-download"></i>
                    </a>

                    {{-- Filter tanggal close --}}
                    <form method="GET" action="{{ route('close.tiket') }}" class="d-flex align-items-center gap-2 mb-3">
                        <input type="date" id="tanggal_close" name="tanggal_close"
                            class="form-control form-control-sm"
                            value="{{ request('tanggal_close') }}"
                            onchange="this.form.submit()">

                        @if(request('tanggal_close'))
                            <a href="{{ route('close.tiket') }}" class="btn btn-outline-secondary btn-sm" title="Reset Filter">
                                <i class="fa fa-clock"></i>
                            </a>
                        @endif
                    </form>
                    <form method="GET" action="{{ route('close.tiket') }}" id="filterForm" class="d-flex align-items-center gap-2 mb-3 mr-4 flex-row">
                        <input type="date" name="start_date" class="form-control form-control-sm" value="{{ request('start_date') }}">

                        <span>s/d</span>

                        <input type="date" name="end_date" class="form-control form-control-sm"
                            value="{{ request('end_date') }}"
                            onchange="document.getElementById('filterForm').submit()">

                        @if(request('start_date') || request('end_date'))
                            <a href="{{ route('close.tiket') }}" class="btn btn-sm btn-secondary">
                                <i class="fa fa-refresh me-1"></i> Reset
                            </a>
                        @endif
                    </form>
                </div>

                {{-- Bagian kanan: form search --}}
                <form action="{{ route('close.tiket') }}" method="GET" class="d-flex align-items-center mb-2">
                    <div class="input-group input-group-sm" style="max-width: 300px;">
                        <input type="text" name="search"
                            class="form-control"
                            placeholder="Site ID, Nama Site, Kabupaten, Provinsi"
                            value="{{ request()->query('search') }}">
                        <span class="input-group-text" style="cursor: pointer;" onclick="this.closest('form').submit()">
                            <i class="fa fa-search"></i>
                        </span>
                    </div>
                </form>
            </div>
            </div>
            <div class="card-body">
                <!-- Tabel dengan scroll horizontal -->
                <div class="table-responsive" style="margin-top: -37px;">
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
                        <tbody id="tabel-tiket">
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
                                @php
                                    $role = Auth::user()->role;
                                @endphp
                                <td class="d-flex gap-2">
                                    @if (in_array($role, ['admin', 'superadmin']))
                                    <button type="button" class="btn btn-warning btn-sm" onclick="openUpdateModal({{ $item->id }})">
                                        <i class="fa fa-edit"></i> Update
                                    </button>
                                    <a href="#" class="btn btn-info mr-3 mb-3 btn-delete" data-id="{{ $item->id }}" data-url="{{ route('tiket.delete', ['id' => $item->id]) }}">
                                        <i class="fa fa-trash"></i> Delete
                                    </a>
                                    @endif
                                    <a href="#" class="btn btn-primary mr-3 mb-3" data-toggle="modal" onclick="openEditModal({{ $item->id }})">
                                        <i class="fa fa-info-circle"></i> Detail
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- Modal Update Tanggal Close & Plan Action -->
                    <div class="modal fade" id="modalUpdatePlan" tabindex="-1" role="dialog" aria-labelledby="modalUpdatePlanLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <form id="updatePlanForm" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Update Tanggal Close & Plan Action</h5>
                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Tutup">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" id="tiket_id">
                                        <div class="form-group">
                                            <label for="tanggal_close">Tanggal Close</label>
                                            <input type="date" name="tanggal_close" id="update_tanggal_close" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="plan_actions">Plan Actions</label>
                                            <textarea name="plan_actions" id="update_plan_actions" class="form-control" rows="3" required></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

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
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
$(document).ready(function () {
    $('.show-tiket-filter').on('click', function (e) {
        e.preventDefault();
        const filter = $(this).data('filter');

        $.ajax({
            url: '{{ route('tiket.filter') }}',
            method: 'GET',
            data: { filter: filter },
            success: function (response) {
                $('#tabel-tiket').html(response);
            },
            error: function (xhr) {
                alert('Gagal memuat data: ' + xhr.statusText);
            }
        });
    });
});
</script>
<script>
    function openUpdateModal(id) {
    $.ajax({
        url: `/api/tiket/datasites/${id}`,
        method: 'GET',
        success: function (response) {
            if (response.success) {
                // Isi field modal dengan data dari response
                $('#update_tanggal_close').val(response.data.tanggal_close);
                $('#update_plan_actions').val(response.data.plan_actions);

                // Set form action-nya
                $('#updatePlanForm').attr('action', `/tiket/update-plan/${id}`);

                // Tampilkan modal update
                $('#modalUpdatePlan').modal('show');
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: 'Data tidak ditemukan.'
                });
            }
        },
        error: function () {
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'Tidak dapat mengambil data.'
            });
        }
    });
}
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